<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cedula extends Model
{
    use HasFactory;

    public function expediente()
    {
        return $this->hasOne(Expediente::class, 'id', 'expediente_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function index()
    {
        $cedulas = Cedula::all();
        $array_cedulas = collect([]);
        foreach ($cedulas as $cedula)
        {
            $array_cedulas->push([
                                'cedula_id'         => $cedula->id,
                                'user'              => $cedula->user->persona->nombre ." " . $cedula->user->persona->apellido,
                                'nro_expediente'    => $cedula->expediente->nro_expediente,
                                'extracto'          => $cedula->expediente->caratula->extracto->descripcion,
                                'descripcion'       => $cedula->descripcion
                            ]);
        }
        return $array_cedulas;
    }

    public function getDatos()
    {
        $array_cedula = collect([]);
        $array_cedula->push([
                            'cedula_id'         => $this->id,
                            'user'              => $this->user->persona->nombre ." " . $this->user->persona->apellido,
                            'nro_expediente'    => $this->expediente->nro_expediente,
                            'extracto'          => $this->expediente->caratula->extracto->descripcion,
                            'descripcion'       => $this->descripcion,
                           ]);
        return $array_cedula;
    }

}
