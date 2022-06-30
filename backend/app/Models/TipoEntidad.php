<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntidad extends Model
{
    use HasFactory;

    protected $table = "tipos_entidad";

    public function iniciadores()
    {
        return $this->hasMany(Iniciador::class);
    }
}
