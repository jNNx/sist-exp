<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Concat;

class Iniciador extends Model
{
    use HasFactory;

    protected $table = "iniciadores";
    const NRO_INICIADOR =  800;

    public function tipoEntidad()
    {
        return $this->hasOne(TipoEntidad::class, 'id','id_tipo_entidad');
    }

    public function extractos()
    {
        return $this->hasMany(Extracto::class);
    }

    public function caratulas()
    {
        return $this->hasMany(Caratula::class);
    }

    public function getCuilAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }

    public function getCuitAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }

    public function getDireccionAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }

    public function getEmailAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }

    public function getTelefonoAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }

}
