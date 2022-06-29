<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function __invoke()
   {
    $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

    return view('home', compact('objetos'));
   }
}
