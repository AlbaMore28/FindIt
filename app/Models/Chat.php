<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    //Relacion 1 a muchos
    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }
    
    //Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getNombreAttribute()
    {
        foreach($this->users as $userItem){
            if($userItem->email != Auth::user()->email){
                return $userItem->nombre;
            }
        }
    }

    public function getEmailAttribute()
    {
        foreach($this->users as $userItem){
            if($userItem->email != Auth::user()->email){
                return $userItem->email;
            }
        }
    }

    public function getImageUserAttribute()
    {
        foreach($this->users as $userItem){
            if($userItem->email != Auth::user()->email){
                return $userItem->imageUser;
            }
        }
    }

    public function getLastMensajeAtAttribute(){
        if($this->mensajes->count() == 0){
            return null;
        }
        return $this->mensajes->last()->created_at;
    }

    public function getUnreadMessagesAttribute(){
        return $this->mensajes()->where('user_id', '!=', auth()->user()->id)->where('leido', false)->count();
    }
}
