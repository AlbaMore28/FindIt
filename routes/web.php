<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObjetosBuscadosController;
use App\Http\Controllers\ObjetosController;
use App\Http\Controllers\ObjetosEncontradosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('faq', [HomeController::class, 'preguntas'])->name('home.faq');
Route::get('contact', [HomeController::class, 'contactar'])->name('home.contact');

Route::get('objetosBuscados', [ObjetosBuscadosController::class, 'index'])->name('objetosBuscados.index');
Route::get('objetoBuscado/{objetoBuscado}', [ObjetosBuscadosController::class, 'show'])->name('objetosBuscados.show');

Route::get('objetosEncontrados', [ObjetosEncontradosController::class, 'index'])->name('objetosEncontrados.index');
Route::get('objetoEncontrado/{objetoEncontrado}', [ObjetosEncontradosController::class, 'show'])->name('objetosEncontrados.show');


Route::middleware('guest')->group(function (){
    Route::get('registroInicioSesion', [HomeController::class, 'vistaRegistroInicioSesion'])->name('home.vistaRegistroInicioSesion');
    Route::post('registro', [HomeController::class, 'registro'])->name('home.registro');
    Route::post('inicioSesion', [HomeController::class, 'iniciarSesion'])->name('home.iniciarSesion');
});

Route::middleware('auth')->group(function (){
    Route::get('cerrarSesion', [HomeController::class, 'cerrarSesion'])->name('home.cerrarSesion');

    Route::get('objetosBuscados/create', [ObjetosBuscadosController::class, 'create'])->name('objetosBuscados.create');
    Route::post('objetosBuscados', [ObjetosBuscadosController::class, 'store'])->name('objetosBuscados.store');

    Route::get('objetosEncontrados/create', [ObjetosEncontradosController::class, 'create'])->name('objetosEncontrados.create');
    Route::post('objetosEncontrados', [ObjetosEncontradosController::class, 'store'])->name('objetosEncontrados.store');

    Route::get('verPerfil', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('editarPerfil', [UsuariosController::class, 'edit'])->name('usuarios.edit');

    Route::get('misRegistros', [ObjetosController::class, 'index'])->name('objetos.index');
});
