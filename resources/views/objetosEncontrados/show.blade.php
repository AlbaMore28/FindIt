@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
<div id="mi-modal-eliminar" class="flex flex-col justify-center items-center h-screen w-screen mi-modal-eliminar hidden">
    <div class="w-5/6 sm:top-60 sm:left-96 div-mi-modal-movil text-center sm:pb-0 sm:pt-28 sm:px-0 sm:h-80 sm:w-400 bg-white rounded-lg text-2xl font-semibold text-blue-gray-dark shadow-lg">
        <p class="mb-2">¿Está seguro de que desea eliminar este objeto?</p>
        <div class="flex w-full justify-center">
            <div class="btn waves-effect waves-light boton-form mr-2" onclick="cerrarModalEliminar()">
                <span class="texto-boton">Cancelar</span> 
                <i class="tiny material-icons">clear</i>
            </div>
           
            <a id="btn-delete" class="btn waves-effect waves-light boton-form" href="{{route('usuarios.destroy')}}">
                <span class="texto-boton">Eliminar</span> 
                <i class="tiny material-icons">delete</i>
            </a>
            
        </div>
    </div>
</div>
    <div id="imagen-mi-modal" class="hidden h-screen w-screen mi-modal sm:px-0">
        <img id="img-mod" class="rounded-xl shadow-lg img-mi-modal w-4/5 sm:w-2/5" alt="objeto">
        @if (count($objetoEncontrado->objeto->imagesObjeto)>1)
            <div class="button-container w-4/5 sm:w-2/5">
                <div class="button-desplazar-img" onclick="desplazarImagen(false)"><i class="fas fa-angle-left"></i></div>
                <div class="button-desplazar-img" onclick="desplazarImagen(true)"><i class="fas fa-angle-right"></i></div>
            </div>
        @endif
        <div class="mi-modal-close sm:flex hidden">
            <i class="fas fa-close h-6 w-6"></i>
        </div>
    </div>
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">{{ucfirst($objetoEncontrado->objeto->titulo)}}</h1>
        <div class="flex flex-col sm:h-400 sm:w-1280 sm:px-20 px-5 justify-between border-4 border-solid border-white/50 rounded-xl">
            <div class="flex flex-col sm:flex-row info-objeto justify-around sm:h-399">  
                <div class="flex flex-col">
                    @if (count($objetoEncontrado->objeto->imagesObjeto))
                    @php
                        $imagen_url = asset('storage/'. $objetoEncontrado->objeto->imagesObjeto->first()->image->url); 
                    @endphp
                        
                    @else
                        @php
                            $imagen_url = asset('storage/img/no_img.png'); 
                        @endphp
                    @endif
                    <img class="imagen-principal rounded-xl shadow-lg" src="{{$imagen_url}}" alt="objeto" @if (count($objetoEncontrado->objeto->imagesObjeto)>0) onclick="activarModal(this.src, 0)" @endif>
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
                
                <div class="flex flex-col h-399 sm:w-7/12 sm:mt-0 mt-10 w-full">
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
                    <div id="contenido-pestania-1" class="flex px-4 sm:px-0 justify-center text-left items-center w-full h-5/6 cuadro_grande bg-white/50 border-2 border-solid border-gray-400">
                        <p class=" icono-lugar mr-5 font-medium text-4xl text-blue-gray-dark">]</p>
                        <p class="w-full sm:w-96 font-semibold text-blue-gray-dark">{{$objetoEncontrado->objeto->descripcion}}</p>
                    </div>

                    {{-- Pestaña lugar --}}
                    <div id="contenido-pestania-2" class="flex flex-col sm:flex-row px-5 justify-around items-center w-full h-5/6 cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe class="h-60 w-full" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                </iframe>
                            </div>
                        </div>
                        <div class="flex">
                            <p class="icono-lugar mr-2 text-red-600 font-bold text-2xl">l</p>
                            <p class="font-semibold text-blue-gray-dark">{{$objetoEncontrado->objeto->lugar}}</p>
                        </div>
                    </div>

                    {{-- Pestaña datos --}}
                    <div id="contenido-pestania-3" class="flex flex-col justify-center items-center h-5/6 w-full cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                        <div class="sm:w-fit py-4 border-y-4 border-double border-blue-gray-dark">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                                </svg>
                                <p class="font-semibold text-xl text-blue-gray-dark">Categoría:</p> 
                                <p class="text-xl text-blue-gray-dark ml-2">{{$objetoEncontrado->objeto->categoria}}</p>
                            </div>
                            <div class="flex muestrario">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-10 mr-2">
                                    <path class="h-6" stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                                </svg>
                                <label for="muestrario" class="flex items-center font-semibold text-xl text-blue-gray-dark">Color:</label>
                                <input class="ml-2" type="color" value="{{$objetoEncontrado->objeto->color}}" id="muestrario" disabled>
                            </div>
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                </svg>
                                @if ($objetoEncontrado->objeto->tamanio == 'pequenio')
                                    @php
                                        $tamanio = 'pequeño';
                                    @endphp
                                @else
                                    @php
                                        $tamanio = $objetoEncontrado->objeto->tamanio;
                                    @endphp
                                @endif
                                <p class="font-semibold text-xl text-blue-gray-dark">Tamaño:</p>
                                <p class="text-xl text-blue-gray-dark ml-2">{{$tamanio}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @auth
                @if (($objetoEncontrado->user->id == Auth::user()->id) || (Auth::user()->can('admin.objetos.index')))
                    <div class="flex flex-col sm:flex-row sm:justify-end mb-20 sm:mr-7 mr-0">
                        <a class="btn waves-effect waves-light boton-form sm:mr-2 sm:mt-0 sm:mb-0 mt-2 mb-2 mr-0" href="{{route('objetos.edit',$objetoEncontrado->id)}}">
                            <span class="texto-boton">Editar</span> 
                            <i class="tiny material-icons">create</i>
                        </a>
                        <button class="btn waves-effect waves-light boton-form" onclick="activarModalEliminar()">
                            <span class="texto-boton">Eliminar</span> 
                            <i class="tiny material-icons">delete</i>
                        </button>
                    </div>
                @endif
            @endauth

        </div>
        <div class="flex justify-center">
            <hr>
        </div>
        <x-destacados :objetos='$objetos'/>
    </div>
@endsection

@section('js')
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
            $('#imagen-mi-modal').show();
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
            $("#imagen-mi-modal").hide();
            } 
        });

        function activarModalEliminar() {
                $('#mi-modal-eliminar').show();
            }

        function cerrarModalEliminar() {
            $("#mi-modal-eliminar").hide();
        }
    </script>
@endsection