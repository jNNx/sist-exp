<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\CedulaController;
use App\Http\Controllers\api\HistorialController;
use App\Http\Controllers\api\IniciadorController;
use App\Http\Controllers\api\ExpedienteController;
use App\Http\Controllers\api\NotificacionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|Cuando se implemente middleware usar auth:sanctum en lugar de auth:api
*/

Route::middleware('auth:sanctum')->group(function () {

    /******* USUARIO **************/
    Route::get('/salir',                [LoginController::class, 'logout'] );
    Route::post('/validarPassword',     [UserController::class, 'validar_password']);
    Route::post('/actualizaPassword',   [UserController::class, 'actualiza_password']);
    Route::post('/userData',            [UserController::class, 'getUserData']);
    

    /********** EXPEDIENTES **************/
    Route::get('/createExp',    [ExpedienteController::class, 'create'])->middleware(['can:CREAR EXPEDIENTE']); 
    Route::post('/buscar-expediente',   [ExpedienteController::class, 'buscarExpediente']);
    Route::get('/indexExp',             [ExpedienteController::class, 'index']);//TODOS LOS EXPEDIETES DE TODAS LAS AREAS
    Route::post('/ListadoExp',       [ExpedienteController::class, 'bandeja']);//EXPEDIENTES DE LAS BANDEJAS
    Route::post('/expSubsidiosNoReintegrables', [ExpedienteController::class, 'expSubsidiosNoReintegrables']);
    Route::get('/all-motivos',       [ExpedienteController::class, 'indexMotivos']);


    /******* HISTORIAL **********/
    Route::post('/historial-expediente',    [HistorialController::class, 'store']);
    Route::post('/historial',               [HistorialController::class, 'create']);
    Route::post('/historialExp',            [HistorialController::class, 'historialExpediente']);
    Route::post('/update-estado',           [HistorialController::class, 'updateEstado']);
    Route::post('/regresar',                [HistorialController::class, 'regresarExpediente']);
    Route::get('/mis-enviados',             [HistorialController::class, 'misEnviados']);

    /********** CEDULA ***********/
    Route::post('/contar-cedula',       [ExpedienteController::class, 'contar_cedulas']);
    Route::post('/store-cedula',        [CedulaController::class, 'store'])->middleware(['can:AGREGAR CEDULA']);

    /**** DESGLOSE Y ENGLOSE *****/
    Route::get('/indexExpPadres',       [ExpedienteController::class, 'indexExpPadres'])->middleware(['can:UNIR EXPEDIENTES']); 
    Route::post('/createDesgloceExp',   [ExpedienteController::class, 'createDesgloce'])->middleware(['can:UNIR EXPEDIENTES']); 
    Route::post('/desgloceExp',         [ExpedienteController::class, 'desgloce'])->middleware(['can:UNIR EXPEDIENTES']); 
    Route::post('/unionExp',            [ExpedienteController::class, 'union'])->middleware(['can:UNIR EXPEDIENTES']); 

    /**** INICIADORES ****/
    Route::get('/createTipoEntidad', [IniciadorController::class, 'create']);
    Route::post('/store-iniciador',   [IniciadorController::class, 'store'])->middleware(['can:AGREGAR INICIADOR']);
    Route::get('/index-iniciador',  [IniciadorController::class, 'index']);
    Route::post('/edit-iniciador',  [IniciadorController::class, 'edit']);
    Route::post('/update-iniciador',[IniciadorController::class, 'update']);

    /**** SUBSIDIO Y NO REINTEGRABLES ****/
    Route::post('/expSubsidiosNoReintegrables', [ExpedienteController::class, 'expSubsidiosNoReintegrables']);

    /***** ALERTAS ***/
    Route::get('/contarExp',         [ExpedienteController::class, 'contadorBandejaEntrada']);
    Route::post('/contarSubsidioAporteNR', [NotificacionController::class, 'contadorSubsidioAporteNR']);
    Route::get('/notificacion',               [NotificacionController::class, 'index']);
    Route::get('/notificacion-cerrar',               [NotificacionController::class, 'update']);


    /*** NUEVO EXPEDIENTE ***/
    Route::post('/nroExp',              [ExpedienteController::class, 'createNroExpediente']);
    Route::post('/storeExp',            [ExpedienteController::class, 'store']);
    Route::post('/zip',               [ExpedienteController::class, 'descargarZip']);
});

// Rutas que no se deben proteger
Route::get('/login',[LoginController::class, 'showLoginForm'] );
Route::post('/login',[LoginController::class, 'authenticate'] );

Route::get('/all-expedientes',      [ExpedienteController::class, 'AllExpedientes']);
Route::get('/asignar-permisos',     [UserController::class, 'asignarPermisos']);