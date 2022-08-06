<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetosController extends Controller
{
    public function index(){
        $objetos = Objeto::all();

        return view('objetos.index',compact('objetos'));
    }
}