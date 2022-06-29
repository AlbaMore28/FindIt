<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Relacion 1 a 1 con image_user
    public function imageUser(){
        return $this->hasOne(ImageUser::class);
    }

    //Relacion 1 a 1 con image_objeto
    public function imageObjeto(){
        return $this->hasOne(ImageObjeto::class);
    }
}
