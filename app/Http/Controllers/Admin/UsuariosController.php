<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index(){
        $roles = Role::all();

        $usuarios = User::with('roles')->get();

        return view('admin.usuarios.index',compact('usuarios'), compact('roles'));
    }

    
}
