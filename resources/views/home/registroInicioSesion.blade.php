@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Acceso</h1>
        <div class="flex flex-col px-5 sm:flex-row sm:px-0">
            <div class="flex flex-col mb-11 w-full sm:w-450 min-h-300 bg-slate-200 rounded-xl shadow-xl mr-24 sm:mb-0">
                <h1 class="text-blue-gray-dark text-center mb-3 text-3xl titulo_seccion">Inicio Sesión</h1>
                <form action="{{route('home.iniciarSesion')}}" method="post" class="grid grid-cols-1 grid-flow-row gap-x-20 p-20 w-full">
                    @csrf
                    
                    <div class="input-field h-11">
                        <input type="email" id="email" name="email" value="{{old('email')}}">
                        <label for="email">Email:</label>
                    </div>
                    @error('email')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
        
                    <div class="input-field h-11">
                        <input type="password" id="password" name="password">
                        <label for="password">Contraseña:</label>
                    </div>
                    @error('password')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror

                    <div class="flex flex-col items-center mt-14">
                        <button class="btn waves-effect waves-light boton-form shadow-lg" type="submit" name="action">
                            <span class="texto-boton">Iniciar Sesion</span> 
                            <i class="tiny material-icons">send</i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex flex-col sm:w-450 min-h-300 bg-slate-200 rounded-xl shadow-xl">
                <h1 class="text-blue-gray-dark text-center mb-3 text-3xl titulo_seccion">Registro</h1>
                <form action="{{route('home.registro')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 grid-flow-row gap-x-20 p-20 w-full">
                    @csrf
                    <div class="input-field h-11">
                        <input type="text" id="nombre" name="nombre" value="{{old('nombre')}}">
                        <label for="nombre">Nombre:</label>
                    </div>
                    @error('nombre')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
                    
                    <div class="input-field h-11">
                        <input type="text" id="apellidos" name="apellidos" value="{{old('apellidos')}}">
                        <label for="apellidos">Apellidos:</label>
                    </div>
                    @error('apellidos')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
                    
                    <div class="input-field h-11">
                        <input type="text" id="nombre_usuario" name="nombre_usuario" value="{{old('nombre_usuario')}}">
                        <label for="nombre_usuario">Nombre de usuario:</label>
                    </div>
                    @error('nombre_usuario')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
            
                    <div class="input-field h-11">
                        <input type="date" id="fecha_nac" name="fecha_nac" value="{{old('fecha_nac')}}">
                        <label for="fecha_nac">Fecha de Nacimiento:</label>
                    </div>
                    @error('fecha_nac')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror

            
                    <div class="input-field h-11">
                        <input type="tel" id="telefono" name="telefono" value="{{old('telefono')}}">
                        <label for="telefono">Teléfono:</label>
                    </div>
                    @error('telefono')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
            
                    <div class="input-field h-11">
                        <input type="email" id="email" name="email" value="{{old('email')}}">
                        <label for="email">Email:</label>
                    </div>
                    @error('email')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
            
                    <div class="input-field h-11">
                        <input type="password" id="password" name="password">
                        <label for="password">Contraseña:</label>
                    </div>
                    @error('password')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
            
                    <div class="input-field h-11">
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                    </div>
                    @error('password_confirmation')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
            
                    <div class="flex flex-col items-start mt-12">
                        <label for="imagen_perfil">Imagen de perfil:</label>
                        <div class="flex">
                            <label for="imagen_perfil" class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light boton-file shadow-lg">
                                <i class="material-icons text-white icono-file-movil sm:relative sm:top-1.5 sm:left-0 ">add</i>
                            </label>
                            <img id="imagenPrevisualizacion" class="h-10 w-10 rounded-full ml-2 shadow-lg hidden">
                        </div>
                        <input type="file" id="imagen_perfil" name="imagen_perfil">
                    </div>
                    @error('imagen_perfil')
                        <small class="text-red-700 text-left">
                            *{{$message}}
                        </small>
                    @enderror
                    
                    <div class="flex flex-col items-center mt-14">
                        <button class="btn waves-effect waves-light boton-form shadow-lg" type="submit" name="action">
                            <span class="texto-boton">Registrarse</span> 
                            <i class="tiny material-icons">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center">
            <hr>
        </div>
        <x-destacados :objetos='$objetos'/>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
        $(document).ready(function(event) {
            /* $( "label" ).removeClass("active"); */
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

        // Obtener referencia al input y a la imagen
        const $seleccionArchivos = document.querySelector("#imagen_perfil"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
            $("#imagenPrevisualizacion").removeClass("hidden");
        });
    </script>
@endsection