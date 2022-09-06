@extends('layouts.plantilla')

@section('contenido')
    <div class="flex flex-col items-center md:text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit pb-28">
        <h1 class="text-white mt-10 text-center md:mt-20 mb-11 titulo_seccion">Preguntas Frecuentes</h1>
        <div class="grid grid-cols-1 gap-x-12 gap-y-10 sm:w-full md:w-4/5 lg:w-3/5 pl-1 pr-3 md:pl-0 md:pr-0">
            @foreach ($faqs as $faq)
                <div class="flex flex-col w-full">
                    <div class="flex justify-center">
                        <p class="font-star font-medium ">À</p>
                        <div class="flex justify-center items-center w-full py-2.5 px-1 border-4 border-solid bg-white/50 rounded-lg text-xl text-blue-gray-dark">
                            <p>{{ $faq->pregunta }}</p>
                        </div>
                    </div>
                    <div class="flex justify-center mt-6">
                        <p class="font-bulb  font-medium">b</p>
                        <p class="w-full text-xl text-white font-medium">
                            {!! $faq->respuesta !!}
                        </p>
                    </div> 
                </div>

                <div class="flex justify-center">
                    <hr class=" w-full h-0.5 text-white">
                </div>
            @endforeach
        </div>
    </div>
@endsection