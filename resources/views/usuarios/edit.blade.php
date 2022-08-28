@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit  pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Editar Perfil</h1>
        <div class=" w-1280 min-h-300 bg-slate-200 flex rounded-xl shadow-xl">
            <form action="{{route('usuarios.update')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 grid-flow-row gap-x-20 p-20 w-full">
                @csrf
                    <div class="input-field h-11">
                        <input type="text" id="nombre" name="nombre" autocomplete="off" placeholder=" " value="{{$usuario->nombre}}">
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="input-field">
                        <input type="tel" id="telefono" name="telefono" autocomplete="off" placeholder=" " value="{{$usuario->telefono}}">
                        <label for="telefono">Teléfono:</label>
                    </div>

                    <div class="input-field h-11">
                        <input type="text" id="apellidos" name="apellidos" autocomplete="off" placeholder=" " value="{{$usuario->apellidos}}">
                        <label for="apellidos">Apellidos:</label>
                    </div>
                    
                    <div class="input-field h-11">
                        <input type="date" id="fecha_nac" name="fecha_nac" value="{{$usuario->fecha_nac}}">
                        <label for="fecha_nac">Fecha de Nacimiento:</label>
                    </div>

                    <div class="input-field h-11">
                        <input type="text" id="nombre_usuario" name="nombre_usuario" autocomplete="off" placeholder=" " value="{{$usuario->nombre_usuario}}">
                        <label for="nombre_usuario">Nombre de Usuario:</label>
                    </div>

                    <div class="input-field">
                    </div>

                    @if ($usuario->imageUser)
                        @php
                            $src_perfil = asset('storage/'.$usuario->imageUser->image->url);
                        @endphp
                    @else
                        @php
                            $src_perfil = "";
                        @endphp
                    @endif
                    <div class="flex flex-col items-start mt-12">
                        <label for="imagen_perfil">Imagen de perfil:</label>
                        <div class="flex">
                            <label for="imagen_perfil" class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light boton-file shadow-lg">
                                <i class="material-icons text-white icono-file">add</i>
                            </label>
                            <img id="imagenPrevisualizacion" class="h-10 w-10 rounded-full ml-2 shadow-lg  @if (!$usuario->imageUser) hidden @endif" src="{{$src_perfil}}">
                        </div>
                        <input type="file" id="imagen_perfil" name="imagen_perfil">
                    </div>
                    
                    <div class="flex flex-col items-end mt-14">
                        <button class="btn waves-effect waves-light boton-form" type="submit" name="action">
                            <span class="texto-boton">Actualizar</span> 
                            <i class="tiny material-icons">send</i>
                        </button>
                    </div>
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
                $("#imagenPrevisualizacion").addClass("hidden");
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

