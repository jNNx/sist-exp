<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\User;
use App\Models\Persona;
use App\Models\TipoUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::index();
        return response()->json($users,200);
    }

    public function create()
    {
        //$data = Collect([]);
        //$data->push(["tipo_users" => TipoUser::get_tipo_users(),"areas" => Area::all_areas()]);
        $data = ["tipo_users" =>TipoUser::get_tipo_users(),"areas" => Area::all_areas()];
        return response()->json($data,200);
    }

    public function store(StoreUserRequest $request)
    {
        /*
        $request = new Request;
        $request->dni = '12345677';
        $request->cuil = '2123456779';
        $request->area_id = '1';
        $request->tipo_area = 'Area';
        $request->nombre = 'Juan';
        $request->apellido = 'Apellido';
        $request->telefono = '3794111111';
        $request->email = 'user@ejemplo.com';
        $request->direccion = 'Una Calle 123';
        $request->password = 'password';
        $request->comfirm_password = 'password';
        $request->tipo_user = '1';
        */
        if($request->validated())
        {
            $persona = New Persona();
            $persona->dni = $request->dni;
            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->direccion = $request->direccion;
            if($persona->save())
            {
                $user = New User();
                $user->area_id = $request->area_id;
                $user->persona_id = $persona->id;
                $user->tipo_user_id = $request->tipo_user;
                $user->cuil = $request->cuil;
                $user->password = Hash::make($request->password);
                //$user->assignRole(Role::find($request->role_id)->name);
                if($request->adminArea == "on")
                {
                    $user->giverPermissionTo(['name' => 'AGREGAR INICIADOR']);
                    $user->giverPermissionTo(['name' => 'LISTAR EXPEDIENTES DE SU AREA']);
                    $user->giverPermissionTo(['name' => 'LISTAR EXPEDIENTES (TODAS)']);
                    $user->giverPermissionTo(['name' => 'REALIZAR PASES']);
                }
                if($request->empleado == "on")
                {
                    $user->giverPermissionTo(['name' => 'VER EXPEDIENTE']);
                    $user->giverPermissionTo(['name' => 'REASIGNAR PASE']);
                }
                if($user->save())
                {
                    return response()->json($user->datos_user(), 200);
                }
            }
            return response()->json([], 401);
        }
    }

    /**
     * Retorna los datos del usuario a mostrar para su edición.
     *
     */
    public function edit(Request $request)
    {
            /*
            $request = new Request;
            $request->id = '23';
            */
            $user = User::findOrFail($request->id);

            $data = ["tipo_users" => TipoUser::get_tipo_users(),
                     "areas" => Area::all_areas(),
                     "user" => [$user->datos_user()]];
        return response()->json($data,200);
    }

    /*
    Método que permite validar la contraseña ingresada y compararla con la password hash de la BD
    @params: password
    @return True: si encuentra coincidencia entre la clave ingresada y la almacenada
    @return False: si no encuentra coincidencia.
    **/
    public function validar_password(PasswordRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        if(Hash::check($request->password, $user->password))
        {
            return response()->json(True, 200);
        }
        else
        {
            $response = "La contraseña ingresada no es correcta";
            return response()->json($response, 201);
        }
    }

    /*
    Método que cambia la contraseña del usuario
    @params: token
    @params: password
    **/
    public function actualiza_password(PasswordRequest $request)
    {   
        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->update();
        return response()->json([
            "status" => 1,
            "mensaje" => "contraseña modificada exitosamente",
        ], 200);
    }

    public function update(Request $request)
    {
        //return response()->json($request, 200);
        $user = User::findOrFail($request->id);
        $user_old_password = $user->password;
        return response()->json($user_old_password, 200);

        /*
        $request = new Request;
        $request->id = '23';
        $request->dni = '12345677';
        $request->cuil = '2123456779';
        $request->area_id = '1';
        $request->tipo_area = 'Area';
        $request->tipo_user_id = '2';
        $request->nombre = 'Juan';
        $request->apellido = 'Fernandez';
        $request->telefono = '3794111111';
        $request->email = 'user@ejemplo.com';
        $request->direccion = 'Una Calle 123';
        */
        $user = User::findOrFail($request->id);
        /*$persona = Persona::findOrFail($user->persona->id);
        $persona->dni = $request->dni;
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;
        $persona->update();*/
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        /*if($request->validated())     //TODO para validaciones
        {
            $user->password = Hash::make($request->password);
        }*/

        /*if($user->update()){
            return response()->json($user->datos_user(),200);
        }*/
        $user->update();
        return response()->json($user, 200);
    }

    /**
     * Da de baja a un usuario.
     *
     */
    public function delete(Request $request)
    {
        /*
        $request = new Request;
        $request->id = '23';
        */
        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json($user->datos_user(),200);
    }

    /**
     * Da de alta un usuario que fue dado de baja.
     *
     */
    public function restore(Request $request)
    {
        /*
        $request = new Request;
        $request->id = '23';
        */
        $user = User::withTrashed()->findOrFail($request->id);;
        $user->restore();

        return response()->json($user->datos_user(),200);
    }

    
    public function getUserData()
    {
        $user = User::findOrFail(auth()->user()->id);
        return response()->json([
            "nombre_apellido" => $user->persona->nombre ." ". $user->persona->apellido,
            "cuil" => $user->cuil,
            "area" => $user->area->descripcion,
            "cargo" => $user->tipouser->descripcion,
        ], 200);
    }

    public function asignarPermisos()
    {
        $usuarios = User::all();
        foreach ($usuarios as $user)
        {
            if($user->area_id == 13){
                $user->givePermissionTo('CREAR EXPEDIENTE', 'UNIR EXPEDIENTES');
                    if($user->id == 36){
                        $user->givePermissionTo('AGREGAR INICIADOR');
                    }
            }
            else if($user->area_id == 15)
            {
                $user->givePermissionTo('AGREGAR INICIADOR');
            }
            else if($user->area_id == 14)
            {
                $user->givePermissionTo('AGREGAR CEDULA');
            }
        }
        return $usuarios;        
    }
}
