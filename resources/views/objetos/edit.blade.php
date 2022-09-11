@extends('layouts.plantilla')
@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Editar {{$objeto->titulo}}</h1>
            <div class="flex flex-col w-5/6 px-5 sm:flex-row sm:w-1280 min-h-300 bg-slate-200 rounded-xl shadow-xl sm:px-0">
                <form action="{{route('objetos.update',$objeto->id)}}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 p-10 sm:grid-cols-2 grid-flow-row sm:gap-x-20 sm:p-20 w-full">
                    @csrf
                        <div class="input-field h-11 text-left">
                            <input type="text" id="titulo" name="titulo" autocomplete="off" placeholder=" " value="{{old('titulo', $objeto->titulo)}}">
                            <label for="titulo">Título:</label>
                            @error('titulo')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="input-field h-11 text-left">
                            <select  id="tamanio" name="tamanio">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="grande" @if (old('tamanio', $objeto->tamanio) == "grande") selected @endif>Grande</option>
                                <option value="mediano" @if (old('tamanio', $objeto->tamanio) == "mediano") selected @endif>Mediano</option>
                                <option value="pequenio" @if (old('tamanio', $objeto->tamanio) == "pequenio") selected @endif>Pequeño</option>
                            </select>
                            <label list="tamanio">Tamaño:</label>
                            @error('tamanio')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
            
                        <div class="flex flex-col items-start pb-3 sm:pb-0">
                            <label for="color">Color:</label>
                            <input type="color" id="color" name="color" class="w-full" value="{{old('color', $objeto->color)}}">
                            @error('color')
                                <small class="text-red-700 text-left">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="input-field text-left">
                            <select  id="categoria" name="categoria">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="animal" @if (old('categoria', $objeto->categoria) == "animal") selected @endif>Animal</option>
                                <option value="cartera" @if (old('categoria', $objeto->categoria) == "cartera") selected @endif>Cartera</option>
                                <option value="ropa" @if (old('categoria', $objeto->categoria) == "ropa") selected @endif>Ropa</option>
                                <option value="llaves" @if (old('categoria', $objeto->categoria) == "llaves") selected @endif>Llaves</option>
                                <option value="telefono" @if (old('categoria', $objeto->categoria) == "telefono") selected @endif>Teléfono</option>
                            </select>
                            <label for="categoria">Categoría:</label>
                            @error('categoria')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>

                        <div class="input-field text-left">
                            <input type="text" id="lugar" name="lugar" autocomplete="off" placeholder=" " value="{{old('lugar', $objeto->lugar)}}">
                            <label for="lugar">Lugar:</label>
                            @error('lugar')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="flex flex-col items-start justify-center">
                            <div class="switch">
                                <label>
                                  No Visible
                                  <input type="checkbox" id="visible" name="visible" @if(old('visible', $objeto->visibilidad)) checked @endif>
                                  <span class="lever"></span>
                                  Visible
                                </label>
                              </div>
                        </div>

                        <div class="input-field sm:col-span-2 row-span-3 text-left">
                            <textarea name="descripcion" id="descripcion" style="resize: none" class="h-full border-b border-solid border-blue-gray-dark">{{old('descripcion', $objeto->descripcion)}}</textarea>
                            <label for="descripcion">Descripción:</label>
                            @error('descripcion')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>

                        <div class="flex flex-col items-start mt-16 sm:mt-12">
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
                            @error('imagenes')
                                <small class="text-red-700 text-left">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="flex flex-col items-center sm:items-end mt-14">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
        $(document).ready(function(event) {
            $( ".input-field" ).each(function(){
                if($( this ).children("input").val() == "" || $( this ).children("textarea").val() == ""){
                    $( this ).children("label").removeClass("active"); 
                }
            });
        
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