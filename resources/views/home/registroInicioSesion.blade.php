@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Acceso</h1>
        <div class="flex">
            <div class="flex flex-col mr-24">
                <h1 class="text-white text-center mb-3 text-3xl titulo_seccion">Inicio Sesión</h1>
                <form action="{{route('home.iniciarSesion')}}" method="post">
                    @csrf
        
                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email"><br>
        
                    <label for="password">Contraseña:</label><br>
                    <input type="password" id="password" name="password"><br><br>
        
                    <button type="submit">Iniciar Sesion</button>
                </form>
            </div>
            <div class="flex flex-col ml-24">
                <h1 class="text-white text-center mb-3 text-3xl titulo_seccion">Registro</h1>
                <form action="{{route('home.registro')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre"><br>
        
                    <label for="apellidos">Apellidos:</label><br>
                    <input type="text" id="apellidos" name="apellidos"><br>
        
                    <label for="nombre_usuario">Nombre de usuario:</label><br>
                    <input type="text" id="nombre_usuario" name="nombre_usuario"><br>
        
                    <label for="fecha_nac">Fecha de Nacimiento:</label><br>
                    <input type="date" id="fecha_nac" name="fecha_nac"><br>
        
                    <label for="telefono">Teléfono:</label><br>
                    <input type="text" id="telefono" name="telefono"><br>
        
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email"><br>
        
                    <label for="password">Contraseña:</label><br>
                    <input type="password" id="password" name="password"><br><br>
        
                    <label for="password_confirmation">Confirmar Contraseña:</label><br>
                    <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
        
                    <label for="imagen_perfil">Imagen de perfil:</label><br>
                    <input type="file" id="imagen_perfil" name="imagen_perfil"><br><br>
        
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
@endsection