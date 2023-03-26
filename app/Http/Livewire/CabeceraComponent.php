<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Mensaje;
use App\Notifications\NuevoMensaje;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

class CabeceraComponent extends Component
{
    //listeners
    public function getListeners()
    {
        if(!empty(Auth::user())){
            $user_id = auth()->user()->id;

            return [
                "echo-notification:App.Models.User.{$user_id},notification" => 'render'
            ];
        }
    }

    public function getUnreadMessagesProperty(){
        return Mensaje::whereHas('chat', function($query){
            $query->whereHas('users', function($query){
                $query->where('users.id', auth()->user()->id);
            }); 
        })->where('user_id', '!=', auth()->user()->id)->where('leido', false)->count();
    }

    public function render()
    {
        return view('livewire.cabecera-component');
    }
}
