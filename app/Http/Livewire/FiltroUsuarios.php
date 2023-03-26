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

    public function __mount($elements){
        $this->roles = $elements['roles'];
    }

    public function getUsuariosProperty(){
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

        return $eloquentQuery->get();
    }

    public function render()
    {
        return view('livewire.filtro-usuarios', [
            'roles' => $this->roles,
        ]);
    }
}
