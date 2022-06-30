<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrioridadExpediente;
use Illuminate\Support\Facades\DB;


class PrioridadExpedienteSeeder extends Seeder
{
    public function run()
    {
        $prioridades = [
            'alta',
            'normal'
        ];
        foreach($prioridades as $pri){
            $p = new PrioridadExpediente();
            $p->descripcion = $pri;
            $p->save();
        }
    }
}
