<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Pago;
use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::index();
        return response()->json($pagos, 200);
    }

    public function create()
    {
        $expediente = Expediente::all();
        return response()->json($expediente, 200);
    }

    public function store(Request $request)
    {
        $pagos = new Pago;
        $pagos->expediente_id = $request->expediente_id;
        $pagos->nro = $request->nro;
        $pagos->tipo = $request->tipo; //transferencia o cheque
        $pagos->estado = "1"; //pendiente
        $pagos->monto = $request->monto;
        $pagos->fecha = Carbon::now()->format('Y-m-d');
        $pagos->titular = $request->titular;
        $pagos->banco = $request->banco;
        $pagos->save();
        return response()->json($pagos, 200);
    }
    /* Datos de prueba 
    {
        "expediente_id" : "2",
        "nro": "1337",
        "tipo": "1",
        "monto": "4646",
        "titular": "valentino rossi",
        "banco" : "santander"
    }*/

    public function update(Request $request)
    {
        $pago = Pago::findOrFail($request->id);
        $pago->estado = "2"; //aceptado - pagado - etc
        $pago->banco = $request->banco;
        $pago->save();
        return response()->json($pago->getDatos(), 200);
    }
}
