@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray h-full pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Mis Registros</h1>
        @livewire('filtro-objetos', compact('categorias', 'colores'))
    </div>
@endsection