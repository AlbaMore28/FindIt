<?php

use App\Http\Controllers\Admin\ObjetosController;
use Illuminate\Support\Facades\Route;

    Route::get('objetos', [ObjetosController::class, 'index'])->name('admin.objetos.index');