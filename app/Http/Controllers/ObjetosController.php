<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetoRequest;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Image;
use App\Models\ImageObjeto;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ObjetosController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        $colores = Color::all();

        return view('objetos.index', compact('categorias','colores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Objeto  $objeto)
    {
        $categorias = Categoria::all();
        $colores = Color::all();
        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

        return view('objetos.edit',compact('objeto','objetos','categorias','colores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function update(ObjetoRequest $request, Objeto  $objeto)
    {
        $objeto->fill($request->all());

        $categoria = Categoria::find($request->input('categoria'));
        $color = Color::find($request->input('color'));

        $objeto->categoria()->associate($categoria);
        $objeto->color()->associate($color);

        if($request->input('visible')){
            $objeto->visibilidad = 1;
        }
        else{
            $objeto->visibilidad = 0;
        }
        $objeto->save();
        
        if($request->file('imagenes')){
            if($objeto->imagesObjeto){
                foreach($objeto->imagesObjeto as $image_objeto){
                    Storage::delete($image_objeto->image->url);
                    $image_objeto->image->delete();
                }
            }
            foreach($request->file('imagenes') as $image_objeto){
                $url = Storage::put('objetos', $image_objeto);

                $imagen = Image::create([
                    'url'=>$url,
                    'tipo'=>'objeto'
                 ]);

                 $imagen_objeto = new ImageObjeto();
                 $imagen_objeto->image()->associate($imagen);
                 $imagen_objeto->objeto()->associate($objeto);
                 $imagen_objeto->save();
            }
        }

        if($objeto->tipo == 'buscado'){
            $objetoBuscado = $objeto;
            return redirect()->route('objetosBuscados.show', $objetoBuscado)->with('success','El objeto se ha actualizado correctamente');
        }
        else{
            $objetoEncontrado = $objeto;
            return redirect()->route('objetosEncontrados.show', $objetoEncontrado)->with('success','El objeto se ha actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   @param  Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objeto  $objeto)
    {
        if($objeto->imagesObjeto){
            foreach($objeto->imagesObjeto as $imagen_objeto){
                Storage::delete($imagen_objeto->image->url);
                $imagen_objeto->image->delete();
            }
        }
        $objeto->delete();
        
        
        if(Auth::user()->hasRole('Administrador'))
            return redirect()->route('admin.objetos.index')->with('success', 'El objeto se ha eliminado con éxito.');
        else{
            return redirect()->route('objetos.index')->with('success', 'El objeto se ha eliminado con éxito.');
        }
    }
}