@extends('layouts.plantilla')
@section('css')
    <link href="{{ asset('css/materializeforms.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> --}}
@endsection

@section('contenido')
    <div class="flex flex-col text-center bg-gradient-to-t from-blush via-steel to-blue-gray min-h-inherit items-center">
        <h1 id="lista" class="text-white mt-20 mb-11 titulo_seccion">Registrar Ítem</h1>
            <div class=" w-1280 min-h-300 bg-slate-200 flex rounded-xl shadow-xl">
                <form action="{{route('objetosBuscados.store')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 grid-flow-row gap-x-20 p-20 w-full">
                    @csrf
                        <div class="input-field h-11">
                            <input type="text" id="titulo" name="titulo" autocomplete="off" placeholder=" ">
                            <label for="titulo">Título:</label>
                        </div>
                        <div class="input-field  h-11">
                            <select  id="tamanio" name="tamanio">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="grande">Grande</option>
                                <option value="mediano">Mediano</option>
                                <option value="pequenio">Pequeño</option>
                            </select>
                            <label list="tamanio">Tamaño:</label>
                        </div>
            
                        <div class="flex flex-col items-start">
                            <label for="color">Color:</label>
                            <input type="color" id="color" name="color" class="w-full" value="#637190">
                        </div>
                        
                        <div class="input-field">
                            <select  id="categoria" name="categoria">
                                <option value="" disabled selected>Selecciona tu opción</option>
                                <option value="animal">Animal</option>
                                <option value="cartera">Cartera</option>
                                <option value="ropa">Ropa</option>
                                <option value="llaves">Llaves</option>
                                <option value="telefono">Teléfono</option>
                            </select>
                            <label for="categoria">Categoría:</label>
                        </div>

                        <div class="input-field">
                            <input type="text" id="lugar" name="lugar" autocomplete="off" placeholder=" ">
                            <label for="lugar">Lugar:</label>
                        </div>
                        
                        <div class="flex flex-col items-start justify-center">
                            <div class="switch">
                                <label>
                                  No Visible
                                  <input type="checkbox" id="visible" name="visible" value="1">
                                  <span class="lever"></span>
                                  Visible
                                </label>
                              </div>
                        </div>

                        <div class="input-field col-span-2 row-span-3">
                            <textarea name="descripcion" id="descripcion" style="resize: none" class="h-full border-b border-solid border-blue-gray-dark"></textarea>
                            <label for="descripcion">Descripción:</label>
                        </div>

                        <div class="flex flex-col items-start mt-12">
                            <label for="imagenes_objeto_busc">Imágenes:</label>
                            <label for="imagenes_objeto_busc" class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light boton-file">
                                <i class="material-icons text-white icono-file">add</i>
                            </label>
                            <input type="file" multiple id="imagenes_objeto_busc" name="imagenes_objeto_busc[]">
                        </div>
                        
                        <div class="flex flex-col items-end mt-14">
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
            $( "label" ).removeClass("active");
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
    </script>
@endsection