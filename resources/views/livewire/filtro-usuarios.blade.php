<div class="flex flex-row h-fit">
    <div id="my_popup_error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 hidden">  
    </div>
    <div id="my_popup_succes" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 hidden">  
    </div>
    <div id="mi-modal-cargar" class="flex flex-col justify-center items-center h-screen w-screen hidden">
        <div>
            <img class="w-full" src="{{asset('storage/img/spinner.png')}}" alt="">
        </div>
    </div>
    <div class="h-864 grid grid-cols-1 gap-y-10 px-10 py-10 border-4 w-700 border-solid border-white/50 rounded-xl overflow-auto">
            @foreach ($usuarios as $usuario)
                <div class="h-56 w-full flex bg-white/50 rounded-xl shadow-sm items-center">
                    @if ($usuario->imageUser)
                        @php $url_img = asset('storage/'.$usuario->imageUser->image->url) @endphp
                    @else
                        @php $url_img = asset('storage/img/no_img.png') @endphp
                    @endif
                    <div class="img-block h-40 w-56 mx-10 rounded-xl shadow-sm bg-cover bg-center bg-no-repeat flex justify-center @if(!$usuario->bloqueado) hidden @endif" style="background-image: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.5)), url('{{$url_img}}');">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-40 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <div class="img-no-block h-40 w-56 mx-10 rounded-xl shadow-sm bg-cover bg-center bg-no-repeat flex justify-center @if($usuario->bloqueado) hidden @endif" style="background-image: url('{{$url_img}}');">
                    </div>
                    
                    <div class="flex flex-col w-64 items-center text-center text-lg font-semibold text-blue-gray-dark info-user">
                        <p class="name mt-2">{{ucfirst($usuario->nombre_usuario)}}</p>
                        <p>{{ucfirst($usuario->email)}}</p>
                        <div class="rol italic mt-4">  
                            @if($usuario->getRoleNames()->count() == 0)
                                <p class="roles">ColaboradorBeneficiario</p>
                            @else
                                <p class="roles">{{$usuario->getRoleNames()->first()}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col flex-auto items-end justify-between h-full p-6">
                        @can('api.usuarios.cambiarRol')
                            @if (($usuario->getRoleNames()->count() > 0 && $usuario->getRoleNames()->first() != 'Administrador') || $usuario->getRoleNames()->count() == 0)
                                <form id="form-rol" action="">
                                    @if ($usuario->getRoleNames()->count() == 0)
                                        @php
                                            $claseRolPrevia = "ColaboradorBeneficiario";
                                        @endphp 
                                    @else
                                        @php
                                            $claseRolPrevia = $usuario->getRoleNames()->first();
                                        @endphp 
                                    @endif
                                    <select id="{{$usuario->id}}" class="{{$claseRolPrevia}}" name="user_role">
                                        @foreach($roles as $rol)
                                            @if($rol->name == $usuario->getRoleNames()->first()) 
                                                @php
                                                    $selected = "selected";
                                                @endphp  
                                            @elseif($usuario->getRoleNames()->first() == "" && $rol->name == "ColaboradorBeneficiario") 
                                                @php
                                                    $selected = "selected";
                                                @endphp
                                            @else
                                                @php
                                                    $selected = "";
                                                @endphp
                                            @endif
                                            <option value="{{$rol->name}}" {{$selected}}>{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        @endcan
                        <p></p>
                        <div class="flex">
                            @can('api.usuarios.cambiarEstadoBloqueado')
                                @if ((Auth::user()->id != $usuario->id) && $usuario->getRoleNames()->first() != 'Administrador')
                                    <button id="{{$usuario->id}}" class="boton-bloquear h-10 w-10 rounded-full waves-effect waves-light shadow-lg text-white mr-2 @if(!$usuario->bloqueado) bg-blue-gray-dark @else bg-red-600 @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 icono-detalles" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                    </button>
                                @endif
                            @endcan
                            
                            @can('admin.usuarios.destroy')
                                @if (Auth::user()->id != $usuario->id && $usuario->getRoleNames()->first() != 'Administrador')
                                    <a href="{{route('admin.usuarios.destroy',$usuario)}}">
                                        <div class="h-10 w-10 rounded-full bg-blue-gray-dark waves-effect waves-light shadow-lg text-white" id="boton-color">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 icono-detalles" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </a>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
                    
            @endforeach
       
    </div>

    <div class="h-864 w-80 ml-10 backdrop-opacity-10 backdrop-invert bg-white/50 rounded-xl">
        <h2 class="titulo_filtros mt-8 mb-2 text-blue-gray-dark">Filtros</h2>

        <div class="flex justify-center">
            <hr class="bg-white/75 h-0.5">
        </div>
        
        <div class="grid grid-cols-1 gap-4 text-left mx-4">
            <label class="text-lg col-span-1 font-semibold" for="nombre">Nombre:</label>
            <input class="col-span-1" type="text" wire:model="nombre" />

            <label class="text-lg col-span-1 font-semibold" for="nombreUsuario">Nombre de Usuario:</label>
            <input class="col-span-1" type="text" wire:model="nombreUsuario" />

            <label class="text-lg col-span-1 font-semibold" for="email">Email:</label>
            <input class="col-span-1" type="text" wire:model="email" />

            <label class="text-lg col-span-1 font-semibold">Roles:</label>
            @foreach ($roles as $rol)
            <label>
                <input type="checkbox" wire:model="rol" value="{{ $rol->name }}">
                {{ ucfirst($rol->name) }}
            </label>
            @endforeach
        </div>
    </div>
</div>

@section('js')
    <script>
        $notifierRol = null;
        $notifierBloqueado = null;
        var previousRol = null;

        $(document).ready(function (){
            $("select").change(function (event) {  
                previousRol  = $(this).attr('class');  
                $notifierRol = $(this);
                $('#mi-modal-cargar').removeClass('hidden');
                $.ajax({
                    method: "POST",
                    url: "{{route('api.usuarios.cambiarRol')}}",
                    data: JSON.stringify({ id: $notifierRol.attr('id'), rol: $notifierRol.val() }),
                    contentType: "application/json", 
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(function(data){
                    $notifierRol.parent().parent().parent().find('.roles').text($notifierRol.val());
                    $('#my_popup_succes').text(data);
                    $('#my_popup_succes').removeClass('hidden');
                    setTimeout(function(){
                        $('#my_popup_succes').addClass('hidden');
                    }, 10000);
                }).fail(function(err) {
                    $notifierRol.val(previousRol);
                    $('#my_popup_error').text(JSON.parse(err.responseText));
                    $('#my_popup_error').removeClass('hidden');
                    setTimeout(function(){
                        $('#my_popup_error').addClass('hidden');
                    }, 10000);
                }).always(function() {
                    $('#mi-modal-cargar').addClass('hidden');
                })
                
            });

            $(".boton-bloquear").click(function (event) {
                $notifierBloqueado = $(this);
                $('#mi-modal-cargar').removeClass('hidden');
                $.ajax({
                    method: "POST",
                    url: "{{route('api.usuarios.cambiarEstadoBloqueado')}}",
                    data: JSON.stringify({ id: $notifierBloqueado.attr('id') }),
                    contentType: "application/json", 
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true
                    },
                }).done(function(data){
                    if($notifierBloqueado.hasClass('bg-blue-gray-dark')){
                        $notifierBloqueado.removeClass('bg-blue-gray-dark');
                        $notifierBloqueado.addClass("bg-red-600");
                        $notifierBloqueado.parent().parent().parent().find('.img-block').removeClass('hidden');
                        $notifierBloqueado.parent().parent().parent().find('.img-no-block').addClass('hidden');
                        
                        $('#my_popup_succes').text('Usuario bloqueado'+data);
                        $('#my_popup_succes').removeClass('hidden');
                        setTimeout(function(){
                            $('#my_popup_succes').addClass('hidden');
                        }, 10000);
                    }
                    else{
                        $notifierBloqueado.removeClass("bg-red-600");
                        $notifierBloqueado.addClass('bg-blue-gray-dark');
                        $notifierBloqueado.parent().parent().parent().find('.img-block').addClass('hidden');
                        $notifierBloqueado.parent().parent().parent().find('.img-no-block').removeClass('hidden');

                        $('#my_popup_succes').text('Usuario desbloqueado'+data);
                        $('#my_popup_succes').removeClass('hidden');
                        setTimeout(function(){
                            $('#my_popup_succes').addClass('hidden');
                        }, 10000);
                    }
                }).fail(function(err) {
                    $('#my_popup_error').text(JSON.parse(err.responseText));
                    $('#my_popup_error').removeClass('hidden');
                    setTimeout(function(){
                        $('#my_popup_error').addClass('hidden');
                    }, 10000);
                }).always(function() {
                    $('#mi-modal-cargar').addClass('hidden');
                })
            });
        });
    </script>
@endsection