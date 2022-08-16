<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ImageUser;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index(){
        $usuario = User::find(Auth::user()->id);

        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

        return view('usuarios.index',compact('usuario','objetos'));
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $usuario = User::find(Auth::user()->id);

        $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

        return view('usuarios.edit',compact('usuario','objetos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usuario = User::find(Auth::user()->id);

        $usuario->fill($request->all());

        if($request->file('imagen_perfil')){
            $url = Storage::put('users', $request->file('imagen_perfil'));

            if($usuario->imageUser){
                Storage::delete($usuario->imageUser->image->url);

                $usuario->imageUser->image->update([
                    'url' => $url
                ]);
            }
            else{
                $imagen = Image::create([
                    'url'=>$url,
                    'tipo'=>'user'
                 ]);
        
                 $imagen_usuario = new ImageUser;
                 $imagen_usuario->image()->associate($imagen);
                 $imagen_usuario->save();
        
                 $usuario->imageUser()->associate($imagen_usuario);
            }
        }
        $usuario->save();


        return redirect()->route('usuarios.index')->with('success', 'El usuario se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $usuario = User::with('objetosBuscados','objetosEncontrados')->find(Auth::user()->id);

        $num_admins = User::role('Administrador')->get()->count();

        if($usuario->hasRole('Administrador') && $num_admins<2){
            return redirect()->route('usuarios.index')->with('error','No se puede borrar tu perfil ya que eres el único administrador dado de alta en el sistema');
        }

        if($usuario->objetosBuscados){
            foreach($usuario->objetosBuscados as $objetoBuscado){
                $objeto = $objetoBuscado->objeto;
                if($objeto->imagesObjeto){
                    foreach($objeto->imagesObjeto as $imagen_objeto_busc){
                        Storage::delete($imagen_objeto_busc->image->url);
                        $imagen_objeto_busc->image->delete();
                    }
                }
                $objeto->delete();
            }
        }

        if($usuario->objetosEncontrados){
            foreach($usuario->objetosEncontrados as $objetoEncontrado){
                $objeto = $objetoEncontrado->objeto;
                if($objeto->imagesObjeto){
                    foreach($objeto->imagesObjeto as $imagen_objeto_enc){
                        Storage::delete($imagen_objeto_enc->image->url);
                        $imagen_objeto_enc->image->delete();
                    }
                }
                $objeto->delete();
            }
        }

        if($usuario->imageUser){
            Storage::delete($usuario->imageUser->image->url);
            $usuario->imageUser->image->delete();
        }

        Auth::logout();

        $usuario->delete();

        return redirect()->route('home.index')->with('success', 'El usuario se ha eliminado con éxito.');
    }
}
