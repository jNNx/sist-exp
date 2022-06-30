<?php

namespace App\Http\Controllers\api;

use App\Models\Cedula;
use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCedulaRequest;

class CedulaController extends Controller
{
    public function index()
    {
        $cedula = Cedula::index();
        return response()->json($cedula,200);
    }

    public function create(Request $request)
    {
        $expedientes = Expediente::listadoExpedientes(Auth::User()->id, 3, 3);//Mi Expedientes
        $create_cedula = [$expedientes];
        return response()->json($create_cedula, 200);
    }

    public function store(StoreCedulaRequest $request)
    {
        if ($request->validated())
        {
            $cedula = new Cedula;
            $cedula->expediente_id  = $request->expediente_id;
            $cedula->user_id        = Auth::User()->id;
            $cedula->descripcion    = $request->descripcion;
            $cedula->save();
            return response()->json($cedula->getDatos(), 200);
        }
    }

    public function edit(Request $request)
    {
        $cedula = Cedula::findOrFail($request->id);
        $expediente = Expediente::listadoExpedientes(Auth::User()->id, 3, 3);//Mi Expedientes
        $edit_cedula = [$expediente, $cedula->getDatos()];
        return response()->json($edit_cedula, 200);
    }

    public function update(Request $request)
    {
        $cedula = Cedula::findOrFail($request->id);
        $cedula->expediente_id = $request->expediente_id;
        $cedula->descripcion = $request->descripcion;
        $cedula->update();
        return response()->json($cedula->getDatos(), 200);
    }
}
