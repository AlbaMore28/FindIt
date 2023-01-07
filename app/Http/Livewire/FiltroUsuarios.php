<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FiltroUsuarios extends Component
{
    public $roles;

    public $nombre;
    public $nombreUsuario;
    public $email;
    public $rol = [];

    public function __construct($elements){
        $this->roles = $elements[0];
    }

    public function render()
    {
        $eloquentQuery = User::with('roles');

        $nombre = trim($this->nombre);
        if(!empty($nombre)){ $eloquentQuery = $eloquentQuery->where(DB::raw('LOWER(nombre)'), 'like', '%' . strtolower($nombre) . '%'); }
        $nombreUsuario = trim($this->nombreUsuario);
        if(!empty($nombreUsuario)){ $eloquentQuery = $eloquentQuery->where(DB::raw('LOWER(nombre_usuario)'), 'like', '%' . strtolower($nombreUsuario) . '%'); }
        $email = trim($this->email);
        if(!empty($email)){ $eloquentQuery = $eloquentQuery->where(DB::raw('LOWER(email)'), 'like', '%' . strtolower($email) . '%'); }
        if(!empty($this->rol)){ 
            $eloquentQuery = $eloquentQuery->whereHas
            (
                'roles',  
                function(Builder $query){
                    $query->whereIn('name', $this->rol);
                }
            );
        }

        $usuarios = $eloquentQuery->get();

        return view('livewire.filtro-usuarios', [
            'usuarios' => $usuarios,
            'roles' => $this->roles,
        ]);
    }
}
