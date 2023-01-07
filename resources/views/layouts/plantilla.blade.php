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
        @livewireStyles
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
        <header>
            <x-cabecera/>
        </header>
        
        <main>
            @if (session('success'))
                <x-alerta color='green' :mensaje="session('success')"/>
            @endif
            @if (session('info'))
                <x-alerta color='yellow' :mensaje="session('info')"/>
            @endif
            @if (session('error'))
                <x-alerta color='red' :mensaje="session('error')"/>
            @endif

            <div class="flex justify-between text-center sm:hidden relative" style="margin-top: -36px">
                <svg id="nav-desplegable" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 ml-2 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>
                <div id="desplegable-vertical-nav" class="w-full z-10 absolute mt-9 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 hidden">
                  <ul class="text-gray-700 dark:text-gray-200">
                    <li>
                      <a href="{{route('home.index')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">HOME</a>
                    </li>
                    <li>
                      <a href="{{route('home.about')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ABOUT</a>
                    </li>
                    <li>
                      <a href="{{route('home.faq')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">FAQ</a>
                    </li>
                    <li>
                      <a href="{{route('home.contact')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">CONTACT</a>
                    </li>
                  </ul>
                </div>
                @auth
                  <svg id="tools-desplegable" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 mb-2 text-white tools-desplegable" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <div id="dropdownDotsHorizontalMobile" class="z-10 w-full bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 hidden desplegable-mobile">
                    <ul class=" text-gray-700 dark:text-gray-200">
                      <li>
                        <a href="{{route('usuarios.index')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ver Perfil</a>
                      </li>
                      <li>
                        <a href="{{route('objetos.index')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mis Registros</a>
                      </li>
                      <li>
                        <a href="{{route('home.cerrarSesion')}}" class="block py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cerrar Sesión</a>
                      </li>
                    </ul>
                    @can('admin.usuarios.index')
                    <div class="py-1">
                      <ul>
                        <li>
                          <a href="{{route('admin.objetos.index')}}" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Administrar Objetos</a>
                        </li>
                        <li>
                          <a href="{{route('admin.usuarios.index')}}" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Administrar Usuarios</a>
                        </li>
                      </ul>
                    </div>
                    @endcan
                  </div>
                @endauth
              </div>

            @yield('contenido')
        </main>

        <footer>
            <x-footer/>
        </footer>
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(document).ready(function(){
                $info = $('#info');
                if($info.length){
                    setTimeout(function(){
                        $info.addClass('hidden');
                    }, 7000);
                    $('#close-info').click(function (){
                        $info.hide();
                    });
                }
                $('body').children('#h_b_bfsin').css("display","none");
            });

            $('#nav-desplegable').click(function(event){
                if($('#desplegable-vertical-nav').hasClass("hidden")){
                  $('#desplegable-vertical-nav').removeClass("hidden");
                }
                else{
                  $('#desplegable-vertical-nav').addClass('hidden');
                }
            });

            $('#tools-desplegable').click(function(event){
              if($('#dropdownDotsHorizontalMobile').hasClass("hidden")){
                $('#dropdownDotsHorizontalMobile').removeClass("hidden");
              }
              else{
                $('#dropdownDotsHorizontalMobile').addClass('hidden');
              }
            });

            $(window).click(function(event) {
              if (event.target.id != "nav-desplegable" && 
                  event.target.id != ("desplegable-vertical-nav") 
              ) {
                if(!$('#desplegable-vertical-nav').hasClass("hidden")){
                  $("#desplegable-vertical-nav").addClass('hidden');
                }
              } 
              
              if (event.target.id != "tools-desplegable" && 
                  event.target.id != ("dropdownDotsHorizontalMobile") 
              ) {
                if(!$('#dropdownDotsHorizontalMobile').hasClass("hidden")){
                  $("#dropdownDotsHorizontalMobile").addClass('hidden');
                }
              } 
            });
        </script>
        @livewireScripts
        @yield('js')
    </body>
</html>