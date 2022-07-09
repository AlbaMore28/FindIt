@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit">
        <h1 class="text-white mt-20 text-2xl font-bold mb-11">Lista Objetos Buscados</h1>
        <div class="flex flex-row justify-center h-fit">
            <div class="flex flex-col">
                <div class="grid grid-cols-3 grid-rows-3 gap-y-10 px-5 py-10 border-4 h-fit w-700 border-solid border-white/50 rounded">
                    @foreach ($objetosBuscados as $objetoBuscado)
                        <div class="flex flex-col items-center text-center">
                            <img class=" h-40 rounded shadow-xl" src="{{ asset('storage/'. $objetoBuscado->imagesObjeto->first()->image->url)}}" alt="objeto">
                            <p class="name">{{$objetoBuscado->titulo}}</p>
                            <p class="quote">{{$objetoBuscado->lugar}}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{$objetosBuscados->links('components.pagination')}}
                </div>
            </div>

            <div class="h-792 w-80 ml-10 backdrop-opacity-10 backdrop-invert bg-white/50 rounded">
    
            </div>
        </div>
    </div>
@endsection