<?php

namespace App\Http\Controllers;

use App\Models\ImageObjeto;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ObjetoBuscadoBusca  $objetoBuscado
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjetoBuscadoBusca $objetoBuscado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjetoBuscadoBusca  $objetoBuscado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObjetoBuscadoBusca $objetoBuscado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ObjetoBuscadoBusca  $objetoBuscado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObjetoBuscadoBusca $objetoBuscado)
    {
        //
    }
}
