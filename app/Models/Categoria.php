<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //Relacion muchos a 1 
    public function objeto(){
        return $this->hasMany(Objeto::class);
    }
}
