<?php

namespace App\Models;

use App\Models\Cedula;
use App\Models\Caratula;
use App\Models\Historial;
use App\Models\Iniciador;
use Illuminate\Http\Request;
use App\Models\EstadoExpediente;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expediente extends Model
{
    use HasFactory;

    public function caratula()
    {
        return $this->hasOne(Caratula::class);
    }

    public function tipoExpediente()
    {
        return $this->hasOne('App\Models\TipoExpediente','id','tipo_expediente');
    }

    public function estadoExpediente()
    {
        return $this->hasOne(EstadoExpediente::class);
    }

    public function prioridadExpediente()
    {
        return $this->hasOne('App\Models\PrioridadExpediente','id','prioridad_id');
        //$this->hasOne(Phone::class, 'foreign_key', 'local_key');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function area()
    {
        //return $this->morphTo(__FUNCTION__, 'area_actual_type', 'area_actual_id');
        return $this->hasOne('App\Models\Area','id','area_actual_id');
    }

    public function historiales()
    {
        return $this->hasMany(Historial::class);
    }

    public function hijos()
    {
        return $this->hasMany(Expediente::class,'expediente_id');
    }

    public function padre()
    {
        return $this->belongsTo(Expediente::class,'expediente_id');
    }

    public function cantidadCuerpos()
    {
        return ceil($this->fojas/200);
    }

    public function cedulas()
    {
        return $this->hasMany(Cedula::class);
    }

    CONST EXTENSIONES_PERMITIDAS = [
        'docx',
        'pdf',
        'txt',
        'jpg',
        'jpeg',
        'xlsx',
        'xls',
    ];

    //Metodo que calcula peso total de archivos
    public static function peso(Request $array)
    {
        $array = $array->allFiles();
        $sum = 0;
        foreach($array as $a)
        {
            $sum = $sum + filesize($a);
        }
        return $sum;
    }

    public static function detalle_cedulas($expediente_id)
    {
        $expediente = Expediente::find($expediente_id);
        $cedulas = Cedula::all()->where('expediente_id', $expediente_id);
        $array = collect([]);
        foreach ($cedulas as $cedula)
        {
            $array->push([
                        'cedula_id'         => $cedula->id,
                        'user'              => $cedula->user->persona->nombre ." " . $cedula->user->persona->apellido,
                        'nro_expediente'    => $expediente->nro_expediente,
                        'extracto'          => $expediente->caratula->extracto->descripcion,
                        'nro_cedula'        => $cedula->descripcion,
                        'cantidad'          => $expediente->cedulas()->count()
            ]);
        }
        return $array;
    }

    /*
    * Retorna una colleccion con los datos del expediente
    */
    public function getDatos()
    {
        $array = Collect([
                          "id"   => $this->id,
                          "expediente_id"   => $this->expediente_id,
                          //"nro_expediente" => $this->nroExpediente($this->caratula->iniciador->prefijo, date("d-m",strtotime($this->fecha)),date("Y",strtotime($this->fecha))),
                          "nro_expediente"  => $this->nro_expediente,
                          "fecha"           => date("d-m-Y", strtotime($this->fecha)),
                          "iniciador"       => $this->caratula->iniciador->nombre,
                          "apellido"        => $this->caratula->iniciador->apellido,
                          "cuit"            => $this->caratula->iniciador->cuit,
                          "cuil"            => $this->caratula->iniciador->cuil,
                          "extracto"        => $this->caratula->extracto->descripcion,
                          "area_actual"     => $this->area->descripcion,
                          "cantidad_cedulas"=> $this->cedulas->count()
                        ]);
        return $array;
    }

    public function datosExpediente_old()
    {
        $array = Collect(['id'                  => $this->id,
                          'prioridad'           => $this->prioridadExpediente->descripcion,
                          'nro_expediente'      => $this->nro_expediente,
                          'extracto'            => $this->caratula->extracto->descripcion,
                          'fecha_creacion'      => $this->created_at->format('d-m-Y'),
                          'tramite'             => $this->tipoExpediente->descripcion,
                          'cuerpos'             => $this->cantidadCuerpos(),
                          'caratula'            => $this->caratula->id,
                          'fojas'               => $this->fojas,
                          'area_actual'         => $this->area->descripcion,
                          'area_origen'         => $this->historiales->last()->areaOrigen->descripcion,
                          'archivo'             => $this->archivos,
                          'cantidad_cedulas'    => $this->cedulas->count()
            ]);

        return $array;
    }

    /**
     * Método que devuelve todos los expedientes
     * Autor: Mariano Flores
     */
    public static function datosExpediente()
    {
        $area_origen = DB::table('historiales')
                        ->select('expediente_id', DB::raw('MAX(fecha)'), 'areas.descripcion')
                        ->join('areas', 'areas.id', '=', 'historiales.area_origen_id')
                        ->groupBy('historiales.expediente_id', 'areas.descripcion');

        $query = DB::table('expedientes')
                        ->select('expedientes.id',
                                 'prioridad_expedientes.descripcion as prioridad',
                                 'expedientes.nro_expediente',
                                 'extractos.descripcion as extracto',
                                 'expedientes.fecha as fecha_creacion',
                                 'tipo_expedientes.descripcion as tramite',
                                 DB::raw('ceil(expedientes.fojas / 200) as cuerpos'),
                                 'caratulas.id as caratula',
                                 'expedientes.fojas',
                                 'areas.descripcion as area_actual',
                                 'areaOrigen.descripcion as area_origen',
                                 'expedientes.archivos as archivo'
                                 )
                        ->where('expedientes.expediente_id', '=', null)
                        ->joinSub($area_origen, 'areaOrigen', function($join)
                        {
                            $join->on('expedientes.id', '=', 'areaOrigen.expediente_id');
                        })
                        ->join('prioridad_expedientes', 'prioridad_expedientes.id', '=', 'expedientes.prioridad_id')
                        ->join('caratulas', 'expedientes.id', '=', 'caratulas.expediente_id')
                        ->join('extractos', 'caratulas.extracto_id', '=', 'extractos.id')
                        ->join('tipo_expedientes', 'expedientes.tipo_expediente', '=', 'tipo_expedientes.id')
                        ->join('areas', 'areas.id', '=', 'expedientes.area_actual_id')
                        ->orderBy('expedientes.id')
                        ->get();
        return $query;
    }

    /**
     * Método index replanteado utilizando Query Builder
     * Autor: Mariano Flores
     */
    public static function index()
    {
        $expediente = DB::table('expedientes')
                        ->where('expedientes.expediente_id', '=', null)
                        ->join('prioridad_expedientes', 'prioridad_expedientes.id', '=', 'expedientes.prioridad_id')
                        ->join('caratulas', 'caratulas.expediente_id', '=', 'expedientes.id')
                        ->join('extractos', 'extractos.id', '=', 'caratulas.extracto_id')
                        ->join('tipo_expedientes', 'tipo_expedientes.id', '=', 'expedientes.tipo_expediente')
                        ->join('areas', 'areas.id', '=', 'expedientes.area_actual_id')
                        ->join('iniciadores','caratulas.iniciador_id', 'iniciadores.id')
                        ->select(   'expedientes.id as id',
                                    'prioridad_expedientes.descripcion as prioridad',
                                    'expedientes.nro_expediente',
                                    'extractos.descripcion as extracto',
                                    'expedientes.fecha as fecha_creacion',
                                    'tipo_expedientes.descripcion as tramite',
                                    'areas.descripcion as area_actual',
                                    DB::raw('ceil(expedientes.fojas / 200) as cantCuerpos'),
                                    'caratulas.id as caratula',
                                    'expedientes.fojas',
                                    'expedientes.nro_expediente_ext',
                                    'iniciadores.nombre as iniciador_nombre',
                                    'iniciadores.email',
                                    'caratulas.observacion',
                                    'expedientes.nro_expediente_ext as nro_siif'
                                )
                        ->orderBy('expedientes.id', 'DESC')
                        ->get();
        return $expediente;
    }

    public static function nroExpediente($año_exp)
    {
        $expedientes =  DB::table('expedientes')
                        ->whereYear('fecha', $año_exp)
                        ->get();
        $cont = $expedientes->count() + 1;
        $nro_aleatorio = str_pad($cont,5,"0",STR_PAD_LEFT);
        $nro_exp = Iniciador::NRO_INICIADOR . '-'. $nro_aleatorio . '/' . $año_exp;
        return $nro_exp;
    }

    /**
     * Método que devuelve el listado de expedientes según bandeja seleccionada y área del usuario logueado
     * @param: id usuario
     * @param: id bandeja
     * Autor: Mariano Flores
     */
    public static function listadoExpedientes($user_id, $bandeja)
    {
        $user = User::findOrFail($user_id);
        //devuelve solo el 'id' del historial, del ultimo movimiento del expediente
        $id_ultimos_movimientos = DB::table('historiales')
                        ->select(DB::raw('MAX(id) as id_movimiento'))
                        ->groupBy('expediente_id');

        //devuelve las areas para join con origen
        $areas_o = DB::table('areas')
                        ->select('id as area_id_origen', 'descripcion as area_descripcion_origen');

        //devuelve las areas para join con destino
        $areas_d = DB::table('areas')
                        ->select('id as area_id_destino', 'descripcion as area_descripcion_destino');

        //devuelve los expedientes que son padres
        $exp_padres = DB::table('expedientes')
            ->join('expedientes as exp','exp.expediente_id','expedientes.id')
            ->select('exp.expediente_id')
            ->groupBy('exp.expediente_id');
            //->get('exp.expediente_id');

    
        //recupera el registro completo del historial del último movimiento del expediente
        $historial_ultimo_movimiento = DB::table('historiales')
                        ->select('expedientes.id as expediente_id',
                                'expedientes.expediente_id as expediente_padre',
                                 'prioridad_expedientes.descripcion as prioridad',
                                 'expedientes.nro_expediente as nro_expediente',
                                 'extractos.descripcion as extracto',
                                 DB::raw("DATE_FORMAT(expedientes.created_at, '%d-%m-%Y') as fecha_creacion"),
                                 'tipo_expedientes.descripcion as tramite',
                                 DB::raw('truncate((expedientes.fojas / 200), 0) + 1 as cant_cuerpos'),
                                 'expedientes.fojas as fojas',
                                 'iniciadores.nombre as iniciador',
                                 'iniciadores.cuit as cuit_iniciador',
                                 'areasDeOrigen.area_id_origen as area_origen_id',
                                 'areasDeOrigen.area_descripcion_origen as area_origen',
                                 'areasDeDestino.area_id_destino as area_destino_id',
                                 'areasDeDestino.area_descripcion_destino as area_destino',
                                 'expedientes.estado_expediente_id as estado',
                                 'historiales.user_id as user_id',
                                 'expedientes.archivos as archivos',
                                 'caratulas.observacion as observacion',
                                 'historiales.observacion as observacion_pase',
                                 'historiales.hora as hora',
                                 'historiales.fecha as fecha',
                                 DB::raw("CONCAT(personas.nombre, ' ', personas.apellido) as nombre_apellido"),
                                 'padres.expediente_id as hijos'
                                 )
                        ->joinSub($id_ultimos_movimientos, 'ultimo_movimiento_expediente', function($join)
                        {
                            $join->on('historiales.id', '=', 'ultimo_movimiento_expediente.id_movimiento');
                        })
                        ->joinSub($areas_o, 'areasDeOrigen', function($join)
                        {
                            $join->on('historiales.area_origen_id', "=", 'areasDeOrigen.area_id_origen');
                        })
                        ->joinSub($areas_d, 'areasDeDestino', function($join)
                        {
                            $join->on('historiales.area_destino_id', "=", 'areasDeDestino.area_id_destino');
                        })
                        ->LeftJoinSub($exp_padres, 'padres', function($join)
                        {
                            $join->on('historiales.expediente_id', "=", 'padres.expediente_id');
                        })
                        ->join('expedientes', 'historiales.expediente_id', '=', 'expedientes.id')
                        ->join('prioridad_expedientes', 'expedientes.prioridad_id', '=', 'prioridad_expedientes.id')
                        ->join('caratulas', 'expedientes.id', '=', 'caratulas.expediente_id')
                        ->join('extractos', 'caratulas.extracto_id', '=', 'extractos.id')
                        ->join('tipo_expedientes', 'expedientes.tipo_expediente', '=', 'tipo_expedientes.id')
                        ->join('iniciadores', 'caratulas.iniciador_id', '=', 'iniciadores.id')
                        ->join('users', 'historiales.user_id', '=', 'users.id')
                        ->join('personas', 'users.persona_id', '=', 'personas.id')
                        ->whereNull('expedientes.expediente_id'); //solo expedientes padres

                        if ($bandeja == 1) {
                            return $historial_ultimo_movimiento ->where('area_destino_id', $user->area_id)
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->where('estado', 1)
                                                                ->get();
                        }
                        if ($bandeja == 3) {                            
                            return $historial_ultimo_movimiento ->where('area_destino_id', $user->area_id)
                                                                ->where('user_id', $user->id)
                                                                ->whereIn('estado', [5,3])
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->get();
                            
                        }
                        if ($bandeja == 4) {
                            return $historial_ultimo_movimiento ->where('area_origen_id', $user->area_id)
                                                                ->where('user_id', $user->id)
                                                                ->where('estado', 1)
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->get();
                        }
                        if ($bandeja == 5) {
                            return $historial_ultimo_movimiento ->where('estado', 6)
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->get();
                        }
                        if ($bandeja == 6) {
                            return $historial_ultimo_movimiento ->where('area_destino_id', $user->area_id)
                                                                ->whereIn('estado', [5,3])
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->get();
                        }
                        if ($bandeja == 7) // bandeja de expedientes del area completa
                        {
                            return $historial_ultimo_movimiento ->where('area_destino_id', $user->area_id)
                                                                ->whereIn('estado', [5,3])
                                                                ->orderBy('prioridad', 'asc')
                                                                ->orderBy('fecha', 'asc')
                                                                ->orderBy('hora', 'asc')
                                                                ->get();
                        }
    }

    /**
     * Método que devuelve la cantidad de expedientes pendientes por aceptar según el área del usuario logueado
     * @param: id usuario
     * Autor: Mariano Flores
     */
    public static function contadorBandejaEntrada($user_id)
    {
        $user = User::findOrFail($user_id);
        //devuelve solo el 'id' del historial, del ultimo movimiento del expediente
        $id_ultimos_movimientos = DB::table('historiales')
                        ->select(DB::raw('MAX(id) as id_movimiento'))
                        ->groupBy('expediente_id');

        $en_bandeja_entrada = DB::table('historiales')
                        ->select('historiales.estado', 'historiales.area_destino_id')
                        ->joinSub($id_ultimos_movimientos, 'ultimo_movimiento_expediente', function($join)
                        {
                            $join->on('historiales.id', '=', 'ultimo_movimiento_expediente.id_movimiento');
                        })
                        ->where('estado', 1)
                        ->where('area_destino_id', $user->area_id);

        return $en_bandeja_entrada;
    }

    /*
    * Busca por nro de la tabla pagos
    */
    public static function buscarPor($valor,$busqueda)
    {
        $lista_expedientes = Collect([]);
        switch ($busqueda)
        {
            case "1": //Busca por nro_expediente
                $expediente = Expediente::where('nro_expediente', $valor)->get()->first();//Deberia retornar solo un expediente
                if ($expediente->expediente_id == null)
                {
                    $lista_expedientes->push($expediente->getDatos());
                }
                else
                {
                    $exp_padre = $expediente->padre()->first()->getDatos();
                    $exp_hijos = $expediente->getDatos();
                    $lista_expedientes->push($exp_padre, $exp_hijos, $bandera=1);
                }
                break;

            case "2": //Busca por cuit iniciador
                $iniciador_id = Iniciador::where('cuit',$valor)->orWhere('cuil',$valor)->first()->id ?? null;//->first()->id;

                //return $iniciador_id;
                if ($iniciador_id != null)
                {
                    //Recorro las caratulas del iniciador para obtener los expedientes
                    /*foreach ($iniciador->caratulas as $caratula)
                    {
                        $lista_expedientes->push($caratula->expediente->getDatos());
                    }*/

                    $expedientes = DB::table('caratulas')
                                     ->where('caratulas.iniciador_id',$iniciador_id)
                                     ->where('expedientes.expediente_id','=',null)
                                     ->join('expedientes','expedientes.id','caratulas.expediente_id')
                                     ->join('iniciadores','iniciadores.id','caratulas.iniciador_id')
                                     ->join('extractos','extractos.id','caratulas.extracto_id')
                                     ->join('areas','expedientes.area_actual_id','areas.id')
                                     //->where('expedientes.nro_expediente',null)
                                     ->orderBy('expedientes.created_at', 'DESC')
                                     ->get([
                                         'expedientes.id as id',
                                         'expedientes.expediente_id as expediente_hijo_id',
                                         'expedientes.nro_expediente as nro_expediente',
                                         DB::raw("DATE_FORMAT(expedientes.created_at, '%d-%m-%y %h:%i:%s') as fecha"),
                                         //DB::raw("CONCAT(iniciadores.nombre,', ',iniciadores.apellido) as iniciadores"),
                                         'iniciadores.nombre as iniciador',
                                         'iniciadores.apellido as apellido',
                                         'iniciadores.cuit as cuit',
                                         'iniciadores.cuil as cuil',
                                         'extractos.descripcion as extracto',
                                         'areas.descripcion as area_actual'
                                     ]);

                                     $array = Collect($expedientes,
                                        //"expediente_id"   => $expedientes->expediente_id,
                                        //"nro_expediente" => $this->nroExpediente($this->caratula->iniciador->prefijo, date("d-m",strtotime($this->fecha)),date("Y",strtotime($this->fecha))),
                                        //"nro_expediente"  =>$expedientess->nro_expediente,
                                        //"fecha"           => date("d-m-Y", strtotime($this->fecha)),
                                        //"iniciador"       => $expedientes->caratula->iniciador->nombre,
                                        //"cuit"            => $expedientes->caratula->iniciador->cuit,
                                        //"extracto"        => $expedientes->caratula->extracto->descripcion,
                                        //"area_actual"     => $expedientes->area->descripcion,
                                        //"cantidad_cedulas"=> $expedientes->cedulas->count()
                                     );
                   
                 return $array;
                   // return response()->json($expedientes->toArray(), 200);
                }
                break;
            case "3"://Busca por nro_cheque o nro_transaccion
                $pago = Pago::where('nro', $valor)->get()->first();//Deberia retornar solo un expediente
                if ($pago != null)
                {
                    $lista_expedientes->push($pago->expediente->getDatos());
                }
                break;
            case "4"://Busca por id de iniciador
                $iniciador = Iniciador::findOrFail($valor);
                //Recorro las caratulas del iniciador para obtener los expedientes
                foreach ($iniciador->caratulas as $caratula)
                {
                    $lista_expedientes->push($caratula->expediente->getDatos());
                }
                break;
            case "5": //Busca por nro_expediente_ext
                $expedienteExt = Expediente::where('expediente_id',null)->where('nro_expediente_ext', $valor)->get()->values();
                if ($expedienteExt != null)
                {
                    foreach ($expedienteExt as $expediente)
                    {
                        $lista_expedientes->push($expediente->getDatos());
                    }
                }
                break;

                case "6": //Busca por Norma Legal
                    $valor = 'NORMA LEGAL: '.$valor;
                    /*Hice asi porque de esta forma: $lista_expedientes = $lista_expedientes->where('extracto','LIKE',"%$valor%");
                    no me funcionaba la parte del: 'LIKE',"%$valor%"*/
                    $consulta = DB::table('expedientes')->join('caratulas', 'expedientes.id', '=', 'caratulas.expediente_id')
                                            ->join('extractos', 'caratulas.extracto_id', '=', 'extractos.id')
                                            ->select('expedientes.*', 'caratulas.expediente_id', 'extractos.descripcion')
                                            ->where('tipo_expediente', 3)
                                            ->where('descripcion','LIKE',"%$valor%")
                                            ->get();
                    foreach ($consulta as $item) {
                        $expediente = Expediente::FindOrFail($item->id);
                        $lista_expedientes->push($expediente->getDatos());

                    }
                    break;

                    case "7": //Busca por numero de Cedula
                        $ced = Cedula::where('descripcion',$valor)->first();
                        $exp = Expediente::FindOrFail($ced->expediente_id);
                        $lista_expedientes->push($exp->getDatos());
                        break;

        }
        return $lista_expedientes;
    }

    public static function listadoExpedientesSubsidioAporteNR()
    {
        $expedientes = DB::table('expedientes')
            ->join('prioridad_expedientes', 'expedientes.prioridad_id', '=', 'prioridad_expedientes.id')
            ->join('caratulas', 'expedientes.id', '=', 'caratulas.expediente_id')
            ->join('estado_expedientes', 'expedientes.estado_expediente_id', '=', 'estado_expedientes.id')
            ->join('extractos', 'caratulas.extracto_id', '=', 'extractos.id')
            ->join('tipo_expedientes', 'expedientes.tipo_expediente', '=', 'tipo_expedientes.id')
            ->select('expedientes.id',
                     'expedientes.nro_expediente as nroExpediente',
                     'expedientes.fecha as fecha_creacion',
                     'prioridad_expedientes.descripcion as prioridad',
                     'extractos.descripcion as extracto',
                     'tipo_expedientes.descripcion as tipoExpediente',
                     'expedientes.fojas as cantFojas',
                     DB::raw('truncate((expedientes.fojas / 200), 0) + 1 as cantCuerpos'))
            ->where('expedientes.tipo_expediente',3)
            ->orderBy('expedientes.id', 'DESC')
            ->get();
        return $expedientes;
    }
}
