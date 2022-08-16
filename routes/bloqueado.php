<?php

use App\Http\Controllers\UsuarioBloqueadoController;
use Illuminate\Support\Facades\Route;

/* Ruta bloqueado */
Route::get('usuarioBloqueado', UsuarioBloqueadoController::class)->name('usuarioBloqueado');