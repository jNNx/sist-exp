<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    use HasFactory;

    protected $table = "historiales";

    public function areaOrigen()
    {
        return $this->hasOne('App\Models\Area','id','area_origen_id');
    }

    public function areaDestino()
    {
        return $this->hasOne('App\Models\Area','id','area_destino_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expediente()
    {
        return $this->hasOne('App\Models\Expediente', 'id', 'expediente_id');
    }

    public function getHistorial()
    {
        $array=Collect([
            'expediente_id'     =>$this->expediente->id,
            'nro_expediente'    =>$this->expediente->nro_expediente,
            'extracto'          =>$this->expediente->caratula->extracto->descripcion,
            'area_origen_id'    =>$this->areaOrigen->id,
            'area_origen'       =>$this->areaOrigen->descripcion,
            'area_destino_id'   =>$this->areaDestino->id,
            'area_destino'      =>$this->areaDestino->descripcion,
            'user_id'           =>$this->user->id,
            'nombre_usuario'    =>$this->user->persona->nombre . ", " . $this->user->persona->apellido,
            'fecha'             =>date("d-m-Y", strtotime($this->fecha)),
            'motivo'            =>$this->motivo,
            'hora'              =>$this->hora
        ]);
        return $array;
    }

    /*
    * Devuelve todos los expedientes enviados de un usuario
    *
    */
    public static function ExpedientesEnviados_old($area_id,$user_id = 0)
    {
        $array = Collect();
        $historiales = Historial::all()->where("area_origen_id",$area_id);
        #Si $user_id == 0 (parametro opcional) trae todos los expedientes filtrados solo por area.
        if ($user_id > 0){
            $historiales = $historiales->where("user_id",$user_id);
        }
                                       
    #ACLARACION: Hago este filtro porque cuando el area_destino_id = area_origen_id significa que no se realizo ningun pase (o se envio) el exp,
    #sino que solo se cambio el estado:
        $historiales = $historiales->where("area_destino_id","!=", $area_id ); 
        
        foreach($historiales as $historial){
            $array->push($historial->getHistorial());
        }
        return $array;
    }

    /**
     * Devuelve todos los expedientes enviados por un usuario, o todos los expedientes enviados por el área
     * @param: all [boolean]  / true "devuelve todos los expedientes del área / false "devuelve solo los del usuario logueado
     * Autor: Mariano Flores
     */
    public static function ExpedientesEnviados($all)
    {
        if($all == true)
        {   
            $area_destino = DB::table('historiales')
                ->select('historiales.id', 'expediente_id', 'historiales.area_destino_id', 'areas.descripcion')
                ->where('historiales.area_origen_id', '=', auth()->user()->area_id)
                //->where('historiales.area_destino_id', '!=', auth()->user()->area_id)
                ->where('historiales.motivo', '!=', "Expediente creado.")
                ->where('historiales.estado', '!=', 3)
                ->join('areas', 'areas.id', '=', 'historiales.area_destino_id');

            $array = DB::table('historiales')
                ->where('historiales.area_origen_id', '=', auth()->user()->area_id)
                //->where('historiales.area_destino_id', '!=', auth()->user()->area_id)
                ->where('historiales.motivo', '!=', "Expediente creado.")
                ->where('historiales.estado', '!=', 3)
                ->join('expedientes', 'expedientes.id', '=', 'historiales.expediente_id')
                ->join('caratulas', 'caratulas.expediente_id', '=', 'expedientes.id')
                ->join('extractos', 'extractos.id', '=', 'caratulas.extracto_id')
                ->join('areas', 'areas.id', '=', 'historiales.area_origen_id')
                ->joinSub($area_destino, 'areaDestino', function($join)
                {
                    $join->on('historiales.id', '=', 'areaDestino.id');
                })
                ->join('personas', 'personas.id', '=', 'historiales.user_id')
                ->select('expedientes.id as expediente_id', 
                         'expedientes.nro_expediente',
                         'extractos.descripcion as extracto',
                         'historiales.area_origen_id',
                         'areas.descripcion',
                         'areaDestino.area_destino_id',
                         'areaDestino.descripcion as area_destino',
                         'historiales.user_id',
                         DB::raw("CONCAT(personas.nombre,', ',personas.apellido) as nombre_usuario"),
                         DB::raw("DATE_FORMAT(historiales.created_at, '%d-%m-%y %h:%i:%s') as fecha"),
                         'historiales.motivo as motivo',
                         'historiales.observacion')
                ->orderBy('historiales.id', 'DESC')
                ->get();
            return($array);
        }
        else
        {
            $area_destino = DB::table('historiales')
                ->select('historiales.id', 'expediente_id', 'historiales.area_destino_id', 'areas.descripcion')
                ->where('historiales.area_origen_id', '=', auth()->user()->area_id)
                //->where('historiales.area_destino_id', '!=', auth()->user()->area_id)
                ->where('historiales.motivo', '!=', "Expediente creado.")
                ->where('historiales.estado', '!=', 3)
                ->join('areas', 'areas.id', '=', 'historiales.area_destino_id');

            $array = DB::table('historiales')
                ->where('historiales.area_origen_id', '=', auth()->user()->area_id)
                //->where('historiales.area_destino_id', '!=', auth()->user()->area_id)
                ->where('historiales.motivo', '!=', "Expediente creado.")
                ->where('historiales.estado', '!=', 3)
                ->where('historiales.user_id', '=', auth()->user()->id)
                ->join('expedientes', 'expedientes.id', '=', 'historiales.expediente_id')
                ->join('caratulas', 'caratulas.expediente_id', '=', 'expedientes.id')
                ->join('extractos', 'extractos.id', '=', 'caratulas.extracto_id')
                ->join('areas', 'areas.id', '=', 'historiales.area_origen_id')
                ->joinSub($area_destino, 'areaDestino', function($join)
                {
                    $join->on('historiales.id', '=', 'areaDestino.id');
                })
                ->join('personas', 'personas.id', '=', 'historiales.user_id')
                ->select('expedientes.id as expediente_id', 
                         'expedientes.nro_expediente',
                         'extractos.descripcion as extracto',
                         'historiales.area_origen_id',
                         'areas.descripcion',
                         'areaDestino.area_destino_id',
                         'areaDestino.descripcion as area_destino',
                         'historiales.user_id',
                         DB::raw("CONCAT(personas.nombre,', ',personas.apellido) as nombre_usuario"),
                         DB::raw("DATE_FORMAT(historiales.created_at, '%d-%m-%y %h:%i:%s') as fecha"),
                         'historiales.motivo as motivo',
                         'historiales.observacion')
                ->orderBy('historiales.id', 'DESC')
                ->get();
            return($array);
        }
    }
}
