@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col justify-center bg-gradient-to-t from-blush via-steel to-blue-gray h-full pb-28">
        <div class="flex flex-col sm:flex-row justify-center sm:h-400">
            <x-tarjeta link="{{asset('storage/img/mapa_final2.png')}}" link2="{{asset('storage/img/mapa_reves.png')}}" rutaCrear="{{route('objetosBuscados.create')}}" rutaListar="{{route('objetosBuscados.index')}}">
                <x-slot name="accion">
                    estás <span class="acentuar_letras">buscando</span> 
                </x-slot>
                <x-slot name="accion2">
                    Buscado
                </x-slot>
            </x-tarjeta>
            <div class="sm:flex flex-col text-center mt-80 text-white items-center hidden">
                <p class="font-semibold text-sm drop-shadow-lg">Quizás<br>te<br>interesen...</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mt-7 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                </svg>
            </div>
            <x-tarjeta link="{{asset('storage/img/prismaticos.png')}}" link2="{{asset('storage/img/prismaticos_reves.png')}}" rutaCrear="{{route('objetosEncontrados.create')}}" rutaListar="{{route('objetosEncontrados.index')}}">
                <x-slot name="accion">
                    has <span class="acentuar_letras">encontrado</span>
                    <x-slot name="accion2">
                        Encontrado
                    </x-slot>
                </x-slot>
            </x-tarjeta>
        </div>
        <div class="flex justify-center">
            <hr>
        </div>
        <x-destacados :objetos='$objetos'/>
    </div>
@endsection

