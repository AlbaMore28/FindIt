@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Administración de Usuarios</h1>
        @livewire('filtro-usuarios', compact('roles'))
    </div>
@endsection