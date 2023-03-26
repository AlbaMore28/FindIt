<?php

namespace App\Http\Controllers;

use App\Http\Requests\InicioSesionRequest;
use App\Http\Requests\MensajeRequest;
use App\Http\Requests\UserRequest;
use App\Mail\ContactanosMailable;
use App\Models\Chat;
use App\Models\Faq;
use App\Models\Image;
use App\Models\ImageUser;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
   public function index(Request $request)
   {
      $userIdSelected = $request->get('user_id');
      $chat = null;

      if(!empty($userIdSelected)){
         $userIdAuth = Auth::user()->id;

         $chat = Chat::whereHas('users', function($query) use ($userIdSelected){
            $query->where('user_id', $userIdSelected);
         })->whereHas('users', function($query) use ($userIdAuth){
            $query->where('user_id', $userIdAuth);
         })->get()->first();


         if(empty($chat)){
            $chat = Chat::create([]);
            $chat->users()->attach([
               $request->get('user_id'),
               Auth::user()->id
            ]);
            $chat->save();
         }
      }

      return view('chat.index', compact('chat'));
   }
}
