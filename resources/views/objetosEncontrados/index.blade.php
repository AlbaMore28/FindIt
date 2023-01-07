@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray h-full pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Lista Objetos Encontrados</h1>
        @livewire('filtro-objetos-encontrados', compact('categorias', 'colores'))
    </div>
@endsection