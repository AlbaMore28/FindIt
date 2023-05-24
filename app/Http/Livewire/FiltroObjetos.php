<?php

namespace App\Http\Livewire;

use App\Models\Objeto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

    public function __mount($elements){
        $this->categorias = $elements['categorias'];
        $this->colores = $elements['colores'];
    }

    public function getObjetosProperty(){
        $eloquentQuery = Objeto::with('objetoBuscado','objetoEncontrado')
                                ->where(function($query){
                                        $query
                                            ->whereHas('objetoEncontrado', function($query){
                                                $query->where('user_id', Auth::user()->id);
                                            })
                                            ->orWhereHas('objetoBuscado', function($query){
                                                $query->where('user_id', Auth::user()->id);
                                            });
                                        }
                                );

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

        return $eloquentQuery->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.filtro-objetos', [
            'categorias' => $this->categorias,
            'colores' => $this->colores
        ]);
    }
}