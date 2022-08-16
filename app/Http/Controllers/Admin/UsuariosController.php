<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index(){
        $roles = Role::all();

        $usuarios = User::with('roles')->get();

        return view('admin.usuarios.index',compact('usuarios'), compact('roles'));
    }

    public function destroy(User $user){
        $num_admins = User::role('Administrador')->get()->count();

        if(($user->hasRole('Administrador') && $num_admins<2) || ($user == Auth::user())){
            return redirect()->route('admin.usuarios.index')->with('error','No se puede borrar el administrador');
        }
        
        $usuario = $user;

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

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')->with('success','El usuario ha sido borrado con éxito');      
    }
}
