<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function home()
   {
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

   public function vistaRegistroInicioSesion(){
      return view('home.registroInicioSesion');
   }

   public function iniciarSesion(Request $request){
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
}
