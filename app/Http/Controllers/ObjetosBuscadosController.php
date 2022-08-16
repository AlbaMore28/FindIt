<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ImageObjeto;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ObjetosBuscadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetosBuscados = Objeto::where('visibilidad','1')->where('tipo','buscado')->paginate(9);

        return view('objetosBuscados.index', compact('objetosBuscados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
        
        return view('objetosBuscados.create', compact('objetos'));
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
        $objeto->tipo = 'buscado';
        if($request->input('visible')){
            $objeto->visibilidad = 1;
        }
        else{
            $objeto->visibilidad = 0;
        }
        $objeto->save();

        $objetoBuscadoBusca = new ObjetoBuscadoBusca;
        $objetoBuscadoBusca->objeto()->associate($objeto);
        $objetoBuscadoBusca->user()->associate(Auth::user());
        $objetoBuscadoBusca->save();
        
        if($request->file('imagenes_objeto_busc')){
            foreach($request->file('imagenes_objeto_busc') as $image_objeto_busc){
                $url = Storage::put('objetos', $image_objeto_busc);

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

        return redirect()->route('objetosBuscados.show', $objetoBuscadoBusca);
    }

    /**
     * Display the specified resource.
     *
     * @param  ObjetoBuscadoBusca  $objetoBuscado
     * @return \Illuminate\Http\Response
     */
    public function show(ObjetoBuscadoBusca $objetoBuscado)
    {
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
        
        return view('objetosBuscados.show', compact('objetoBuscado','objetos'));
    }
}
