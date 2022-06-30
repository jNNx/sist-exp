<?php

namespace App\Http\Controllers\api;

use App\Models\Iniciador;
use App\Models\Solicitud;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::all();
        return response()->json($solicitudes, 200);
    }

    public function create()
    {
        $tipo_entidad = TipoEntidad::all();
        return response()->json($tipo_entidad, 200);
    }

    public function store(Request $request)
    {
        $solicitud = new Solicitud;
        $solicitud->tipo_entidad = $request->tipo_entidad;
        $solicitud->nombre = $request->nombre;
        $solicitud->apellido = $request->apellido;
        $solicitud->dni = $request->dni;
        $solicitud->cuil = $request->cuil;
        $solicitud->cuit = $request->cuit;
        $solicitud->telefono = $request->telefono;
        $solicitud->email = $request->email;
        $solicitud->direccion = $request->direccion;
        $solicitud->area_reparticiones = $request->area_reparticiones;
        $solicitud->estado = "1";
        $solicitud->motivo = "Pendiente";
        $solicitud->save();
        return response()->json($solicitud, 200);
    }

    public function show(Request $request)
    {
        $solicitud = Solicitud::findOrFail($request->id);
        return response()->json($solicitud, 200);
    }

    public function edit($id)
    {
        //
    }
    /*
        Cambio de estado de la solicitud 1-Pendiente (por defecto)/ 2- Aceptado / 3- Rechazado
    */
    public function update(Request $request)
    {
        $updateSolicitud = Solicitud::findOrFail($request->id);
        $updateSolicitud->estado = $request->estado;
        if ($updateSolicitud->estado == "2")  // aceptado
        {
            $updateSolicitud->motivo = "Aceptado";
            $iniciador = new Iniciador;
            $iniciador->id_tipo_entidad = $updateSolicitud->tipo_entidad;
            $iniciador->nombre = $updateSolicitud->nombre;
            $iniciador->apellido = $updateSolicitud->apellido;
            $iniciador->dni = $updateSolicitud->dni;
            $iniciador->cuil = $updateSolicitud->cuil;
            $iniciador->cuit = $updateSolicitud->cuit;
            $iniciador->telefono = $updateSolicitud->telefono;
            $iniciador->email = $updateSolicitud->email;
            $iniciador->direccion = $updateSolicitud->direccion;
            $iniciador->area_reparticiones = $updateSolicitud->area_reparticiones;
            $iniciador->save();
        }
        else
        {
            $updateSolicitud->motivo = $request->motivo;
        }
        $updateSolicitud->save();
        return response()->json($updateSolicitud, 200);
    }

    public function destroy($id)
    {
        //
    }
}
