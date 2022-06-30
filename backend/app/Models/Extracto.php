<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracto extends Model
{
    use HasFactory;

    public function caratula() 
    {
        return $this->hasOne('App\Models\Caratula');
    }

    public function iniciador() 
    {
        return $this->hasOne('App\Models\Iniciador');
    }
}
