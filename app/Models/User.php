<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    //Relacion 1 a muchos
    public function objetosBuscados(){
        return $this->hasMany(ObjetoBuscadoBusca::class);
    }

    //Relacion 1 a muchos
    public function objetosEncontrados(){
        return $this->hasMany(ObjetoEncontradoEncuentra::class);
    }

    //Relacion 1 a 1 con imagen (inversa)
    public function imageUser(){
        return $this->belongsTo(ImageUser::class);
    }
}
