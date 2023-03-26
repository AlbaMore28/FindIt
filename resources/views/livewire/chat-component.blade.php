<div class="h-screen w-screen bg-blue-400 flex">

    <!-- Barra lateral -->
    <div class="h-full w-[calc(30%)] bg-blue-600">

        <!-- Info usuario -->
        <div class="bg-gray-100 h-16 flex items-center px-4 border-r border-gray-300">
            @if (Auth::user()->imageUser)
                <img src="{{asset('storage/'.Auth::user()->imageUser->image->url)}}" class="h-12 w-12 mb-1 rounded-full border-2 border-solid border-white object-cover object-center" alt="imagen user">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif

            <span class="ml-2"> {{ Auth::user()->nombre }} </span>
        </div>

        <!-- Barra búsqueda -->
        <div class="bg-white h-12 flex items-center px-4">
            <input autocomplete="off" type="text" wire:model="busqueda" name="busqueda" id="busqueda" class="w-full px-2 py-2 rounded-lg" placeholder="Buscar un chat...">
        </div>

        <!-- Listado chats -->
        <div class="bg-gray-100 h-[calc(100vh-7rem)] overflow-auto border-t border-gray-200 pt-2"> 
            @foreach ($this->chats as $chatItem)
                <div 
                    class=" hover:bg-gray-200 cursor-pointer flex items-center justify-between px-3
                            {{ $this->chat && $this->chat->id == $chatItem->id ? 'bg-gray-200' : 'bg-white'}}"
                    wire:key="chats-{{$chatItem->id}}"
                    wire:click="openChat({{$chatItem->id}})"
                >
                    @if ($chatItem->imageUser)
                        <img src="{{asset('storage/'. $chatItem->imageUser->image->url)}}" class="h-12 w-12 mb-1 rounded-full border-2 border-solid border-white object-cover object-center" alt="imagen user">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif

                    <span class="ml-2 w-[calc(100%-3rem)] py-4 border-b border-gray-200"> 
                        <div class="flex justify-between items-center">
                            <div class="w-[calc(70%)]">
                                <p>
                                    {{ $chatItem->nombre }} ({{ $chatItem->email }}) 
                                </p>
                                <p class="text-sm text-gray-600 mt-1 truncate">
                                    @if($chatItem->mensajes->count() > 0)
                                        {{ $chatItem->mensajes->last()->cuerpo }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex flex-col items-end self-start">
                                <p class="text-xs text-gray-600">
                                    @if($chatItem->mensajes->count() > 0)
                                        {{ $chatItem->lastMensajeAt->format('h:i A') }}
                                    @endif
                                </p>
                                @if($chatItem->unreadMessages > 0)
                                <div class="flex justify-center items-center rounded-full bg-green-400 w-fit h-fit px-3 pt-1 mt-2 text-sm text-gray-600">
                                    {{$chatItem->unreadMessages}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cuadro mensajes -->
    @if(!$this->chat)
        <div class="h-full w-[calc(70%)] bg-gradient-to-t from-blush via-steel to-blue-gray flex items-center justify-center">
            <div class="w-1/4">
                <img class="w-full h-full" src="{{ asset('storage/img/brujula.png') }}">
            </div>
        </div>
    @else
        <div class="h-full w-[calc(70%)]">
            <!-- Info Usuario Chat -->
            <div class="bg-gray-100 h-16 w-full flex items-center px-4">
                @if ($this->chat->imageUser)
                    <img src="{{asset('storage/'. $this->chat->imageUser->image->url)}}" class="h-12 w-12 mb-1 rounded-full border-2 border-solid border-white object-cover object-center" alt="imagen user">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif

                <span class="ml-2 flex-1 py-4 border-b border-gray-200"> 
                    <p>
                        {{ $this->chat->nombre }}
                    </p>
                    <p class="text-xs">
                        {{ $this->chat->email }}
                    </p>
                </span>
            </div>

            <!-- Mensajes Chat -->
            <div class="bg-gradient-to-t from-blush via-steel to-blue-gray h-[calc(100%-8rem)] w-full overflow-auto">
                @foreach ($this->mensajes as $mensajeItem)
                    <div 
                        class="flex {{$mensajeItem->user->id == Auth::user()->id ? 'justify-end' : ''}}"
                        wire:key="{{$mensajeItem->id}}"
                    >
                        <div 
                            class="rounded px-3 py-2 w-fit m-3
                            {{$mensajeItem->user->id == Auth::user()->id ? 'bg-green-200 text-right' : 'bg-white text-left'}}" 
                        >
                            <p>
                                {{$mensajeItem->cuerpo}}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center justify-end">
                                {{$mensajeItem->created_at}}

                                @if($mensajeItem->user->id == Auth::user()->id && $mensajeItem->leido)
                                <span class="-mr-1">
                                    <i class="tiny material-icons text-blue-400">check</i>
                                    <i class="tiny material-icons -ml-5 text-blue-400">check</i>
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>

                @endforeach
                <span id="scrollChat"></span>
            </div>

            <form class="bg-gray-100 h-16 flex items-center px-4" wire:submit.prevent="enviarMensaje()">
                <input autocomplete="off" wire:model="mensaje" type="text" name="mensaje" id="mensaje" class="flex-1 px-2 py-2 rounded-lg" placeholder="Escriba un mensaje...">
                <button class="flex-shrink-0 text-2xl text-gray-700 h-fit ml-1">
                    <i class="tiny material-icons">send</i>
                </button>
            </form>
        </div>
    @endif

    @push('js')
        <script>
            $(document).ready(function(){
                let el = document.getElementById('scrollChat');
                if(el){
                    el.scrollIntoView(true);
                } 
            });
            Livewire.on('scrollChat', function(){
                document.getElementById('scrollChat').scrollIntoView(true);
            });
        </script>
    @endpush
    

</div>