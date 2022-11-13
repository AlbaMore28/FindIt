@props(['link','link2','accion','accion2','rutaCrear','rutaListar'])

<div class="card w-64 h-128 my-20 mx-auto sm:mx-16">
    <div class="face front flex flex-col justify-center bg-gray-500 rounded-lg">
        <div class="bg-gray-700 h-40 w-40 flex justify-center mb-5 mx-12 rounded-lg sombra-box-front">
            <img class="p-2" alt="" src="{{$link}}" >
        </div>
        <div class="flex justify-center letra">
            <p class="text-white text-center p-10">Posiciónate<br>aquí si {{$accion}}<br>un objeto </p>
        </div>
    </div>
    
    <div class="face back flex justify-col text-center text-white bg-gray-500 rounded-lg">
        <div class="bg-gray-700 h-40 w-40 flex justify-cente mx-12 rounded-lg margin-box-back">
            <img class="p-2 oscurecer-img" alt="" src="{{$link2}}" >
        </div>
        <div class="flex justify-center">
            <a href="{{$rutaCrear}}" class="rainbow-button" alt="Registrar Objeto {{$accion2}}"></a>
        </div>
        <div class="flex justify-center mb-16">
            <a href="{{$rutaListar}}" class="rainbow-button" alt="Lista de Objetos {{$accion2}}s"></a>
        </div>
    </div>
</div>