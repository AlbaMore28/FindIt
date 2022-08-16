<?php

namespace App\Http\Controllers;

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
        $objetosEncontrados = Objeto::where('visibilidad','1')->where('tipo','encontrado')->paginate(9);

        return view('objetosEncontrados.index', compact('objetosEncontrados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
        
        return view('objetosEncontrados.create', compact('objetos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objeto = Objeto::make($request->all());
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

        return redirect()->route('objetosEncontrados.show', $objetoEncontradoEncuentra);
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
