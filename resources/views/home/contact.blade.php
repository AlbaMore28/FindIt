@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
      <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Contáctanos</h1>
      <div class="flex flex-col w-5/6 px-5 sm:flex-row sm:w-1280 min-h-300 bg-slate-200 rounded-xl shadow-xl sm:px-0">
        <form action="{{route('emails.contactanos')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 p-10 sm:grid-cols-2 grid-flow-row sm:gap-x-20 sm:p-20 w-full">
          @csrf
            <div class="input-field text-left">
              <input type="text" id="nombre" name="nombre" autocomplete="off" placeholder=" "  value="{{old('nombre')}}">
              <label for="nombre">Nombre:</label>
              @error('nombre')
                <small class="text-red-700">
                  *{{$message}}
                </small>
              @enderror
            </div>

            <div class="input-field text-left">
              <input type="text" id="email" name="email" autocomplete="off" placeholder=" " value="{{old('email')}}">
              <label for="email">Email:</label>
              @error('email')
                <small class="text-red-700">
                  *{{$message}}
                </small>
              @enderror
            </div>

            <div class="input-field sm:col-span-2 row-span-3 text-left">
              <textarea name="mensaje" id="mensaje" style="resize: none" class="h-full border-b border-solid border-blue-gray-dark">{{old('mensaje')}}</textarea>
              <label for="mensaje">Mensaje:</label>
              @error('mensaje')
                <small class="text-red-700">
                  *{{$message}}
                </small>
              @enderror
            </div>
            
            <div></div>

            <div class="flex flex-col items-center sm:items-end mt-14">
                <button class="btn waves-effect waves-light boton-form" type="submit" name="action">
                    <span class="texto-boton">Enviar</span> 
                    <i class="tiny material-icons">send</i>
                </button>
            </div>
        </form>
      </div>  
    </div>
@endsection

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script>
    $(document).ready(function(event) {
      $( ".input-field" ).each(function(){
          if($( this ).children("input").val() == "" || $( this ).children("textarea").val() == ""){
              if($( this ).children("input").attr('name') != "categoria"){
                  $( this ).children("label").removeClass("active"); 
              }
          }  
      });

      $( ".input-field" ).focus(
          function() {
              $( this ).children("label").addClass("active");   
          }
      );
      $( ".input-field" ).focusout(
          function() {
              if($( this ).children("input").val() == ""){
                  $( this ).children("label").removeClass("active"); 
              }  
          }
      );
    });
  </script>
@endsection