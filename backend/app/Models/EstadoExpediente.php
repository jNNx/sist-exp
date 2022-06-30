<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoExpediente extends Model
{
    use HasFactory;

    public function expedientes() 
    {
        return $this->hasMany('App\Models\Expediente');
    }
}
