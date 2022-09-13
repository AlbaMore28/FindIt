<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        @yield('css')
        <title>FindIt</title>
        <link rel="icon" href="{{ asset('storage/img/brujula.png') }}">
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        <div class="h-screen w-screen flex flex-col items-center justify-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray">
            <div class="mx-4 sm:mx-0 flex flex-col sm:w-1/2 sm:h-1/2 items-center justify-center py-5 px-10 border-4 border-solid border-white/50 rounded-xl text-justify">
                <div class="flex flex-col sm:flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-64 h-24 sm:mr-7 mr-0 text-red-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <p class="text-blue-gray-dark font-semibold">
                        Su cuenta ha sido bloqueada y no se le permite navegar por el sistema. Si no conoce las razones 
                        o no está de acuerdo con esta decisión, puede ponerse en contacto con nosotros a través del correo: <span class="text-black">findit@support.es</span> 
                    </p>
                </div>
                <a class="btn waves-effect waves-light boton-form mt-4 sm:mt-5" href="{{route('home.cerrarSesion')}}">
                    <span class="texto-boton">Salir</span> 
                    <i class="tiny material-icons">exit_to_app</i>
                </a>
            </div>
        </div>
    </body>