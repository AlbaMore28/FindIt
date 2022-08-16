<?php

use App\Http\Controllers\Admin\ObjetosController;
use App\Http\Controllers\Admin\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('objetos', [ObjetosController::class, 'index'])->name('admin.objetos.index');

Route::get('usuarios', [UsuariosController::class, 'index'])->name('admin.usuarios.index');
Route::get('usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');