@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Sobre Nosotros</h1>
        <div class="flex flex-col sm:flex-row items-center justify-center text-center sm:w-700">
            <img class="h-96 sm:h-128 rounded-lg shadow-lg order-last sm:order-first mt-4 sm:mt-0" src="{{asset('storage/img/img_about.png')}}" alt="imagen about">
            <div class="flex flex-col text-justify px-10 sm:px-0 sm:pl-10">
                <p>
                    Este proyecto nace a partir de una experiencia personal a la hora de poder, tanto recuperar objetos
                    perdidos, como de encontrar a los dueños de un objetos encontrado.
                </p>
                <p>
                    De esta manera, FindIt trata de acercarnos a todos de forma que podamos tanto,
                    localizar lo antes posible nuestros enseres, como poder ayudar a alguien en la
                    búsqueda de los mismos.
                </p>
            </div>
        </div>
    </div>
@endsection