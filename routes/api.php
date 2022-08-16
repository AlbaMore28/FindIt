<?php

use App\Http\Controllers\Api\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('usuario/cambiarRol', [UsuariosController::class, 'cambiarRol'])->name('api.usuarios.cambiarRol');
Route::post('usuario/cambiarEstadoBloqueado', [UsuariosController::class, 'cambiarEstadoBloqueado'])->name('api.usuarios.cambiarEstadoBloqueado');
