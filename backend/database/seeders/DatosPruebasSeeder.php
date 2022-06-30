<?php

namespace Database\Seeders;

use App\Models\Historial;
use App\Models\Expediente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatosPruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
            $h = new Historial();
            $h->expediente_id = Expediente::factory()->count(1)->create()->first()->id;
            $h->user_id = 1;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();

            $h = new Historial();
            $h->expediente_id = Expediente::factory()->count(1)->create()->first()->id;
            $h->user_id = 1;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();

            $h = new Historial();
            $h->expediente_id = Expediente::factory()->count(1)->create()->first()->id;
            $h->user_id = 1;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();
    }
}