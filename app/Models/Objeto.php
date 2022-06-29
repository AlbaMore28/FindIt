<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;

    //Relacion muchos a 1 
    public function imagesObjeto(){
        return $this->hasMany(ImageObjeto::class);
    }

    //Relacion 1 a 1 con objeto buscado
    public function objetoBuscado(){
        return $this->hasOne(ObjetoBuscadoBusca::class);
    }

    //Relacion 1 a 1 con objeto encontrado
    public function objetoEncontrado(){
        return $this->hasOne(ObjetoEncontradoEncuentra::class);
    }
}
