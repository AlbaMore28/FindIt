<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Notifications\NuevoMensaje;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

class ChatComponent extends Component
{
    public $busqueda;
    public $mensaje;
    public $chat;

    public function __mount($elements){
        $this->chat = $elements['chat'];
    }

    //listeners
    public function getListeners()
    {
        $user_id = auth()->user()->id;

        return [
            "echo-notification:App.Models.User.{$user_id},notification" => 'render'
        ];
    }


    public function openChat($id){
        $this->chat = Chat::find($id);
    }

    public function getChatsProperty(){
        return auth()->user()->chats()->get()
                ->filter(function ($chat, $key) {
                    return 
                        empty(trim($this->busqueda)) || 
                        (str_contains(strtolower($chat->nombre), strtolower(trim($this->busqueda))) || str_contains(strtolower($chat->email), strtolower(trim($this->busqueda))));
                })->sortByDesc('lastMensajeAt');
    }

    public function getMensajesProperty(){
        return $this->chat ? $this->chat->mensajes()->get() : [];
    }

    public function getUsuarioNotificarProperty(){
        return $this->chat ? $this->chat->users()->where('users.id', '!=', auth()->user()->id)->first() : null;
    }

    public function enviarMensaje(){
        $this->validate([
            'mensaje' => 'required'
        ]);

        $this->chat->mensajes()->create([
            'cuerpo' => $this->mensaje,
            'user_id' => auth()->user()->id
        ]);

        Notification::send($this->usuarioNotificar, new NuevoMensaje());
        
        $this->reset('mensaje');
    }

    public function render()
    {
        if($this->chat){
            if($this->chat->unreadMessages > 0){
                $this->chat->mensajes()->where('user_id', '!=', auth()->user()->id)->where('leido', false)->update([
                    'leido' => true
                ]);
            
                Notification::send($this->usuarioNotificar, new NuevoMensaje());
            }

            $this->emit('scrollChat');
        }

        return view('livewire.chat-component');
    }
}
