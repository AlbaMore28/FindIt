@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Administración de Objetos</h1>
        <div class="flex flex-row justify-center h-fit">
            <div class="flex flex-col">
                <div class="h-864 grid grid-cols-1 gap-y-10 gap-x-10 px-10 py-10 border-4 w-700 border-solid border-white/50 rounded-xl overflow-auto">
                    @foreach ($objetos as $objeto)
                        
                            <div class="h-56 w-924 flex bg-white/50 rounded-xl shadow-sm items-center">
                                <img class="h-40 w-56 rounded-xl shadow-sm object-cover object-center mx-10" src="{{ asset('storage/'. $objeto->imagesObjeto->first()->image->url) }}" alt="objeto">
                                <div class="flex flex-col w-64 items-center text-center text-lg font-semibold text-blue-gray-dark">
                                    <p class="name mt-2">{{ucfirst($objeto->titulo)}}</p>
                                    <p class="quote pb-2">{{$objeto->lugar}}</p>
                                    <p class="rol italic mt-4">{{ucfirst($objeto->tipo)}}</p>
                                </div>
                                @if ($objeto->tipo == 'buscado')
                                    @php
                                        $ruta = 'objetosBuscados.show';
                                    @endphp
                                @else
                                    @php
                                        $ruta = 'objetosEncontrados.show';
                                    @endphp
                                @endif
                                <a href="{{route($ruta, $objeto)}}" class="boton-detalles">
                                    <div class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light shadow-lg text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 icono-detalles" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            
                    @endforeach
                </div>
            </div>

            <div class="h-864 w-80 ml-10 backdrop-opacity-10 backdrop-invert bg-white/50 rounded-xl">
    
            </div>
        </div>
    </div>
@endsection