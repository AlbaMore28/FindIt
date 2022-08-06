@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit  pb-28">
        <div id="modal-eliminar" class="flex flex-col justify-center items-center hidden h-screen w-screen modal-eliminar">
            <div class=" h-80 w-400 bg-white rounded-lg div-modal text-2xl font-semibold text-blue-gray-dark shadow-lg">
                <p class="mb-2">¿Está seguro de que desea eliminar su perfil?</p>
                <div class="btn waves-effect waves-light boton-form mr-2" onclick="cerrarModal()">
                    <span class="texto-boton">Cancelar</span> 
                    <i class="tiny material-icons">clear</i>
                </div>
                <div id="btn-delete" class="btn waves-effect waves-light boton-form">
                    <span class="texto-boton">Eliminar</span> 
                    <i class="tiny material-icons">delete</i>
                </div>
            </div>
        </div>
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Ver Perfil</h1>
        <div class=" w-1280 min-h-300 bg-slate-200 flex rounded-xl shadow-xl">
            <div class="grid grid-cols-2 grid-flow-row gap-x-20 p-20 w-full">
                    <div class="input-field h-11">
                        <input type="text" id="nombre" name="nombre" autocomplete="off" placeholder=" " value="{{$usuario->nombre}}" disabled>
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="input-field">
                        <input type="password" id="password" name="password" autocomplete="off" placeholder=" " value="{{bcrypt($usuario->password)}}" disabled>
                        <label for="password">Contraseña:</label>
                    </div>

                    <div class="input-field h-11">
                        <input type="text" id="apellidos" name="apellidos" autocomplete="off" placeholder=" " value="{{$usuario->apellidos}}" disabled>
                        <label for="apellidos">Apellidos:</label>
                    </div>
                    
                    <div class="input-field h-11">
                        <input type="date" id="fecha_nac" name="fecha_nac" value="{{$usuario->fecha_nac}}" disabled>
                        <label for="fecha_nac">Fecha de Nacimiento:</label>
                    </div>

                    <div class="input-field h-11">
                        <input type="text" id="nombre_usuario" name="nombre_usuario" autocomplete="off" placeholder=" " value="{{$usuario->nombre_usuario}}" disabled>
                        <label for="nombre_usuario">Nombre de Usuario:</label>
                    </div>

                    <div class="input-field">
                        <input type="tel" id="telefono" name="telefono" autocomplete="off" placeholder=" " value="{{$usuario->telefono}}" disabled>
                        <label for="telefono">Teléfono:</label>
                    </div>

                    <div>
                        <label for="imagen_usuario" class="flex flex-col items-start">Imagen de Perfil:</label>
                        @if ($usuario->imageUser)
                            <img src="{{asset('storage/'.$usuario->imageUser->image->url)}}" alt="imagen usuario" class="h-20 rounded-lg  mt-2 shadow-lg">
                        @else
                            <img src="{{asset('storage/img/no_img_perfil.png')}}" alt="imagen usuario" class="h-20 w-28 mt-2 no-img-user">
                        @endif
                    </div>
                    
                    <div class="flex justify-end mt-14">
                        <a class="btn waves-effect waves-light boton-form mr-2" href="#">
                            <span class="texto-boton">Editar</span> 
                            <i class="tiny material-icons">create</i>
                        </a>
                        <a class="btn waves-effect waves-light boton-form" href="#" onclick="activarModal()">
                            <span class="texto-boton">Eliminar</span> 
                            <i class="tiny material-icons">delete</i>
                        </a>
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

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>

    <script>
        function activarModal() {
            $('#modal-eliminar').show();
        }

        function cerrarModal() {
            $("#modal-eliminar").hide();
        }
    </script>

@endsection

