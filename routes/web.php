<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObjetosBuscadosController;
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
Route::get('objetosBuscados', [ObjetosBuscadosController::class, 'index'])->name('objetosBuscados.index');
Route::get('objetoBuscado/{objetoBuscado}', [ObjetosBuscadosController::class, 'show'])->name('objetosBuscados.show');
Route::get('faq', [HomeController::class, 'preguntas'])->name('home.faq');
Route::get('contact', [HomeController::class, 'contactar'])->name('home.contact');


Route::middleware('guest')->group(function (){
    Route::get('registroInicioSesion', [HomeController::class, 'vistaRegistroInicioSesion'])->name('home.vistaRegistroInicioSesion');
    //Route::post('registro', [HomeController::class, 'registro'])->name('home.registro');
    Route::post('inicioSesion', [HomeController::class, 'iniciarSesion'])->name('home.iniciarSesion');
});

Route::middleware('auth')->group(function (){
    Route::get('cerrarSesion', [HomeController::class, 'cerrarSesion'])->name('home.cerrarSesion');
});
