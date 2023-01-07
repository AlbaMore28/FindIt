<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetoEncontradoRequest;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Image;
use App\Models\ImageObjeto;
use App\Models\Objeto;
use App\Models\ObjetoEncontradoEncuentra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ObjetosEncontradosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        $colores = Color::all();
        return view('objetosEncontrados.index', compact('categorias','colores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $colores = Color::all();
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
        
        return view('objetosEncontrados.create', compact('objetos','categorias','colores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjetoEncontradoRequest $request)
    {
        $objeto = Objeto::make($request->all());

        $categoria = Categoria::find($request->input('categoria'));
        $color = Color::find($request->input('color'));

        $objeto->categoria()->associate($categoria);
        $objeto->color()->associate($color);

        $objeto->tipo = 'encontrado';
        if($request->input('visible')){
            $objeto->visibilidad = 1;
        }
        else{
            $objeto->visibilidad = 0;
        }
        $objeto->save();

        $objetoEncontradoEncuentra = new ObjetoEncontradoEncuentra;
        $objetoEncontradoEncuentra->objeto()->associate($objeto);
        $objetoEncontradoEncuentra->user()->associate(Auth::user());
        $objetoEncontradoEncuentra->save();
        
        if($request->file('imagenes_objeto_enc')){
            foreach($request->file('imagenes_objeto_enc') as $image_objeto_enc){
                $url = Storage::put('objetos', $image_objeto_enc);

                $imagen = Image::create([
                    'url'=>$url,
                    'tipo'=>'objeto'
                 ]);

                 $imagen_objeto = new ImageObjeto;
                 $imagen_objeto->image()->associate($imagen);
                 $imagen_objeto->objeto()->associate($objeto);
                 $imagen_objeto->save();
            }
        }

        return redirect()->route('objetosEncontrados.show', $objetoEncontradoEncuentra)->with('success','El objeto se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  ObjetoEncontradoEncuentra  $objetoEncontrado
     * @return \Illuminate\Http\Response
     */
    public function show(ObjetoEncontradoEncuentra $objetoEncontrado)
    {
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
        
        return view('objetosEncontrados.show', compact('objetoEncontrado','objetos'));
    }
}
