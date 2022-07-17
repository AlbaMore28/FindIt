<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageObjeto extends Model
{
    use HasFactory;

    //Relacion 1 a 1 con Image (inversa)
    public function image(){
        return $this->belongsTo(Image::class,'id','id');
    }

    //Relacion 1 a muchos con Objeto (inversa)
    public function objeto(){
        return $this->belongsTo(Objeto::class);
    }
}
