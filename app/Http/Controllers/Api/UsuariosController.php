<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function cambiarRol(Request $request){
        $user = User::find($request->id);

        $num_admins = User::role('Administrador')->get()->count();

        if($user == Auth::user() && Auth::user()->hasRole('Administrador') && $num_admins<2){
            return response()->json(
                'No puede cambiar el rol al único administrador', 400
            );
        }

        $user->syncRoles($request->rol);

        return response()->json(
            'Se ha actualizado el rol'
        );
    }

    public function cambiarEstadoBloqueado(Request $request){
        $user = User::find($request->id);

        $num_admins = User::role('Administrador')->get()->count();

        if(($user->hasRole('Administrador') && $num_admins<2) || ($user == Auth::user())){
            return response()->json(
                'error', 409
            );
        }

        $user->bloqueado = !$user->bloqueado;
        $user->save();
        return response()->json(
            'ok'
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
            'Se ha actualizado la contraseña'
        );
    }
}
