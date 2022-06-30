<?php

namespace Database\Seeders;

use App\Models\TipoEntidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEntidadSeeder extends Seeder
{

    private $arrayTiposEntidad = [
        'Ministerios y Reparticiones',
        'Entes Autárquicos y Descentralizados',
        'Entes de Carácter Comercial – Sociedades del Estado',
        'Cuentas Especiales',
        'Persona Física'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_entidad')->delete();
        foreach($this->arrayTiposEntidad as $TipoEntidad){
            $te = new TipoEntidad;
            $te->descripcion = $TipoEntidad;
            $te->save();
        }
    }
}
