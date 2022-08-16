@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Lista Objetos Encontrados</h1>
        <div class="flex flex-row justify-center h-fit">
            <div class="flex flex-col">
                <div class="grid grid-cols-3 grid-rows-3 gap-y-10 gap-x-10 px-10 py-10 border-4 h-fit w-700 border-solid border-white/50 rounded-xl">
                    @foreach ($objetosEncontrados as $objetoEncontrado)
                        <a href="{{route('objetosEncontrados.show', $objetoEncontrado)}}">
                            <div class="flex flex-col items-center text-center text-lg font-semibold text-blue-gray-dark bg-white/50 rounded-xl shadow-sm">  
                                @if (count($objetoEncontrado->objeto->imagesObjeto))
                                    @php
                                        $imagen_url = asset('storage/'. $objetoEncontrado->objeto->imagesObjeto->first()->image->url); 
                                    @endphp
                                @else
                                    @php
                                        $imagen_url = asset('storage/img/no_img.png'); 
                                    @endphp
                                @endif
                                <img class=" h-40 rounded-xl shadow-sm w-full object-cover object-center" src="{{$imagen_url}}" alt="objeto">
                                <p class="name mt-2">{{ucfirst($objetoEncontrado->titulo)}}</p>
                                <p class="quote pb-2">{{$objetoEncontrado->lugar}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{$objetosEncontrados->links('components.pagination')}}
                </div>
            </div>

            <div class="h-864 w-80 ml-10 backdrop-opacity-10 backdrop-invert bg-white/50 rounded-xl">
    
            </div>
        </div>
    </div>
@endsection