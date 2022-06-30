<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoExpediente extends Model
{
    use HasFactory;

    public function expedientes() 
    {
        return $this->hasMany('App\Models\Expedientes');
    }

    //se asigna un numero interno al expediente 
    public static function nroExpediente($tipo_exp, $prefijo)
    {
        $fecha = Carbon::now();
        $nro_exp = TipoExpediente::find($tipo_exp)->nro_tipo_exp .
                $fecha->format('Y') . 
                $fecha->format('m') . 
                $fecha->format('d');
        $nro_exp = $nro_exp . $prefijo;
        return $nro_exp;
    }

    public static function motivosConExtractos()
    {
        $extractos = TipoExpediente::all();
        $sinExtractos = $extractos->except([5,6,12,14,16,19,22,23]);
        return $sinExtractos;
    }
}
