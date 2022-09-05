<?php

namespace App\Http\Controllers;

use App\Http\Requests\InicioSesionRequest;
use App\Http\Requests\UserRequest;
use App\Models\Faq;
use App\Models\Image;
use App\Models\ImageUser;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
   public function home()
   {
      /* $user = User::find(13);
      $user->password=bcrypt('1234');
      $user->save(); */
      $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();

      return view('home.index', compact('objetos'));
   }

   public function preguntas(){
      $faqs = Faq::all();

      return view('home.faq', compact('faqs'));
   }

   public function contactar(){
      return view('home.contact');
   }

   public function about(){
      return view('home.about');
   }

   public function vistaRegistroInicioSesion(){
      $objetos = Objeto::where('visibilidad','1')->orderBy('id', 'desc')->take(5)->get();
      
      return view('home.registroInicioSesion', compact('objetos'));
   }

   public function iniciarSesion(InicioSesionRequest $request){
      $credenciales = $request->only(['email','password']);

      if (Auth::attempt($credenciales)) {
         $request->session()->regenerate();
         return redirect()->route('home.index')->with('success','Se ha iniciado sesión correctamente');
      }

      return redirect()->route('home.vistaRegistroInicioSesion')->with('error','Credenciales incorrectas');
   }

   public function cerrarSesion(){
      Auth::logout();
      return redirect()->route('home.index')->with('success','Se ha cerrado sesión correctamente');
   }

   public function registro(UserRequest $request){
      $user = User::make($request->all());
      $user->password = bcrypt($user->password);

      if($request->file('imagen_perfil')){
         $url = Storage::put('users', $request->file('imagen_perfil'));

         $imagen = Image::create([
            'url'=>$url,
            'tipo'=>'user'
         ]);

         $imagen_usuario = new ImageUser;
         $imagen_usuario->image()->associate($imagen);
         $imagen_usuario->save();

         $user->imageUser()->associate($imagen_usuario);
      }
      $user->save();

      $credenciales = $request->only(['email','password']);

      if (Auth::attempt($credenciales)) {
         $request->session()->regenerate();
         return redirect()->route('home.index')->with('success','Se ha registrado correctamente');
      }

      return redirect()->route('home.vistaRegistroInicioSesion')->with('error','Error al intentar registrarse');
   }
}
