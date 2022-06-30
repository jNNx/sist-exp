<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoUser;

class TipoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUser::create(['descripcion' => 'Administrador Area']);
        TipoUser::create(['descripcion' => 'Empleado']);  
    }
}
