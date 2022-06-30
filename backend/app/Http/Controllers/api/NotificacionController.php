<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::get()->last();
        return response()->json($notificaciones, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /*$notificacion = new Notificacion;
        $notificacion->expediente_id = $request->expediente_id;
        $notificacion->user_id = $request->user_id;
        $notificacion->estado = "1"; //Pendiente
        $notificacion->save();
        return response()->json($notificacion, 200);*/
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $notificacion = Notificacion::get()->last();
        $notificacion->user_id = Auth::User()->id;
        $notificacion->fecha = Carbon::now();
        $notificacion->estado = false; //Aceptado
        $notificacion->save();
        return response()->json($notificacion->getDatos(), 200);
    }

    public function destroy($id)
    {
        //
    }

    /**
     * Método para notificar al área de Registraciones y Notificaciones cantidad que
     * ha ingresado de expedientes con motivo Subsidio o Aporte no reintegrable
     * @params: user_id
     * A: MF
     */
    public function contadorSubsidioAporteNR()
    {
        $contador = Notificacion::listadoExpedientesSubsidioAporteNR()->count();
        return response()->json($contador, 200);
    }
}
