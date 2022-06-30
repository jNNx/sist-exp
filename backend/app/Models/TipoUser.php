<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUser extends Model
{
    use HasFactory;

    public static function get_tipo_users() 
    {
        $tipo_users = TipoUser::all();
        $array_tipo_users = Collect([]);
        foreach ($tipo_users as $tipo) {
            $array_tipo_users->push(['id'=>$tipo->id,
                                     'descripcion'=>$tipo->descripcion]);
        }
        return $array_tipo_users;
    }

    public function users() 
    {
        return $this->hasMany('App\Models\TipoUser');
    }
}
