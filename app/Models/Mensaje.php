<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuerpo',
        'leido',
        'user_id'
    ];

    //Relacion muchos a 1
    public function chat(){
        return $this->belongsTo(Chat::class);
    }

    //Relacion muchos a 1
    public function user(){
        return $this->belongsTo(User::class);
    }
}
