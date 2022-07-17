@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">{{$objetoBuscado->objeto->titulo}}</h1>
    </div>

@endsection