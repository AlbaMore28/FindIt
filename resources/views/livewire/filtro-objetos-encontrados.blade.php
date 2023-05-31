<div class="flex flex-col sm:flex-row justify-center h-fit">
    <div class="flex flex-col">
        <div id="boton-filtrar" class="flex sm:hidden justify-end pr-2 text-white mb-2">
            <button class=" btn waves-effect waves-light boton-form p-2 rounded-lg" onclick="abrirFiltros()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                </svg> 
                FILTRAR
            </button>
        </div>
        <div id="boton-cerrar-filtros" class="hidden flex sm:hidden justify-end pr-2 text-white mb-2">
            <button class=" btn waves-effect waves-light boton-form p-2 rounded-lg" onclick="cerrarFiltros()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>                   
                CERRAR FILTRO
            </button>
        </div>
        <div id="grid-objetos">
            <div class="flex flex-col">
                @if (count($this->objetosEncontrados) > 0)
                    <div class="altura-cuadro-objetos grid grid-cols-1 sm:grid-cols-3 grid-rows-3 gap-y-10 gap-x-10 px-10 py-10 border-4 sm:w-700 border-solid border-white/50 rounded-xl">
                        @foreach ($this->objetosEncontrados as $objetoEncontrado)
                            <a href="{{route('objetosEncontrados.show', $objetoEncontrado)}}" wire:key="objeto-{{$objetoEncontrado->id}}">
                                <div class="flex flex-col h-fit items-center text-center text-lg font-semibold text-blue-gray-dark bg-white/50 rounded-xl shadow-sm">  
                                    @if (count($objetoEncontrado->imagesObjeto))
                                        @php
                                            $imagen_url = asset('storage/'. $objetoEncontrado->imagesObjeto->first()->image->url); 
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
                @else
                <div class="altura-cuadro-objetos grid grid-cols-1 px-10 py-10 border-4 sm:w-700 border-solid border-white/50 rounded-xl text-white">
                    <p>No se han encontrado objetos encontrados con esas características</p>
                </div>   
                @endif
            </div>
            <div class="mt-4">
                {{$this->objetosEncontrados->links('components.paginationLivewire')}}
            </div>
        </div>
    </div>
    <div id="filtros" class="hidden pb-5 w-full sm:flex sm:flex-col sm:h-864 sm:w-80 sm:ml-10 backdrop-opacity-10 backdrop-invert bg-white/50 rounded-xl">
        <h2 class="titulo_filtros mt-8 mb-2 text-blue-gray-dark">Filtros</h2>

        <div class="flex justify-center">
            <hr class="bg-white/75 h-0.5">
        </div>
        
        <div class="grid grid-cols-3 gap-4 text-left mx-4">
            <label class="text-lg col-span-3 font-semibold" for="titulo">Título:</label>
            <input class="col-span-3" type="text" wire:model="titulo" wire:keydown="filtrado" />

            <label class="text-lg col-span-3 font-semibold" for="lugar">Lugar:</label>
            <input class="col-span-3" type="text" wire:model="lugar" wire:keydown="filtrado" />

            <label class="text-lg col-span-3 font-semibold">Tamaño:</label>
            <label>
                <input class="col-span-1" type="checkbox" wire:model="tamanio" value="grande">
                Grande
            </label>
            <label>
                <input class="col-span-1" type="checkbox" wire:model="tamanio" value="mediano">
                Mediano
            </label>
            <label>
                <input class="col-span-1" type="checkbox" wire:model="tamanio" value="pequenio">
                Pequeño
            </label>

            <label class="text-lg col-span-3 font-semibold">Categoría:</label>
            @foreach ($categorias as $categoria)
            <label wire:key="categoria-{{$categoria->id}}">
                <input type="checkbox" wire:model="categoria" value="{{ $categoria->nombre }}">
                {{ ucfirst($categoria->nombre) }}
            </label>
            @endforeach

            <label class="text-lg col-span-3 font-semibold">Color:</label>
            @foreach ($colores as $color)
            <label wire:key="color-{{$color->id}}">
                <input type="checkbox" wire:model="color" value="{{ $color->hex_code }}">
                {{ ucfirst($color->nombre) }}
            </label>
            @endforeach  

            <label class="text-lg col-span-3 font-semibold">Fecha:</label>
            <label>
                <input type="date" wire:model="fecha">
            </label>
        </div>
    </div>
</div>

@section('js')
    <script>
        function abrirFiltros() {
            $('#grid-objetos').addClass("hidden");
            $('#filtros').removeClass("hidden");
            $('#boton-cerrar-filtros').removeClass("hidden");
            $('#boton-filtrar').addClass("hidden");
        }

        function cerrarFiltros() {
            $('#grid-objetos').removeClass("hidden");
            $('#filtros').addClass("hidden");
            $('#boton-cerrar-filtros').addClass("hidden");
            $('#boton-filtrar').removeClass("hidden");
            
        }
    </script>
@endsection