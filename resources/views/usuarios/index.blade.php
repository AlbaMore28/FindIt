@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit  pb-28">
        <div id="mi-modal-cargar" class="flex flex-col justify-center items-center h-screen w-screen hidden">
            <div>
                <img class="w-full" src="{{asset('storage/img/spinner.png')}}" alt="">
            </div>
        </div>
        <div id="mi-modal-eliminar" class="flex flex-col justify-center items-center h-screen w-screen mi-modal-eliminar hidden">
            <div class="h-80 w-400 bg-white rounded-lg div-mi-modal text-2xl font-semibold text-blue-gray-dark shadow-lg">
                <p class="mb-2">¿Está seguro de que desea eliminar su perfil?</p>
                <div class="flex w-full justify-center">
                    <div class="btn waves-effect waves-light boton-form mr-2" onclick="cerrarModalEliminar()">
                        <span class="texto-boton">Cancelar</span> 
                        <i class="tiny material-icons">clear</i>
                    </div>
                   
                    <a id="btn-delete" class="btn waves-effect waves-light boton-form" href="{{route('usuarios.destroy')}}">
                        <span class="texto-boton">Eliminar</span> 
                        <i class="tiny material-icons">delete</i>
                    </a>
                    
                </div>
            </div>
        </div>
        <div id="mi-modal-password" class="flex flex-col justify-center items-center h-screen w-screen mi-modal-eliminar hidden">
            <form id="cambiarPassword" action="{{route('api.usuarios.editarPassword')}}" method="POST" class="grid grid-cols-2 gap-x-10 gap-y-8 py-8 h-fit content-center px-20 w-400 bg-white rounded-lg div-mi-modal text-2xl font-semibold text-blue-gray-dark shadow-lg">
                <div class="input-field margin-0">
                    <input type="password" id="password_old" name="password_old">
                    <label for="password_old">Contraseña Actual:</label>
                </div>
                
                <div class="input-field margin-0">
                    <input type="password" id="password" name="password">
                    <label for="password">Contraseña Nueva:</label>
                </div>

                <div class="input-field margin-0">
                </div>

                <div class="input-field margin-0">
                    <input type="password" id="password_confirmation" name="password_confirmation">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                </div>

                <div class="btn waves-effect waves-light boton-form mr-2" onclick="cerrarModalPassword()">
                    <span class="texto-boton">Cancelar</span> 
                    <i class="tiny material-icons">clear</i>
                </div>
                <button class="btn waves-effect waves-light boton-form" type="submit">
                    <span class="texto-boton">Actualizar</span> 
                    <i class="tiny material-icons">send</i>
                </button>
                    
            </form>
        </div>
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Ver Perfil</h1>
        <div class=" w-1280 min-h-300 bg-slate-200 flex rounded-xl shadow-xl">
            <div class="grid grid-cols-2 grid-flow-row gap-x-20 p-20 w-full">
                    <div class="input-field h-11">
                        <input type="text" id="nombre" name="nombre" autocomplete="off" placeholder=" " value="{{$usuario->nombre}}" disabled>
                        <label for="nombre">Nombre:</label>
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

                    <div class="input-field h-11">
                    </div>

                    <div>
                        <label for="imagen_usuario" class="flex flex-col items-start">Imagen de Perfil:</label>
                        @if ($usuario->imageUser)
                            <img src="{{asset('storage/'.$usuario->imageUser->image->url)}}" alt="imagen usuario" class="h-20 rounded-lg  mt-2 shadow-lg">
                        @else
                            <img src="{{asset('storage/img/no_img.png')}}" alt="imagen usuario" class="h-20 w-28 mt-2 no-img-user">
                        @endif
                    </div>
                    
                    <div class="flex justify-end mt-14">
                        <button class="btn waves-effect waves-light boton-form mr-2" onclick="activarModalPassword()">
                            <span class="texto-boton">Editar Contraseña</span> 
                            <i class="tiny material-icons">create</i>
                        </button>
                        <a class="btn waves-effect waves-light boton-form mr-2" href="{{route('usuarios.edit')}}">
                            <span class="texto-boton">Editar</span> 
                            <i class="tiny material-icons">create</i>
                        </a>
                        <button class="btn waves-effect waves-light boton-form" onclick="activarModalEliminar()">
                            <span class="texto-boton">Eliminar</span> 
                            <i class="tiny material-icons">delete</i>
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

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function (){
            $("#cambiarPassword").submit(function(e) {
                $('#mi-modal-cargar').removeClass('hidden');
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), 

                }).done(function(data){
                    $('#mi-modal-cargar').addClass('hidden');
                    cerrarModalPassword();
                    alert(data);
                }).fail(function(err) {
                    $('#mi-modal-cargar').addClass('hidden');
                    alert(JSON.parse(err.responseText));
                })
            });
        });

        function activarModalEliminar() {
            $('#mi-modal-eliminar').show();
        }

        function cerrarModalEliminar() {
            $("#mi-modal-eliminar").hide();
        }
        function activarModalPassword() {
            $('#mi-modal-password').show();
        }

        function cerrarModalPassword() {
            $("#mi-modal-password").hide();
        }

    </script>

@endsection

