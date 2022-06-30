<?php

namespace App\Http\Controllers\api;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Historial;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHistorialRequest;

class HistorialController extends Controller
{
    public function create(Request $request)
    {
        $expediente = Expediente::findOrFail($request->expediente_id);
        $area_destino = Area::All();
        $area_destino_mesa_archivos = $area_destino->except(['26']);
        $fecha = Carbon::now()->format('d-m-Y');
        $hora = Carbon::now()->format('h:i');
        $horario = [$fecha,$hora];
        //$user = User::findOrFail($c["user_id"]);
        //$agente = [$user->persona->nombre, $user->persona->apellido, $user->id];
        $historial = [$expediente, $area_destino, $horario,$area_destino_mesa_archivos];
        return response()->json($historial, 200);
    }

    /*   Datos de prueba
    {
        "expediente_id": 1,
        "user_id" : 1,
        "area_origen_id": 3,
        "area_destino_id" : 5,
        "fojas": 10,
        "motivo": "asd"
    }
    */

    /*
    * Recibe datos para registrar el pase de un expediente a otra área
    */
    public function store(StoreHistorialRequest $request)
    {
        if($request->validated())
        {
            $user = Auth::user();
            $expediente = Expediente::findOrFail($request->expediente_id);
            $historial = new Historial;
            $historial->expediente_id = $expediente->id;
            $historial->user_id = $user->id;
            $historial->area_origen_id = $user->area_id;
            $historial->area_destino_id = $request->area_destino_id;
            $historial->fojas = $request->fojas;
            $historial->fecha = Carbon::now()->format('Y-m-d');
            $historial->hora = Carbon::now()->format('h:i');
            $historial->observacion = $request->observacion;
            $historial->motivo = "Pase al area: " . Area::find($request->area_destino_id)->descripcion . ".";
            //$historial->nombre_archivo = $request->nombre_archivo;
            $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
            $expediente->estado_expediente_id = '1';
            $expediente->fojas += $historial->fojas;
            //ARCHIVOS/////////////////////////////////////////////////////////////////////////////
            if(($request->allFiles()) != null)
            {
                $zip = new ZipArchive;
                $fileName = $expediente->nro_expediente;
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
            ///////////////////////////////////////////////////////////////////////////////////////
                $expediente->save();
                $historial->save();
                $area_destino = $historial->areaDestino->descripcion;
                $fecha = $historial->fecha = Carbon::now()->format('Y-m-d');
                $fojas = $historial->fojas = $request->fojas;
                $data = [
                    $area_destino,
                    $fecha,
                    $historial->hora,
                    $fojas,
                    $user->persona->nombre. " ".$user->persona->apellido,
                    $historial->observacion,
                    $expediente->nro_expediente,
                    $expediente->caratula->extracto->descripcion];
            return response()->json($data, 200);
        }
    }

     /*
    * Cambia el estado de los cuerpos de un expediente y guarda registro del mismo en el historial.
    */
    public function updateEstado(Request $request)
    {
        # 1-Pendiente, 3-Aceptado, 4-Enviado 5-Recuperado
        $user = Auth::user();
        $expediente = Expediente::findOrFail($request->expediente_id);

        $historial = new Historial;
        $historial->expediente_id = $expediente->id;
        $historial->user_id = $user->id;
        $historial->area_origen_id = $expediente->historiales->last()->area_origen_id;
        $historial->area_destino_id = $user->area_id;
        $historial->fojas = $expediente->fojas;
        $historial->fecha = Carbon::now()->format('Y-m-d');
        $historial->hora = Carbon::now()->format('h:i');
        $historial->motivo = "Pase aceptado";
        $historial->estado = $request->estado_expediente;
        $expediente->estado_expediente_id = $request->estado_expediente;
        /*
        * Si el estado al que cambia es 3 (mis expediente), Actualizo el area actual del expediente.
        */
        if ($request->estado_expediente == 3 or $request->estado_expediente == 5) {
            $expediente->area_actual_id = $user->area_id;
            $expediente->update();
            if ($request->estado_expediente == 5)
            {
                $historial->motivo = "Pase recuperado";
                $historial->estado = 5;
                $expediente->estado_expediente_id = 5;
                $expediente->save();
            }
        }
        else
        {
            $expediente->update();
        }

        $historial->save();

        $estado = $request->estado;//parametro
        $bandeja = $request->bandeja;
        $user_id = $user->id;
        $listado_expedientes = Expediente::listadoExpedientes($user_id, $bandeja);
        return response()->json($listado_expedientes,200);

        /*   Datos de prueba
        {
            "expediente_id": 1,
            "user_id" : 1,
            "estado_expediente": 3,
            "estado" : 3,
            "bandeja": 3
        }
        */
    }

    /*
        Metodo que reasigna un expediente de un usuario a otro de la misma area.
    */
    public function regresarExpediente(Request $request)
    {
        DB::beginTransaction();
        $user = Auth::user();
        $expediente = Expediente::findOrFail($request->expediente_id);
        $historial_exp = Historial::all()->where('expediente_id', $request->expediente_id)->last();
        $historial = new Historial;
        $historial->expediente_id = $expediente->id;
        $historial->user_id = $user->id;
        $historial->area_origen_id = $user->area_id;
        $historial->area_destino_id = $user->area_id;
        $historial->fojas = $expediente->fojas;
        $historial->fecha = Carbon::now()->format('Y-m-d');
        $historial->hora = Carbon::now()->format('h:i');
        $historial->motivo = "Reasignado al usuario: " . $user->persona->nombre . " " . $user->persona->apellido;
        $historial->observacion = $historial_exp->observacion;
        $historial->nombre_archivo = $historial_exp->nombre_archivo;
        $historial->fojas_aux = $historial_exp->fojas_aux;
        $historial->estado = 3;
        $expediente->estado_expediente_id = 3;
        $expediente->update();
        $historial->save();
        $listado = Expediente::listadoExpedientes($user->id, 7);
        DB::commit();
        return response()->json($listado, 200);
    }

    /*
    *   Trae el historial completo de un expediente.
    */
    public function historialExpediente_old(Request $request)
    {
        $expediente = Expediente::findOrFail($request->id);
        $array = [];
        foreach ($expediente->historiales as $historial)
        {
                array_push($array, $historial->getHistorial());
        }
        $array = array_reverse($array);
        return response()->json($array, 200);

        return response()->json($expediente, 200);
    }

    public function historialExpediente(Request $request)
    {
        $historiales = DB::table('historiales')
                         ->where('historiales.expediente_id',$request->id)
                         ->join('expedientes','expedientes.id','=','historiales.expediente_id')
                         ->join('users','users.id','=','historiales.user_id')
                         ->join('personas','personas.id','=','users.persona_id')
                         ->join('caratulas','caratulas.expediente_id','=','expedientes.id')
                         ->join('extractos','extractos.id','=','caratulas.extracto_id')
                         ->join('areas as area_origen','area_origen.id','=','historiales.area_origen_id')
                         ->join('areas as area_destino','area_destino.id','=','historiales.area_destino_id')
                         ->orderBy('historiales.created_at', 'DESC')
                         ->get([
                             'historiales.expediente_id as expediente_id',
                             'expedientes.nro_expediente as nro_expediente',
                             'extractos.descripcion as extracto',
                             'historiales.area_origen_id as area_origen_id',
                             'historiales.area_destino_id as area_destino_id',
                             'area_origen.descripcion as area_origen',
                             'area_destino.descripcion as area_destino',
                             'users.id as user_id',
                             DB::raw("CONCAT(personas.nombre,', ',personas.apellido) as nombre_usuario"),
                             DB::raw("DATE_FORMAT(historiales.created_at, '%d-%m-%y %h:%i:%s') as fecha"),
                             'historiales.motivo as motivo',
                             DB::raw("DATE_FORMAT(historiales.created_at, '%h:%i:%s') as hora"),
                            ]);

        return response()->json($historiales, 200);
    }

    /*
    * Devuelve los expedientes enviados de un usuario
    */
    public function misEnviados_old(Request $request)
    {
        //return response()->json(auth()->user()->area_id, 200);
        if ($request->all == false){
            $misExpEnviados = Historial::all()/*(auth()->user()->id)*/;
        }
        else{ //Si user_id == null  trae todos los Exp. Enviados del area
            $misExpEnviados = Historial::ExpedientesEnviados(auth()->user()->area_id, auth()->user()->id);
        }
    }

    /**
     * Método que retorna los expedientes enviados por toda un área, o un usuario específico
     * @param: all [boolean] / True "todos los enviados del área / "False" solo los enviados del usuario logueado
     * @autor: Mariano Flores
     */
    public function misEnviados(Request $request)
    {
        $misExpEnviados = Historial::ExpedientesEnviados($request->all);
        return response()->json($misExpEnviados, 200);

        /*   Datos de prueba
        {
            "user_id" : 1,
            "area_id": 13,
        }
        */
    }
}
