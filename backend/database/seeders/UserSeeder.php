<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Persona
        DB::insert("INSERT INTO sistexpedientes.personas (dni, nombre, apellido, telefono, email, direccion, created_at, updated_at) VALUES
        (00133700, 'Juan', 'Romero ', NULL, NULL, NULL, NULL, NULL),
        (00133702, 'Julio', 'Escobar ', NULL, NULL, NULL, NULL, NULL)
        ");
        //User
        DB::insert("INSERT INTO sistexpedientes.users (persona_id, area_id, tipo_user_id, cuil, remember_token, created_at, updated_at, deleted_at) VALUES
        (1, 13, 1, 27001337001, NULL, '2022-07-05 13:37:00', '2022-07-05 13:37:00', NULL),
        (2, 15, 1, 27001337002, NULL, '2022-07-05 13:37:00', '2022-07-05 13:37:00', NULL)
        ");

        $users = User::all();
        foreach ($users as $user)
        {
            $user->password=  Hash::make($user->cuil);
            $user->update();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->required()->change();
        });
    }
}
