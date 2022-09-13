<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioBloqueadoController;
use Illuminate\Support\Facades\Route;

/* Ruta bloqueado */
Route::get('usuarioBloqueado', UsuarioBloqueadoController::class)->name('usuarioBloqueado');

/* Rutas home */
Route::get('cerrarSesion', [HomeController::class, 'cerrarSesion'])->name('home.cerrarSesion');