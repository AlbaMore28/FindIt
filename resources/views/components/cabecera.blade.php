<!-- Background image -->
<div class="relative overflow-hidden bg-no-repeat bg-cover background_image">
  <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed filtro_cabecera">
    <div class="flex flex-col justify-end h-full">
      <div class="flex flex-row justify-between text-center text-white mb-24 px-6 md:px-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mt-9" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <a id="enlace" href="{{route('home.index')}}" class="flex flex-row justify-center text-center">
          <img id="imagen" class="h-14 w-14 mt-32" alt="" src="{{asset('storage/img/brujula_blanca.png')}}" >
          <h1 id="titulo" class="text-5xl font-bold mb-6 titulo">FindIt</h1>
        </a>
        <div id="login" class="flex flex-col justify-items-center mt-8 text-white">
          @auth
            @if (Auth::user()->imageUser)
              <img src="{{asset('storage/'.Auth::user()->imageUser->image->url)}}" class="h-12 w-12 ml-3 mb-1 rounded-full border-2 border-solid border-white" alt="imagen user">
            @else
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            @endif
            <div class="flex">
              <div class="flex flex-col">
                <p class="text-xs text-center">{{ucfirst(Auth::user()->nombre_usuario)}}</p>
                <a href="{{route('home.cerrarSesion')}}" class="text-xs text-center">Cerrar Sesión</a>
              </div>
              <div class="flex flex-col justify-items-start">
                <svg id="tools-desplegable" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div id="dropdownDotsHorizontal" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 hide desplegable">
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                      <a href="{{route('usuarios.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ver Perfil</a>
                    </li>
                    <li>
                      <a href="{{route('objetos.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mis Registros</a>
                    </li>
                  </ul>
                  @role('Administrador')
                    <div class="py-1">
                      <ul>
                        <li>
                          <a href="{{route('admin.objetos.index')}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Administrar Objetos</a>
                        </li>
                        <li>
                          <a href="{{route('admin.usuarios.index')}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Administrar Usuarios</a>
                        </li>
                      </ul>
                    </div>
                  @endrole
                </div>
              </div>
            </div>
          @endauth
          @guest
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <a href="{{route('home.vistaRegistroInicioSesion')}}" class="text-xs text-center">Regitrarse/<br>Iniciar Sesión</a>
          @endguest
        </div>
      </div>
      <div class="h-14">
        <ul id="nav" class="flex flex-row justify-center h-14 nav_bar_cabecera items-center">
          <li class="nav-item px-2">
            <a class="nav-link block pr-2 lg:px-2 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out nav_boton"
              href="{{route('home.index')}}" data-mdb-ripple="true" data-mdb-ripple-color="light">HOME</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link block pr-2 lg:px-2  hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out nav_boton"
              href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light">ABOUT</a>
          </li>
          @can('home.faq')
            <li class="nav-item px-2">
              <a class="nav-link block pr-2 lg:px-2  hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out nav_boton"
                href="{{route('home.faq')}}" data-mdb-ripple="true" data-mdb-ripple-color="light">FAQ</a>
            </li>
          @endcan
          <li class="nav-item px-2">
            <a class="nav-link block pr-2 lg:px-2  hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out nav_boton"
              href="{{route('home.contact')}}" data-mdb-ripple="true" data-mdb-ripple-color="light">CONTACT</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Background image -->

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    <script>

        scrolled = false;

        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            if($(window).scrollTop() > 180 && !scrolled){
                $('#nav').removeClass("nav_bar_cabecera");
                $('#nav').removeClass("h-14");
                $('#titulo').removeClass("titulo");
                $('#login').removeClass("mt-8");
                $('#login').removeClass("text-white");
                $('#nav').addClass("nav_bar_scroll");
                $('#enlace').addClass("enlace_titulo_nav");
                $('#titulo').addClass("titulo_nav");
                $('#login').addClass("login_nav");
                $("#imagen").attr("src","{{ asset('storage/img/brujula_azul.png') }}");
                $('#imagen').removeClass("h-14");
                $('#imagen').removeClass("mt-32");
                $('#imagen').addClass("img_nav");
                
                
                scrolled = true;
            }
            if($(window).scrollTop() < 180 && scrolled){
                $('#titulo').removeClass("titulo_nav");
                $("#imagen").attr("src","{{ asset('storage/img/brujula_blanca.png') }}");
                $('#imagen').addClass("h-14");
                $('#imagen').addClass("mt-32");
                $('#imagen').removeClass("img_nav");
                $('#enlace').removeClass("enlace_titulo_nav");
                $('#nav').removeClass("nav_bar_scroll");
                $('#titulo').addClass("titulo");
                $('#nav').addClass("nav_bar_cabecera");
                $('#nav').addClass("h-14");
                $('#login').addClass("mt-8");
                $('#login').addClass("text-white");
                $('#login').removeClass("login_nav");

                scrolled = false;
            }
        });

        $('#tools-desplegable').click(function(event){
          if($('#dropdownDotsHorizontal').hasClass("hide")){
            $('#dropdownDotsHorizontal').removeClass("hide");
          }
          else{
            $('#dropdownDotsHorizontal').addClass("hide");
          }
        });
    </script>
