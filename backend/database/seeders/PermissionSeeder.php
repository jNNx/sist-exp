<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $roleAdmArea = Role::create(['name' => 'ADMINISTRADOR AREA']); 
        $roleEmpleado = Role::create(['name' => 'EMPLEADO']);
        
        //Permisos para el rol ADMINISTRADOR AREA
        $permiso = Permission::create(['name' => 'AGREGAR INICIADOR']);  
        //$permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'CREAR EXPEDIENTE']); 
        //$permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'UNIR EXPEDIENTES']); 
        //$permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'AGREGAR CEDULA']); 
        //$permiso->assignRole($roleAdmArea);   

        //Permisos para el rol EMPLEADO
        /*
        $permiso = Permission::create(['name' => 'VER EXPEDIENTE']);
        $permiso->assignRole($roleEmpleado);
        $permiso = Permission::create(['name' => 'REASIGNAR PASE']); 
        $permiso->assignRole($roleEmpleado);  
        */
    }
}
