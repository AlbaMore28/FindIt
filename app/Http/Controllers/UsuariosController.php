<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Objeto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index(){
        $usuario = Auth::user();

        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

        return view('usuarios.index',compact('usuario','objetos'));
    }
    
}
