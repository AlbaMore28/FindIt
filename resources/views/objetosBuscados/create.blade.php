@extends('layouts.plantilla')
@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center pb-28">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Registrar Ítem Buscado</h1>
            <div class="flex flex-col w-5/6 px-5 sm:flex-row sm:w-1280 min-h-300 bg-slate-200 rounded-xl shadow-xl sm:px-0">
                <form action="{{route('objetosBuscados.store')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-1 p-10 sm:grid-cols-2 grid-flow-row sm:gap-x-20 sm:p-20 w-full">
                    @csrf
                        <div class="input-field text-left">
                            <input type="text" id="titulo" name="titulo" autocomplete="off" placeholder=" "  value="{{old('titulo')}}">
                            <label for="titulo">Título:</label>
                            @error('titulo')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="input-field text-left">
                            <select  id="tamanio" name="tamanio">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="grande" @if (old('tamanio') == "grande") selected @endif>Grande</option>
                                <option value="mediano" @if (old('tamanio') == "mediano") selected @endif>Mediano</option>
                                <option value="pequenio" @if (old('tamanio') == "pequenio") selected @endif>Pequeño</option>
                            </select>
                            <label list="tamanio">Tamaño:</label>
                            @error('tamanio')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
            
                        <div class="input-field text-left">
                            <select  id="color" name="color">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                @foreach($colores as $color)
                                <option value="{{$color->id}}" @if (old('color') == "{{$color->id}}") selected @endif>{{ucfirst($color->nombre)}}</option>
                                @endforeach
                            </select>
                            <label for="color">Color:</label>
                            @error('color')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="input-field text-left">
                            <select  id="categoria" name="categoria">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}" @if (old('categoria') == "{{$categoria->id}}") selected @endif>{{ucfirst($categoria->nombre)}}</option>
                                @endforeach
                            </select>
                            <label for="categoria">Categoría:</label>
                            @error('categoria')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>

                        <div class="input-field text-left">
                            <input type="text" id="lugar" name="lugar" autocomplete="off" placeholder=" " value="{{old('lugar')}}">
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
                                  <input type="checkbox" id="visible" name="visible" @if(old('visible')) checked @endif value="1">
                                  <span class="lever"></span>
                                  Visible
                                </label>
                              </div>
                        </div>

                        <div class="input-field sm:col-span-2 row-span-3 text-left">
                            <textarea name="descripcion" id="descripcion" style="resize: none" class="h-full border-b border-solid border-blue-gray-dark">{{old('descripcion')}}</textarea>
                            <label for="descripcion">Descripción:</label>
                            @error('descripcion')
                                <small class="text-red-700">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>

                        <div class="flex flex-col items-start mt-16 sm:mt-12">
                            <label for="imagenes_objeto_busc">Imágenes:</label>
                            <div class="flex">
                                <label for="imagenes_objeto_busc" class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light boton-file">
                                    <i class="material-icons text-white icono-file">add</i>
                                </label>
                                <div id="div-files" class="flex">

                                </div>
                            </div>
                            <input type="file" multiple id="imagenes_objeto_busc" name="imagenes_objeto_busc[]">
                            @error('imagenes_objeto_busc')
                                <small class="text-red-700 text-left">
                                    *{{$message}}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="flex flex-col items-center sm:items-end mt-14">
                            <button class="btn waves-effect waves-light boton-form" type="submit" name="action">
                                <span class="texto-boton">Registrar</span> 
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
                    if($( this ).children("input").attr('name') != "categoria"){
                        $( this ).children("label").removeClass("active"); 
                    }
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
            document.querySelector("#imagenes_objeto_busc").addEventListener("change", () => {
                $('#div-files').empty();
                
                // Los archivos seleccionados, pueden ser muchos o uno
                const archivos = document.querySelector("#imagenes_objeto_busc").files;

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