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

/* Rutas home (sin logueo o con logueo) */
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('faq', [HomeController::class, 'preguntas'])->name('home.faq');
Route::get('contact', [HomeController::class, 'contactar'])->name('home.contact');

/* rutas objetos buscados (sin logueo o con logueo) */
Route::get('objetosBuscados', [ObjetosBuscadosController::class, 'index'])->name('objetosBuscados.index');
Route::get('objetoBuscado/{objetoBuscado}', [ObjetosBuscadosController::class, 'show'])->name('objetosBuscados.show');

/* Rutas objetos encontrados (sin logueo o con logueo) */
Route::get('objetosEncontrados', [ObjetosEncontradosController::class, 'index'])->name('objetosEncontrados.index');
Route::get('objetoEncontrado/{objetoEncontrado}', [ObjetosEncontradosController::class, 'show'])->name('objetosEncontrados.show');

/* Rutas obligatoriamente sin logueo */
Route::middleware('guest')->group(function (){
    /* Rutas home */
    Route::get('registroInicioSesion', [HomeController::class, 'vistaRegistroInicioSesion'])->name('home.vistaRegistroInicioSesion');
    Route::post('registro', [HomeController::class, 'registro'])->name('home.registro');
    Route::post('inicioSesion', [HomeController::class, 'iniciarSesion'])->name('home.iniciarSesion');
});

/* Rutas con logueo obligatorio */
Route::middleware('auth')->group(function (){
    /* Rutas home */
    Route::get('cerrarSesion', [HomeController::class, 'cerrarSesion'])->name('home.cerrarSesion');

    /* Rutas objetos buscados */
    Route::get('objetosBuscados/create', [ObjetosBuscadosController::class, 'create'])->name('objetosBuscados.create');
    Route::post('objetosBuscados', [ObjetosBuscadosController::class, 'store'])->name('objetosBuscados.store');

    /* Rutas objetos encontrados */
    Route::get('objetosEncontrados/create', [ObjetosEncontradosController::class, 'create'])->name('objetosEncontrados.create');
    Route::post('objetosEncontrados', [ObjetosEncontradosController::class, 'store'])->name('objetosEncontrados.store');

    /* Rutas usuarios */
    Route::get('verPerfil', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('editarPerfil', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::post('editarPerfil', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('borrarPerfil', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    /* Rutas objetos */
    Route::get('misRegistros', [ObjetosController::class, 'index'])->name('objetos.index');
    Route::get('editarRegistro/{objeto}', [ObjetosController::class, 'edit'])->name('objetos.edit');
    Route::post('editarRegistro/{objeto}', [ObjetosController::class, 'update'])->name('objetos.update');
    Route::get('borrarObjeto/{objeto}', [ObjetosController::class, 'destroy'])->name('objetos.destroy');
});
