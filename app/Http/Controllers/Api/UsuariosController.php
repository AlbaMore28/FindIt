<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('can:api.usuarios.cambiarEstadoBloqueado')->only('cambiarEstadoBloqueado');
        $this->middleware('can:api.usuarios.cambiarRol')->only('cambiarRol');
    }

    public function cambiarRol(Request $request){
        $user = User::find($request->id);

        $num_admins = User::role('Administrador')->get()->count();

        if($user->id == Auth::user()->id && Auth::user()->hasRole('Administrador') && $num_admins<2){
            return response()->json(
                'No puede cambiar el rol al único administrador', 400
            );
        }
        if($user->id != Auth::user()->id && Auth::user()->hasRole('Administrador') && $user->hasRole('Administrador')){
            return response()->json(
                'No puede cambiar el rol a otro administrador', 400
            );
        }

        $user->syncRoles($request->rol);

        return response()->json(
            'Se ha actualizado el rol correctamente'
        );
    }

    public function cambiarEstadoBloqueado(Request $request){
        $user = User::find($request->id);

        $num_admins = User::role('Administrador')->get()->count();

        if(Auth::user()->hasRole('Moderador') && $user->hasRole('Administrador')){
            return response()->json(
                'Un moderador no puede bloquear a un administrador', 400
            );
        }

        if($user == Auth::user()){
            return response()->json(
                'No puede bloquearse a sí mismo', 400
            );
        }

        if($user->hasRole('Administrador') && $num_admins<2)
        {
            return response()->json(
                'No se puede bloquear al único administrador', 400
            );
        }

        $user->bloqueado = !$user->bloqueado;
        $user->save();
        return response()->json(
            ' con éxito'
        );

    }

    public function editarPassword(Request $request){
        $usuario = User::find(Auth::user()->id);

        if(!Hash::check($request->input('password_old'),$usuario->password)){
            return response()->json(
                'No ha introducido la contraseña actual correcta', 400
            );
        }

        if($request->input('password') != $request->input('password_confirmation')){
            return response()->json(
                'No ha introducido la misma contraseña en la confirmación', 400
            );
        }

        $usuario->password = bcrypt($request->input('password'));
        $usuario->save();
        
        return response()->json(
            'Se ha actualizado la contraseña con éxito'
        );
    }
}
