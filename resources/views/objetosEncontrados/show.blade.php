@extends('layouts.plantilla')
@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">{{ucfirst($objetoEncontrado->objeto->titulo)}}</h1>
        <div class="flex h-400 w-1280 justify-center border-4 border-solid border-white/50 rounded-xl">
            <div class="flex flex-col imagen-objeto">
                <img class="imagen-principal rounded-xl shadow-lg" src="{{ asset('storage/'. $objetoEncontrado->objeto->imagesObjeto->first()->image->url)}}" alt="objeto" onclick="activarModal(this.src, 0)">
                <div id="imagen-modal" class="hidden h-screen w-screen modal">
                    <img id="img-mod" class="rounded-xl shadow-lg img-modal w-2/5" alt="objeto">
                    <div class="button-container w-2/5">
                        <div class="button-desplazar-img" onclick="desplazarImagen(false)"><i class="fas fa-angle-left"></i></div>
                        <div class="button-desplazar-img" onclick="desplazarImagen(true)"><i class="fas fa-angle-right"></i></div>
                    </div>
                    <div class="modal-close">
                        <i class="fas fa-close h-6 w-6"></i>
                    </div>
                </div>
                @if (count($objetoEncontrado->objeto->imagesObjeto)>1)
                    <p class=" text-sm text-left mt-7">Más imágenes</p>
                    <div class="flex">
                        @foreach ($objetoEncontrado->objeto->imagesObjeto as $imagen)
                            @if (!$loop->first && $loop->iteration < 4 && !$loop->last)
                                <img class="imagen-pequenia mt-3 mr-2 rounded-xl" src="{{ asset('storage/'.$imagen->image->url)}}" alt="objeto" onclick="activarModal(this.src, {{$loop->index}})">
                            @endif

                            @if ($loop->last)
                                <img class="imagen-pequenia mt-3 rounded-xl shadow-lg" src="{{ asset('storage/'.$imagen->image->url)}}" alt="objeto" onclick="activarModal(this.src, {{$loop->index}})">
                            @endif 
                        @endforeach
                    </div>
                @endif
                
            </div>
            
            <div class="flex flex-col w-1/2 h-full cuadro_info">
                <div class="flex">
                    <div id="pestania-1" class="h-12 w-1/3 border-2 border-solid border-gray-400 bg-white/30 pestania hover:cursor-pointer" onclick="activarPestania(1)">
                        <p class="titulo-pestania font-bold">Descripción</p>
                    </div>
                    <div id="pestania-2" class="h-12 w-1/3 border-2 border-solid border-gray-400 bg-white/30 hover:cursor-pointer" onclick="activarPestania(2)">
                        <p class="titulo-pestania font-bold">Lugar</p>
                    </div>
                    <div id="pestania-3" class="h-12 w-1/3 border-2 border-solid border-gray-400 bg-white/30 hover:cursor-pointer" onclick="activarPestania(3)">
                        <p class="titulo-pestania font-bold">Datos</p>
                    </div>
                </div>

                {{-- Pestaña descripción --}}
                <div id="contenido-pestania-1" class="flex items-center w-full h-1/2 cuadro_grande bg-white/50 border-2 border-solid border-gray-400">
                    <p class=" ml-28 icono-lugar font-medium text-4xl text-blue-gray-dark">]</p>
                    <p class="ml-2 w-96 font-semibold text-blue-gray-dark">{{$objetoEncontrado->objeto->descripcion}}</p>
                </div>

                {{-- Pestaña lugar --}}
                <div id="contenido-pestania-2" class="flex w-full h-1/2 cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe class="h-60 mt-14 ml-7" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                        </div>
                    </div>
                    <p class="icono-lugar text-red-600 font-bold text-2xl mt-32 ml-5">l</p>
                    <p class="mt-32 font-semibold text-blue-gray-dark">{{$objetoEncontrado->objeto->lugar}}</p>
                </div>

                {{-- Pestaña datos --}}
                <div id="contenido-pestania-3" class=" w-full h-1/2 cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                    <div class="flex flex-col my-32 mx-56">
                        <div class="flex">
                            <p class="icono-chincheta font-medium text-xl">Q</p>
                            <p class="font-semibold text-blue-gray-dark">Categoría: {{$objetoEncontrado->objeto->categoria}}</p>
                        </div>
                        <div class="flex">
                            <p class="icono-chincheta font-medium text-xl">Q</p>
                            <label for="muestrario">Color:</label>
                            <input type="color" value="#5666A2" {{-- {{$objetoEncontrado->objeto->color}} --}} id="muestrario">
                        </div>
                        <div class="flex">
                            <p class="icono-chincheta font-semibold text-xl text-red-600 bg-gray-400">Q</p>
                            <p>Tamaño: {{$objetoEncontrado->objeto->tamanio}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <hr>
        </div>
        <x-destacados :objetos='$objetos'/>
    </div>
@endsection

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>

<script>
    var imagenes = [];
    var indice;
    var num_imagenes;

    $(document).ready(function(event) {
        var imagenes_aux = {!! json_encode($objetoEncontrado->objeto->imagesObjeto) !!}
       
        imagenes_aux.forEach(imagen => {
            imagenes.push('http://findit.test/storage/'+imagen['image']['url']);
        });

        num_imagenes = imagenes.length;
    });
    
    var ultimo_indice = 1;
    function activarPestania(indice) {
        $('#pestania-'+ultimo_indice).removeClass("pestania");
        $('#contenido-pestania-'+ultimo_indice).addClass("hidden");
        $('#pestania-'+indice).addClass("pestania");
        $('#contenido-pestania-'+indice).removeClass("hidden");

        ultimo_indice = indice;
    }

    function activarModal(url, ind) {
        indice = ind;
        $('#img-mod').attr('src', url);
        $('#imagen-modal').show();
    }

    function desplazarImagen(delante){
        if(delante){
            indice = (indice+1)%num_imagenes
        }
        else{
            if(indice == 0){
                indice = num_imagenes-1;
            }
            else{
                indice--;
            }
        }

        $('#img-mod').attr('src', imagenes[indice]);
    }

    $(window).click(function(event) {
        if (event.target.id != "img-mod" && 
            !event.target.classList.contains("imagen-principal") && 
            !event.target.classList.contains("imagen-pequenia") &&
            !event.target.classList.contains("button-desplazar-img") &&
            !event.target.classList.contains("fa-angle-left") &&
            !event.target.classList.contains("fa-angle-right")
        ) {
          $("#imagen-modal").hide();
        } 
    });
</script>