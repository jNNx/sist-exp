<?php

namespace App\Http\Controllers\api;

use app\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return "Vista Login.";
    }

    public function logout()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->tokens()->delete();
        return ('usuario deslogueado');
    }

    /**
     * Método para autenticar un usuario y loquearlo en el sistema,
     * genera un token para utilizar la API
     * @param: cuil
     * Autor: Mariano Flores
     */
    public function authenticate(LoginRequest $request)
    {
        $user = ModelsUser::where("cuil", "=", "$request->cuil")->first();
        
        if(isset($user->id))
        {
            $user->tokens()->delete(); // comentar ésta línea si se requiere asignar más de un token al usuario
            if(Hash::check($request->password, $user->password))
            {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    "status" => true,
                    "mensaje" => "usuario logueado exitosamente",
                    "nombre_apellido" => $user->persona->nombre ." ". $user->persona->apellido,
                    "cuil" => $user->cuil,
                    "id" => $user->area->id,
                    "area" => $user->area->descripcion,
                    "cargo" => $user->tipouser->descripcion,
                    "access_token" => $token,
                    "token_type" => "login token"
                ], 200);
            }
            else
            {
                return response()->json([
                    "status" => false,
                    "mensaje" => "contraseña incorrecta",
                ], 404);
            }
        }
        else
        {
            return response()->json([
                "status" => false,
                "mensaje" => "usuario y/o contraseña incorrecta",
            ], 404);
        }               
    }
}