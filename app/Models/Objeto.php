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
}
