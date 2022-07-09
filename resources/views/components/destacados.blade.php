
<h2 class="text-center text-2xl mb-4 text-white titulo_destacados">Últimos Registros</h2>  
<div class="flex flex-row justify-center">
    <div class=" contenedor-destacados"> 
        <div class="items-destacados text-white">
            @foreach ($objetos as $objeto)
                    <div class="item-destacado bg-gradient-to-l from-blue-gray-dark to-blue-gray">
                        <p class="etiqueta-tipo 
                            @if ($objeto->tipo == 'encontrado') bg-gray-700 text-white 
                            @else bg-white text-gray-700 
                            @endif italic"
                        >
                            @if ($objeto->tipo == 'encontrado')Encontrado @else Buscando @endif 
                        </p>
                        <p class="name">{{$objeto->titulo}}</p>
                        <img src="{{ asset('storage/'. $objeto->imagesObjeto->first()->image->url)}}" alt="objeto">
                        {{-- <img src="{{ asset('storage/img/bolso.jpg')}}" alt="objeto"> --}}
                        <p class="quote">{{$objeto->lugar}}</p>
                    </div> 
            @endforeach
        </div>
    </div>
</div>
