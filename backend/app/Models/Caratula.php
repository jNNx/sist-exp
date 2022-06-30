<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caratula extends Model
{
    use HasFactory;

    public function expediente() 
    {
        return $this->hasOne('App\Models\Expediente','id','expediente_id');
    }

    public function responsable() 
    {
        return $this->hasOne('App\Models\Responsable');
    }

    public function extracto() 
    {
        return $this->hasOne('App\Models\Extracto','id','extracto_id');
    }

    public function iniciador()
    {
        return $this->hasOne('App\Models\Iniciador', 'id', 'iniciador_id');
    }

    public function getObservacionAttribute($value)
    {
        if($value == "")
        {
            return "-";
        }

        return $value;
    }
}
