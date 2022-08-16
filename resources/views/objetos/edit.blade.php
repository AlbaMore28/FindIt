@extends('layouts.plantilla')
@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Editar {{$objeto->titulo}}</h1>
            <div class=" w-1280 min-h-300 bg-slate-200 flex rounded-xl shadow-xl">
                <form action="{{route('objetos.update',$objeto->id)}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 grid-flow-row gap-x-20 p-20 w-full">
                    @csrf
                        <div class="input-field h-11">
                            <input type="text" id="titulo" name="titulo" autocomplete="off" placeholder=" " value="{{$objeto->titulo}}">
                            <label for="titulo">Título:</label>
                        </div>
                        <div class="input-field  h-11">
                            <select  id="tamanio" name="tamanio">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="grande" @if ($objeto->tamanio == "grande") selected @endif>Grande</option>
                                <option value="mediano" @if ($objeto->tamanio == "mediano") selected @endif>Mediano</option>
                                <option value="pequenio" @if ($objeto->tamanio == "pequenio") selected @endif>Pequeño</option>
                            </select>
                            <label list="tamanio">Tamaño:</label>
                        </div>
            
                        <div class="flex flex-col items-start">
                            <label for="color">Color:</label>
                            <input type="color" id="color" name="color" class="w-full" value="{{$objeto->color}}">
                        </div>
                        
                        <div class="input-field">
                            <select  id="categoria" name="categoria">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="animal" @if ($objeto->categoria == "animal") selected @endif>Animal</option>
                                <option value="cartera" @if ($objeto->categoria == "cartera") selected @endif>Cartera</option>
                                <option value="ropa" @if ($objeto->categoria == "ropa") selected @endif>Ropa</option>
                                <option value="llaves" @if ($objeto->categoria == "llaves") selected @endif>Llaves</option>
                                <option value="telefono" @if ($objeto->categoria == "telefono") selected @endif>Teléfono</option>
                            </select>
                            <label for="categoria">Categoría:</label>
                        </div>

                        <div class="input-field">
                            <input type="text" id="lugar" name="lugar" autocomplete="off" placeholder=" " value="{{$objeto->lugar}}">
                            <label for="lugar">Lugar:</label>
                        </div>
                        
                        <div class="flex flex-col items-start justify-center">
                            <div class="switch">
                                <label>
                                  No Visible
                                  <input type="checkbox" id="visible" name="visible" @if($objeto->visibilidad) checked @endif>
                                  <span class="lever"></span>
                                  Visible
                                </label>
                              </div>
                        </div>

                        <div class="input-field col-span-2 row-span-3">
                            <textarea name="descripcion" id="descripcion" style="resize: none" class="h-full border-b border-solid border-blue-gray-dark">{{$objeto->descripcion}}</textarea>
                            <label for="descripcion">Descripción:</label>
                        </div>

                        <div class="flex flex-col items-start mt-12">
                            <label for="imagenes">Imágenes:</label>
                            <div class="flex">
                                <label for="imagenes" class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light boton-file">
                                    <i class="material-icons text-white icono-file">add</i>
                                </label>
                                <div id="div-files" class="flex">
                                    @foreach ($objeto->imagesObjeto as $imagenObjeto)
                                        <img id="imagenPrevisualizacion" class="h-8 shadow-lg rounded-sm ml-2 mt-2" src="{{asset('storage/'.$imagenObjeto->image->url)}}">  
                                    @endforeach
                                </div>
                            </div>
                            <input type="file" multiple id="imagenes" name="imagenes[]">
                        </div>
                        
                        <div class="flex flex-col items-end mt-14">
                            <button class="btn waves-effect waves-light boton-form" type="submit" name="action">
                                <span class="texto-boton">Actualizar</span> 
                                <i class="tiny material-icons">send</i>
                            </button>
                        </div>
                </form>
            </div>
    
        <div class="flex justify-center">
            <hr>
        </div>
        <x-destacados :objetos='$objetos'/>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
        $(document).ready(function(event) {
        
            $( ".input-field" ).focus(
                function() {
                    $( this ).children("label").addClass("active");   
                }
            );
            $( ".input-field" ).focusout(
                function() {
                    if($( this ).children("input").val() == ""){
                        $( this ).children("label").removeClass("active"); 
                    }  
                }
            );

            // Escuchar cuando cambie
            document.querySelector("#imagenes").addEventListener("change", () => {
                $('#div-files').empty();
                
                // Los archivos seleccionados, pueden ser muchos o uno
                const archivos = document.querySelector("#imagenes").files;

                // Ahora tomamos los archivos que vamos a previsualizar
                if (archivos && archivos.length){
                    for (let i=0; i < archivos.length; i++) {
                        // añadimos la imagen
                        $('#div-files').append($('<img>',{id:'imagenPrevisualizacion'+i, class:'h-8 shadow-lg rounded-sm ml-2 mt-2'}));
                        // Los convertimos a un objeto de tipo objectURL
                        $objectURL = URL.createObjectURL(archivos[i]);
                        
                        $("#imagenPrevisualizacion"+i).attr("src", $objectURL);
                    }   
                }   
            });
        });
    </script>
@endsection