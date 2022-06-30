<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    public function expediente() 
    {
        return $this->belongsTo('App\Models\Expediente');
    }

    public static function index()
    {
        $pagos = Pago::all();
        $array_pagos = collect([]);
        foreach ($pagos as $pago)
        {
            $array_pagos->push([
                                'id'            => $pago->id,
                                'expediente_id' => $pago->expediente->id,
                                'nro'           => $pago->nro,
                                'tipo'          => $pago->tipo,
                                'estado'        => $pago->estado,
                                'monto'         => $pago->monto,
                                'fecha'         => date("d-m-Y", strtotime($pago->fecha)),
                                'titular'       => $pago->titular,
                                'banco'         => $pago->banco
            ]);
        }
        return $array_pagos;
    }

    public function getDatos()
    {
        $array_pagos = collect([]);
        $array_pagos->push([
                            'id'            => $this->id,
                            'expediente_id' => $this->expediente->id,
                            'nro'           => $this->nro,
                            'tipo'          => $this->tipo,
                            'estado'        => $this->estado,
                            'monto'         => $this->monto,
                            'fecha'         => date("d-m-Y", strtotime($this->fecha)),
                            'titular'       => $this->titular,
                            'banco'         => $this->banco
        ]);
        return $array_pagos;
    }
}
