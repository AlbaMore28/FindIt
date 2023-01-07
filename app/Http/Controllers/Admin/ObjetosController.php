<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Objeto;
use Illuminate\Http\Request;

class ObjetosController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.objetos.index')->only('index');
    }

    public function index(){
        $categorias = Categoria::all();
        $colores = Color::all();
        
        return view('admin.objetos.index', compact('categorias','colores'));
    }
}
