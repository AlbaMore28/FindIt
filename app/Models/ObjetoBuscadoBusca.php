<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ObjetoBuscadoBusca extends Model
{
    use HasFactory;
    
    protected $table = "objetos_buscados_busca";

    //Relacion 1 a 1 (inversa)
    public function objeto(){
        return $this->belongsTo(Objeto::class);
    }

    //Relacion muchos a 1 (inversa)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
