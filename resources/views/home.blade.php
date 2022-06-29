@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-row justify-center h-400">
        <x-tarjeta link="{{ asset('storage/img/mapa_final2.png') }}" link2="{{ asset('storage/img/mapa_reves.png') }}">
            <x-slot name="accion">
                estás <span class="acentuar_letras">buscando</span> 
            </x-slot>
            <x-slot name="accion2">
                Buscado
            </x-slot>
        </x-tarjeta>
        <div class="flex flex-col text-center mt-80 text-white">
            <p class="font-semibold text-sm drop-shadow-lg">Quizás<br>te<br>interesen...</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mt-7 ml-3 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
            </svg>
        </div>
        <x-tarjeta link="{{ asset('storage/img/prismaticos.png') }}" link2="{{ asset('storage/img/prismaticos_reves.png') }}">
            <x-slot name="accion">
                has <span class="acentuar_letras">encontrado</span>
                <x-slot name="accion2">
                    Encontrado
                </x-slot>
            </x-slot>
        </x-tarjeta>
    </div>
@endsection