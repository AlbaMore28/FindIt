<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetoEncontradoEncuentra extends Model
{
    use HasFactory;

    protected $table = "objetos_encontrados_encuentra";

    //Relacion 1 a 1 (inversa)
    public function objeto(){
        return $this->belongsTo(Objeto::class);
    }

    //Relacion 1 a muchos (inversa)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
