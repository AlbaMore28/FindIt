@extends('layouts.plantilla')

@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div id="mi-modal-eliminar" class="flex flex-col justify-center items-center hidden h-screen w-screen mi-modal-eliminar">
        <div class="h-80 w-400 bg-white rounded-lg div-mi-modal text-2xl font-semibold text-blue-gray-dark shadow-lg text-center">
            <p class="mb-2">¿Está seguro de que desea eliminar este objeto?</p>
            <div class="flex w-full justify-center">
                <div class="btn waves-effect waves-light boton-form mr-2" onclick="cerrarModalEliminar()">
                    <span class="texto-boton">Cancelar</span> 
                    <i class="tiny material-icons">clear</i>
                </div>
                    <a id="btn-delete" class="btn waves-effect waves-light boton-form" href="{{route('objetos.destroy',$objetoBuscado->objeto)}}">
                        <span class="texto-boton">Eliminar</span> 
                        <i class="tiny material-icons">delete</i>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div id="imagen-mi-modal" class="hidden h-screen w-screen mi-modal">
        <img id="img-mod" class="rounded-xl shadow-lg img-mi-modal w-2/5" alt="objeto">
        @if (count($objetoBuscado->objeto->imagesObjeto)>1)
            <div class="button-container w-2/5">
                <div class="button-desplazar-img" onclick="desplazarImagen(false)"><i class="fas fa-angle-left"></i></div>
                <div class="button-desplazar-img" onclick="desplazarImagen(true)"><i class="fas fa-angle-right"></i></div>
            </div>
        @endif
        <div class="mi-modal-close">
            <i class="fas fa-close h-6 w-6"></i>
        </div>
    </div>
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">{{ucfirst($objetoBuscado->objeto->titulo)}}</h1>
        <div class="flex flex-col h-400 w-1280 px-20 justify-between border-4 border-solid border-white/50 rounded-xl">
            <div class="flex flex-row info-objeto justify-around h-7/12">  
                <div class="flex flex-col">
                    @if (count($objetoBuscado->objeto->imagesObjeto))
                        @php
                            $imagen_url = asset('storage/'. $objetoBuscado->objeto->imagesObjeto->first()->image->url); 
                        @endphp
                    @else
                        @php
                            $imagen_url = asset('storage/img/no_img.png'); 
                        @endphp
                    @endif
                    <img class="imagen-principal rounded-xl shadow-lg" src="{{$imagen_url}}" alt="objeto" @if (count($objetoBuscado->objeto->imagesObjeto)>0) onclick="activarModal(this.src, 0)" @endif>
                    
                    @if (count($objetoBuscado->objeto->imagesObjeto)>1)
                        <p class=" text-sm text-left mt-7">Más imágenes</p>
                        <div class="flex">
                            @foreach ($objetoBuscado->objeto->imagesObjeto as $imagen)
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
                
                <div class="flex flex-col h-full w-7/12">
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
                    <div id="contenido-pestania-1" class="flex justify-center text-left items-center w-full h-5/6 cuadro_grande bg-white/50 border-2 border-solid border-gray-400">
                        <p class=" icono-lugar mr-5 font-medium text-4xl text-blue-gray-dark">]</p>
                        <p class="w-96 font-semibold text-blue-gray-dark">{{$objetoBuscado->objeto->descripcion}}</p>
                    </div>

                    {{-- Pestaña lugar --}}
                    <div id="contenido-pestania-2" class="flex px-5 justify-around items-center w-full h-5/6 cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe class="h-60" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                </iframe>
                            </div>
                        </div>
                        <div class="flex">
                            <p class="icono-lugar mr-2 text-red-600 font-bold text-2xl">l</p>
                            <p class="font-semibold text-blue-gray-dark">{{$objetoBuscado->objeto->lugar}}</p>
                        </div>
                    </div>

                    {{-- Pestaña datos --}}
                    <div id="contenido-pestania-3" class="flex flex-col justify-center items-center w-full h-5/6 cuadro_grande bg-white/50 border-2 border-solid border-gray-400 hidden">
                        <div class="flex">
                            <p class="icono-chincheta font-medium text-xl">Q</p>
                            <p class="font-semibold text-blue-gray-dark">Categoría: {{$objetoBuscado->objeto->categoria}}</p>
                        </div>
                        <div class="flex">
                            <p class="icono-chincheta font-medium text-xl">Q</p>
                            <label for="muestrario">Color:</label>
                            <input type="color" value="{{$objetoBuscado->objeto->color}}" id="muestrario">
                        </div>
                        <div class="flex">
                            <p class="icono-chincheta font-semibold text-xl text-red-600 bg-gray-400">Q</p>
                            <p>Tamaño: {{$objetoBuscado->objeto->tamanio}}</p>
                        </div>
                        
                    </div>
                </div>
            </div>

            @auth
                @if (($objetoBuscado->user->id == Auth::user()->id) || (Auth::user()->can('admin.objetos.index')))
                    <div class="flex flex-row justify-end mb-20 mr-7">
                        <a class="btn waves-effect waves-light boton-form mr-2" href="{{route('objetos.edit',$objetoBuscado->id)}}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        var imagenes = [];
        var indice;
        var num_imagenes;

        $(document).ready(function(event) {
            var imagenes_aux = {!! json_encode($objetoBuscado->objeto->imagesObjeto) !!}
        
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