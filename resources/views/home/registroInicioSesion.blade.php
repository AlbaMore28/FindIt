@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit">
        <form action="{{route('home.iniciarSesion')}}" method="post">
            @csrf

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password"><br><br>

            <button type="submit">Iniciar Sesion</button>
        </form>
        <a href="{{route('home.index')}}">home</a>
    </div>
@endsection