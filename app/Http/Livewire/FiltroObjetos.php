<?php

namespace App\Http\Livewire;

use App\Models\Objeto;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class FiltroObjetos extends Component
{
    public $categorias; 
    public $colores;

    public $titulo;
    public $tamanio = [];
    public $lugar;
    public $categoria = [];
    public $color = [];
    public $fecha;

    public function __construct($elements){
        $this->categorias = $elements[0];
        $this->colores = $elements[1];
    }

    public function render()
    {
        $eloquentQuery = Objeto::with('objetoBuscado','objetoEncontrado');

        $titulo = trim($this->titulo);
        if(!empty($titulo)){ $eloquentQuery = $eloquentQuery->where(DB::raw('LOWER(titulo)'), 'like', '%' . strtolower($titulo) . '%'); }
        $lugar = trim($this->lugar);
        if(!empty($lugar)){ $eloquentQuery = $eloquentQuery->where(DB::raw('LOWER(lugar)'), 'like', '%' . strtolower($lugar) . '%'); }
        if(!empty($this->tamanio)){ $eloquentQuery = $eloquentQuery->whereIn('tamanio', $this->tamanio); }
        if(!empty($this->categoria)){ 
            $eloquentQuery = $eloquentQuery->whereHas
            (
                'categoria',  
                function(Builder $query){
                    $query->whereIn('nombre', $this->categoria);
                }
            );
        }
        if(!empty($this->color)){ 
            $eloquentQuery = $eloquentQuery->whereHas
            (
                'color',  
                function(Builder $query){
                    $query->whereIn('hex_code', $this->color);
                }
            );
        }
        if(!empty($this->fecha)){ $eloquentQuery = $eloquentQuery->whereDate('created_at', $this->fecha); }

        $objetos = $eloquentQuery->get();

        return view('livewire.filtro-objetos', [
            'objetos' => $objetos,
            'categorias' => $this->categorias,
            'colores' => $this->colores
        ]);
    }

    public function filtrado(){
        $this->resetPage();
    }
}
