<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = "notificaciones";

    public function expediente()
    {
        return $this->hasOne('App\Models\Expediente', 'id', 'expediente_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function index()
    {
        $notificaciones = Notificacion::all()->where('estado', 1);
        $array_notificacion = collect([]);
        foreach ($notificaciones as $notificacion)
        {
            $array_notificacion->push([
                                'id'                => $notificacion->id,
                                'nro_expediente'    => $notificacion->expediente->nro_expediente,
                                'user_creacion'     => $notificacion->expediente->historiales->first()->user->persona->nombre ." " . $notificacion->expediente->historiales->first()->user->persona->apellido,
                                'area'              => $notificacion->user->area->descripcion,
                                'fecha'             => $notificacion->created_at->format('d-m-Y'),
                                'extracto'          => $notificacion->expediente->caratula->extracto->descripcion,
                                'estado'            => $notificacion->estado,
                            ]);
        }
        return $array_notificacion;
        //Expediente::find(3)->historiales->first()->user->persona->nombre
    }

    public function getDatos()
    {
        $array_notificacion = collect([]);
        $array_notificacion->push([
                                'id'                => $this->id,
                                'nro_expediente'    => $this->expediente->nro_expediente,
                                'user_id'           => $this->user->id,
                                'nombre'            => $this->user->persona->nombre ." " . $this->user->persona->apellido,
                                'area'              => $this->user->area->descripcion,
                                'fecha'             => $this->created_at->format('d-m-Y'),
                                'estado'            => $this->estado,
                            ]);
        return $array_notificacion;
    }


    public static function listadoExpedientesSubsidioAporteNR()
    {
        $expedientes = DB::table('notificaciones')
                    ->join('expedientes', 'expedientes.id', '=', 'notificaciones.expediente_id')
                    ->join('prioridad_expedientes', 'expedientes.prioridad_id', '=', 'prioridad_expedientes.id')
                    ->join('caratulas', 'expedientes.id', '=', 'caratulas.expediente_id')
                    ->join('estado_expedientes', 'expedientes.estado_expediente_id', '=', 'estado_expedientes.id')
                    ->join('extractos', 'caratulas.extracto_id', '=', 'extractos.id')
                    ->join('tipo_expedientes', 'expedientes.tipo_expediente', '=', 'tipo_expedientes.id')
                    ->join('historiales', 'historiales.id', '=', 'expedientes.id')
                    ->join('areas', 'areas.id', '=', 'expedientes.area_actual_id')
                    ->where('historiales.estado', '=', 1) 
                    ->select('expedientes.nro_expediente as nroExpediente',
                             'expedientes.fecha as fecha_creacion',
                             'prioridad_expedientes.descripcion as prioridad',
                             'extractos.descripcion as extracto',
                             'tipo_expedientes.descripcion as tipoExpediente',
                             'expedientes.fojas as cantFojas',
                             'areas.descripcion as descripcionArea',
                             'historiales.hora as hora',
                             DB::raw('ceil(expedientes.fojas / 200) as cantCuerpos'))
                    ->orderBy('expedientes.id', 'DESC')                 
                    ->get();
        return $expedientes;
    }
}
