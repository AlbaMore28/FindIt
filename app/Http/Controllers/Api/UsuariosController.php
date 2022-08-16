<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function cambiarRol(Request $request){
        return response()->json(
            $request->request->all()
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
}
