<?php

namespace App\Http\Controllers\api;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Caratula;
use App\Models\Extracto;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Models\Historial;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\TipoEntidad;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Models\TipoExpediente;
use Illuminate\Support\Facades\DB;
use App\Models\PrioridadExpediente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreExpedienteRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Relations\Relation;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expediente = Expediente::index();
        return response()->json($expediente,200);
    }

    public function create()
    {
        $motivo = TipoExpediente::motivosConExtractos();
        $motivoAll = TipoExpediente::all();
        $iniciador = Iniciador::all();
        $prioridad = PrioridadExpediente::all();
        $fecha = Carbon::now()->format('d-m-Y');
        $areas = Area::all_areas();
        $create_exp = [$fecha, $iniciador, $motivoAll, $motivo, $prioridad,$areas];
        return response()->json($create_exp,200);
    }

    public function createNroExpediente()
    {
        $ano_exp = Carbon::now()->format('Y');
        $nro_expediente = Expediente::nroExpediente($ano_exp);
        return $nro_expediente;
    }

    /*Ejemplo para el postman
    {
        "nro_expediente" : "42221-2510-123122023/2021",
        "nro_fojas" : "250",
        "prioridad_id" : "1",
        "tipo_exp_id" : "1",
        "monto" : "100",
        "user_id" : "1",
        "area_id" : "1",
        "iniciador_id": "1",
        "descripcion_extracto": "Extracto"
    }
    */

    /*
    Método Store replanteado con transactions para evitar inconsistencias en la DB
    M.F.
    */
    public function store(StoreExpedienteRequest $request)
    {
        $nro_expediente = ExpedienteController::createNroExpediente();
        if ($request->validated())
        {
            DB::beginTransaction();
            $expediente = new Expediente;
            $expediente->nro_expediente = $nro_expediente;
            $expediente->nro_expediente_ext = $request->nro_expediente_ext;
            $expediente->fojas = $request->nro_fojas;
            $expediente->fecha = Carbon::now()->format('Y-m-d');
            $expediente->prioridad_id = $request->prioridad_id;
            $expediente->tipo_expediente = $request->tipo_exp_id;
            $expediente->estado_expediente_id = '1';
            $expediente->area_actual_id = '13';
            $expediente->monto = $request->monto;
            $expediente->save();

            $extracto = new Extracto;
            $extracto->descripcion = $request->descripcion_extracto;
            $extracto->save();

            $caratula = new Caratula;
            $caratula->expediente_id = $expediente->id;
            $caratula->iniciador_id = $request->iniciador_id;
            $caratula->extracto_id = $extracto->id;
            $caratula->observacion = $request->observacion;
            $caratula->save();

            $user = Auth::user();
            $historial = new Historial;
            $historial->expediente_id = $expediente->id;
            $historial->user_id = $user->id;
            $historial->area_origen_id = 13;
            $historial->area_destino_id = 13;
            $historial->fojas = $request->nro_fojas;
            $historial->fecha = Carbon::now()->format('Y-m-d');
            $historial->hora = Carbon::now()->format('h:i');
            $historial->motivo = "Expediente creado.";
            $historial->estado = 1;
            if(($request->allFiles()) != null)
            {
                $fileName = $nro_expediente;
                $fileName = str_replace("/","-",$fileName).'.zip';
                $path =storage_path()."/app/public/archivos_expedientes/".$fileName;
                $historial->nombre_archivo = $fileName;
            }
            $historial->save();

            /*
            * Cuando Realiza el pase
            */
            $historial = new Historial;
            $historial->expediente_id = $expediente->id;
            $historial->user_id = $user->id;
            $historial->area_origen_id = 13 ;
            $historial->area_destino_id = $request->area_id;
            $historial->fojas = 0;
            $historial->fecha = Carbon::now()->format('Y-m-d');
            $historial->hora = Carbon::now()->format('h:i');
            //$historial->motivo = $request->observacion; TODO
            $historial->motivo = "Pase al área: ".Area::find( $historial->area_destino_id)->descripcion. ".";
            $historial->observacion = null;
            $historial->estado = "1";//Enviado
            $nano = time_nanosleep(0, 500000000);
            $historial->save();
            $estado_actual = Area::findOrFail($request->area_id);
            if(($request->allFiles()) != null)
            {
                $zip = new ZipArchive;
                $fileName = $nro_expediente;
                $fileName = str_replace("/","-",$fileName).'.zip';
                $path =storage_path()."/app/public/archivos_expedientes/".$fileName;
                if($zip->open($path ,ZipArchive::CREATE) === true)
                {
                    foreach ($request->allFiles() as $key => $value)
                    {
                        $relativeNameInZipFile = $value->getClientOriginalName();
                        $zip->addFile($value, $relativeNameInZipFile);
                    }
                    $zip->close();
                }
                $expediente->archivos = $fileName;
                $historial->nombre_archivo = $fileName;
                $expediente->save();
                $historial->save();
            }
            if ($request->tipo_exp_id == 3 || $request->tipo_exp_id == 4)
            {
                $notificacion = new Notificacion;
                $notificacion->expediente_id = $expediente->id;
                $notificacion->user_id = $user->id;
                $notificacion->fecha = Carbon::now()->format('Y-m-d');
                $notificacion->estado = true;
                $notificacion->save();
            }
            DB::commit();

                //(2 = separacion barras, 80 = ancho de la barra)
                $cod = new DNS1D;
                $codigoBarra = $cod->getBarcodeHTML($expediente->nro_expediente, 'C39',2,80,'black', true);
                $datos = [
                    $expediente->fecha,
                    $caratula->iniciador->nombre,
                    $extracto->descripcion,
                    $estado_actual,
                    $expediente->nro_expediente,
                    $codigoBarra,
                    $caratula->iniciador->email,
                    $caratula->observacion,
                    $expediente->nro_expediente_ext
                ];
                return response()->json($datos,200);
        }
    }


    public function union(Request $request)
    {
        DB::beginTransaction();
        $exp_padre = Expediente::findOrFail($request->exp_padre);
        $exp_hijos = Expediente::find($request->exp_hijos);
        $expedientes_hijos = "";
        foreach ($exp_hijos as $exp_hijo)
        {
            if(($exp_hijo->expediente_id == null) && ($exp_hijo->id != $exp_padre->id) && ($exp_hijo->hijos()->get()->count() < 1))
            {
                $exp_hijo->expediente_id = $exp_padre->id;
                if($exp_hijo->save())
                {
                    $historial = new Historial;
                    $historial->expediente_id = $exp_hijo->id;
                    $historial->user_id = Auth::user()->id;
                    $historial->area_origen_id = Auth::user()->area_id;
                    $historial->area_destino_id = Auth::user()->area_id;
                    $historial->fojas = $exp_hijo->fojas;
                    $historial->fecha = Carbon::now()->format('Y-m-d');
                    $historial->hora = Carbon::now()->format('h:i');
                    $historial->motivo = "Expediente Nro: ". $exp_hijo->nro_expediente . " unido al Expediente Nro: " . $exp_padre->nro_expediente .".";
                    $historial->estado = "5";//Estado englose
                    $historial->save();
                    $expedientes_hijos = $expedientes_hijos . $exp_hijo->nro_expediente . ", ";
                }
            }
            else
            {
                $array = collect();
                foreach ($exp_hijos as $exp_hijo)
                {
                    if($exp_hijo->hijos()->get()->count() > 0)
                    {
                        $array->push([
                            'nro_expediente'    => $exp_hijo->nro_expediente,
                            'bandera'           => 1
                        ]);
                    }
                }

                return response()->json([
                    "Mensaje" => 'El\los expediente\s seleccionado como hijo ya se encuentran acumulados.',
                    "Expediente\s padre" => $array
                ],400);
            }
            $exp_padre->fojas = $exp_padre->fojas + $exp_hijo->fojas;
            $exp_padre->save();
        }
        $historial_padre = new Historial;
        $historial_padre->fojas_aux = $request->fojas_aux;
        $historial_padre->expediente_id = $exp_padre->id;
        $historial_padre->user_id = Auth::user()->id;
        $historial_padre->area_origen_id = Auth::user()->area_id;
        $historial_padre->area_destino_id = Auth::user()->area_id;
        $historial_padre->fojas = $exp_padre->fojas;
        $historial_padre->fecha = Carbon::now()->format('Y-m-d');
        $historial_padre->hora = Carbon::now()->format('h:i');
        $historial_padre->motivo =  "El Expediente N° " . $expedientes_hijos . " se ha unido al Expediente N° ". $exp_padre->nro_expediente;
        $historial_padre->estado = "5";
        $historial_padre->save();
        DB::commit();
        return $historial_padre->motivo;
    }
    //return response()->json([$exp_padre->first(),$exp_padre->hijos,$exp_hijo->padre ],200);

    /*{
        "exp_padre" : "1",
        "exp_hijos" : ["2","3"],
        "user_id" : "1"
    }*/

    public function desgloce(Request $request)
    {
        DB::beginTransaction();
        $exp_padre = Expediente::findOrFail($request->exp_padre);
        $exp_hijos = $exp_padre->hijos;
        $ultimo_hijo_id = $exp_padre->hijos->last()->id;
        $user = Auth::user();
        $cotador_fojas_hijo = 0;
        $exp_hijos_desglosados = "";
        foreach ($exp_hijos as $exp_hijo_desglosado)
        {
            $exp_hijo_desglosado->expediente_id = null;
            $exp_hijo_desglosado->save();
            $historial_hijo_desglosado = new Historial;
            $historial_hijo_desglosado->expediente_id = $exp_hijo_desglosado->id;
            $historial_hijo_desglosado->user_id = $user->id;
            $historial_hijo_desglosado->area_origen_id = $user->area_id;
            $historial_hijo_desglosado->area_destino_id = $user->area_id;
            $historial_hijo_desglosado->fojas = $exp_hijo_desglosado->fojas;
            $historial_hijo_desglosado->fecha = Carbon::now()->format('Y-m-d');
            $historial_hijo_desglosado->hora = Carbon::now()->format('h:i');
            $historial_hijo_desglosado->motivo = "Desglosado del expediente: " . $exp_padre->nro_expediente . ", por el usuario: " .  $user->persona->apellido . " " . $user->persona->nombre;
            $historial_hijo_desglosado->estado = 3;
            $historial_hijo_desglosado->save();
            $exp_hijos_desglosados = $exp_hijos_desglosados . $exp_hijo_desglosado->nro_expediente . ", ";
            $cotador_fojas_hijo = $cotador_fojas_hijo + $historial_hijo_desglosado->fojas;
        }
        $exp_ultimo_hijo = Expediente::find($ultimo_hijo_id);
        $fojas_aux_padre = Historial::where('expediente_id',$exp_padre->id)->where('estado',5)->first()->fojas_aux;
        $exp_ultimo_hijo->fojas = ($exp_padre->fojas - $fojas_aux_padre - $cotador_fojas_hijo) + $exp_ultimo_hijo->fojas;
        $exp_ultimo_hijo->save();
        $historial_ultimo_hijo = $exp_ultimo_hijo->historiales->last();
        $historial_ultimo_hijo->fojas = $exp_ultimo_hijo->fojas;
        $historial_ultimo_hijo->motivo = 'Expediente Nº ' . $exp_ultimo_hijo->nro_expediente . ' se ha desglosado';
        $historial_ultimo_hijo->save();
        $exp_padre->fojas = $exp_padre->historiales->first()->fojas;
        $exp_padre->save();
        $historial_padre = new Historial;
        $historial_padre->area_origen_id = $user->area_id;
        $historial_padre->area_destino_id = $user->area_id;
        $historial_padre->expediente_id = $exp_padre->id;
        $historial_padre->user_id = $user->id;
        $historial_padre->fojas = $exp_padre->fojas;
        $historial_padre->fecha = Carbon::now()->format('Y-m-d');
        $historial_padre->hora = Carbon::now()->format('h:i');
        $historial_padre->estado = "3";
        $historial_padre->motivo = "El expediente N° ". $exp_hijos_desglosados." se ha desglosado del expediente N° " .  $exp_padre->nro_expediente . ".";
        $historial_padre->save();
        DB::commit();
        return $historial_padre->motivo;
    }

    /*
    {
        "exp_padre" : "1",
        "user_id" : "1"
    }
    */

    public function createDesgloce(Request $request)
    {
        $exp_padre = Expediente::where('id', $request->exp_padre)->where('expediente_id', null)->first();
        if($exp_padre !== null && $exp_padre->hijos->count() > 0)
        {
            return response()->json([$exp_padre->first() ,$exp_padre->hijos],200);
        }
        else
        {
            return response()->json("No tiene hijitos",200);
        }
    }

    /*
    {
        "exp_padre" : "1"
    }
    */

    public function indexExpPadres()
    {
        $exp_padres = Expediente::where('expediente_id', null)->get();
        $array_exp_padres = collect([]);
        foreach ($exp_padres as $exp_padre)
        {
            if( $exp_padre->hijos->count() > 0)
            {
                $array_exp_padres->push(['id' => $exp_padre->id,
                                        'extracto' => $exp_padre->caratula->extracto->descripcion,
                                        'area_actual_id' => $exp_padre->area_actual_id,
                                        'estado_expediente_id' => $exp_padre->estado_expediente_id,
                                        'tipo_expediente' => $exp_padre->tipo_expediente,
                                        'prioridad_id' => $exp_padre->prioridad_id,
                                        'expediente_id' => $exp_padre->expediente_id,
                                        'nro_expediente' => $exp_padre->nro_expediente,
                                        'nro_expediente_ext' => $exp_padre->nro_expediente_ext,
                                        'fojas' => $exp_padre->fojas,
                                        'fecha' => $exp_padre->fecha,
                                        'monto' => $exp_padre->monto,
                                        'archivos' => $exp_padre->archivos,
                                        'created_at' => $exp_padre->created_at,
                                        'updated_at' => $exp_padre->updated_at]);
            }
        }
        return response()->json($array_exp_padres,200);
    }

    public function show(Request $request)
    {
        $expediente = Expediente::where('expediente_id',null)->findOrFail($request->expediente_id);
        $iniciador = $expediente->caratula->iniciador;
        $extracto = $expediente->caratula->extracto;
        $fecha_sistema = $expediente->created_at->format('Y-m-d');
        $fecha_exp = $expediente->fecha;
        $nro_cuerpos = $expediente->cantidadCuerpos();
        $fojas = $expediente->fojas;
        if ($expediente->archivos == '')
        {
            $posee_archivo = '';
        }
        else
        {
            $posee_archivo = "si";
        }
        $detalle = [$expediente->nro_expediente,
                    $iniciador->nombre,
                    $extracto->descripcion,
                    $fecha_sistema,
                    $fecha_exp,
                    $nro_cuerpos,
                    $fojas,
                    $posee_archivo];
        return response()->json($detalle,200);
    }

    /**
     * Método que muestra detalle de expedientes de subsidios(tipo:3) y AporteNoReintegrable(tipo:4)
     * para áreas de Registraciones(área:6) y Notificaciones(área:14)
     * @param: user_id
     * @param: expediente_id
     */
    public function show_subsidios_apNR(Request $request)
    {
        $expediente = Expediente::where('expediente_id',null)->findOrFail($request->expediente_id);
        $iniciador = $expediente->caratula->iniciador;
        $extracto = $expediente->caratula->extracto;
        $fecha_sistema = $expediente->created_at->format('Y-m-d');
        $fecha_exp = $expediente->fecha;
        $nro_cuerpos = $expediente->cantidadCuerpos();
        $fojas = $expediente->fojas;
        if ($expediente->archivos == '')
        {
            $posee_archivo = '';
        }
        else
        {
            $posee_archivo = "si";
        }
        $detalle = [$expediente->nro_expediente,
                    $iniciador->nombre,
                    $extracto->descripcion,
                    $fecha_sistema,
                    $fecha_exp,
                    $nro_cuerpos,
                    $fojas,
                    $posee_archivo];


        $notificacion = new Notificacion();
        $notificacion->expediente_id = $request->expediente_id;
        $notificacion->user_id = Auth::user()->id;
        $notificacion->fecha = Carbon::now()->format('Y-m-d');


        return response()->json($detalle,200);
    }

    /*
        Metodo para validar las extensiones de los archivos que se van a adjuntar al zip.
    */
    public function validarZip(Request $request)
    {
        $archivos = $request->allFiles();
        $array_archivos = collect();
        // Recorre el array y trae la extension de los archivos
        foreach ($archivos as $archivo)
        {
            $array_archivos->push(
                $archivo->getClientOriginalExtension()
            );
        }
        $extensiones = Expediente::EXTENSIONES_PERMITIDAS;
        // Metodo para calcular el peso de los archivos
        $peso_archivos = Expediente::peso($request);

        if(($archivos) != null)
        {
            $array = collect([]);
            $array_archivos = $array_archivos->toArray();
            // Evalua las coincidencias entre el array de archivos que recibe y el array de extensiones permitidas
            $coincidencias = array_intersect($array_archivos, $extensiones);
            foreach($coincidencias as $value)
            {
                $array->push([$value]);
            }
        }
        // Evalua si la cantidad de extensiones validas es igual a la cantidad de archivos que se suben y si el peso total es menor a 25mb
        if((count($array_archivos) == count($array)) && ($peso_archivos < 25000000))
        {
            return response()->json('true', 200);
        }
        else
        {
            return response()->json('false', 200);
        }
    }

    public function descargarZip(Request $request) //TODO hasta que tenga boton
    {
        $expediente = Expediente::findOrFail($request->id);
        if($request->download == true)
        {
            //Define Dir Folder
            $public_dir = public_path()."/storage/archivos_expedientes/". $expediente->archivos;
            $fileName = $expediente->nro_expediente;
            $fileName = str_replace("/","-",$fileName).'.zip';
            // Zip File Name
            if(file_exists($public_dir))
            {
                //return view('zip');
                $headers = array('Content-Type'=>'arraybuffer',);
                return response()->download($public_dir , $fileName, $headers);
            }
            else
            {
                return 'no existe archivo';
            }
        }
    }

    //TODO revisar utilidad
    /*public function indexPorAreas(Request $request)
    {
        $expedientes = Expediente::where('area_actual_id',$request->area_actual_id)->where('area_actual_type',$request->area_actual_type)->get();
        $cuerpos = Cuerpo::where('area_id', $request->area_actual_id)->where('area_type', $request->area_actual_type)->get();
        $datos = [$expedientes, $cuerpos];
        return response()->json($datos, 200);
    }*/

    public function bandeja(Request $request)
    {
        $bandeja = $request->bandeja;
        $user_id = Auth::user()->id;
        $listado_expedientes = Expediente::listadoExpedientes($user_id, $bandeja);
        return response()->json($listado_expedientes,200);
    }

    public function contadorBandejaEntrada()
    {
        $contador = Expediente::contadorBandejaEntrada(Auth::user()->id)->count();
        return response()->json($contador, 200);
    }

    /**
     * Método para mostrar información de expedientes con motivo Subsidio y Aporte no reintegrable
     * para  Registraciones(área:6) y Notificaciones(área:14)
     * Autor: Mariano Flores
     */
    public function expSubsidiosNoReintegrables()
    {
        $expedientes = Notificacion::listadoExpedientesSubsidioAporteNR();
        return response()->json($expedientes);
    }

    /*
    * Busca los expedientes por: 1-nro_expediente, 2-cuit iniciador, 3-nro_cheque, 4-iniciador, 5-nro_expediente_ext, 6-norma legal
    */
    public function buscarExpediente(Request $request)
    {
        $buscar_por = $request->buscar_por;
        $valor = $request->valor;
        $listado_expedientes = Expediente::buscarPor($valor, $buscar_por);
        return response()->json($listado_expedientes, 200);
    }

    /*
    * Retorna todos los Expedientes - EN DESUSO
    */
    public function AllExpedientes_old()
    {
        $expedientes = Expediente::where('expediente_id',null)->where('expediente_id',null)->get();
        $listado_expedientes = Collect([]);
        foreach ($expedientes as $expediente) {
            $listado_expedientes->push($expediente->datosExpediente());
        }
        return response()->json($listado_expedientes,200);
    }

    /**
     * Retorna todos los expedientes usando la DB facade
     * Autor: Mariano Flores
     */
    public function AllExpedientes()
    {
        $expedientes = Expediente::datosExpediente();
        return response()->json($expedientes, 200);
    }

    /*
    * Retorna todos los Expedientes
    */
    public function codigoBarra()
    {

       // $expediente = Expediente::find(1);
       $cod = new DNS1D;
       $cod2 = new DNS2D;
       //echo $cod2->getBarcodeHTML('4445645jdsfjsak656', 'QRCODE');
       //echo $cod2->getBarcodeHTML('4445645656', 'PDF417');

       //echo $cod->getBarcodeHTML('4445645656', 'PHARMA2T',3,33,'green', true);

       echo "<br>";
       echo "<br>";
       echo "<br>";
       echo "<br>";
       echo "<br>";
       $var = $cod->getBarcodeHTML("45456123133556", 'C39',2,80,'black', true);
        return response()->json($var,200);
       //return $var;
        //echo $cod->getBarcodeHTML('4445645656', 'C39+');
        /*echo $cod->getBarcodeHTML('4445645656', 'C39E');
        echo $cod->getBarcodeHTML('4445645656', 'C39E+');
        echo $cod->getBarcodeHTML('4445645656', 'C93');
        echo $cod->getBarcodeHTML('4445645656', 'S25');
        echo $cod->getBarcodeHTML('4445645656', 'S25+');
        echo $cod->getBarcodeHTML('4445645656', 'I25');
        echo $cod->getBarcodeHTML('4445645656', 'I25+');
        echo $cod->getBarcodeHTML('4445645656', 'C128');
        echo $cod->getBarcodeHTML('4445645656', 'C128A');
        echo $cod->getBarcodeHTML('4445645656', 'C128B');
        echo $cod->getBarcodeHTML('4445645656', 'C128C');
        echo $cod->getBarcodeHTML('44455656', 'EAN2');
        echo $cod->getBarcodeHTML('4445656', 'EAN5');
        echo $cod->getBarcodeHTML('4445', 'EAN8');
        echo $cod->getBarcodeHTML('4445', 'EAN13');
        echo $cod->getBarcodeHTML('4445645656', 'UPCA');
        echo $cod->getBarcodeHTML('4445645656', 'UPCE');
        echo $cod->getBarcodeHTML('4445645656', 'MSI');
        echo $cod->getBarcodeHTML('4445645656', 'MSI+');
        echo $cod->getBarcodeHTML('4445645656', 'POSTNET');
        echo $cod->getBarcodeHTML('4445645656', 'PLANET');
        echo $cod->getBarcodeHTML('4445645656', 'RMS4CC');
        echo $cod->getBarcodeHTML('4445645656', 'KIX');
        echo $cod->getBarcodeHTML('4445645656', 'IMB');
        echo $cod->getBarcodeHTML('4445645656', 'CODABAR');
        echo $cod->getBarcodeHTML('4445645656', 'CODE11');
        echo $cod->getBarcodeHTML('4445645656', 'PHARMA');
        echo $cod->getBarcodeHTML('4445645656', 'PHARMA2T');
       //echo $cod2->getBarcodePNGPath('4445645656', 'PDF417');
       //echo $cod2->getBarcodeSVG('4445645656', 'DATAMATRIX');*/

        //echo $cod->getBarcodeSVG('4445645656', 'PHARMA2T');
       //echo $cod->getBarcodeHTML('4445645656', 'PHARMA2T');
        /*echo '<img src="data:image/png,' . $cod->getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
        echo $cod->getBarcodePNGPath('4445645656', 'PHARMA2T');
        echo '<img src="data:image/png;base64,' . $cod->getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';*/
    }


    /*
    - Método que retorna el detalle del expediente para mostrarlo en bandeja de entrada antes de aceptar
    - @param: expediente_id

    public function showDetalleExpediente(Request $request)
    {
        $expediente = Expediente::findOrFail($request);
        $detalle = Collect([]);
        foreach ($expediente as $exp)
        {
            $detalle->push($exp->datosExpediente());
        }
        return response()->json($detalle, 200);
    }
    */
    public function contar_cedulas(Request $request)
    {
        $datos = Expediente::detalle_cedulas($request->expediente_id);
        return response()->json($datos, 200);
    }

    public function pruebaNormal(Request $request)
    {
        $user = $request->user();
        return response()->json($user, 200);
    }

    public function pruebaEnglose(Request $request)
    {
        $user = $request->user();
        return response()->json($user, 200);
    }


    public function indexMotivos(){
        $motivoAll = TipoExpediente::all();
        $areasAll = Area::all_areas();
        return response()->json([$motivoAll, $areasAll], 200);
    }
}
