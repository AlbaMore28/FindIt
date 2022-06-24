@props(['link'])
<div class="card w-64 h-128 my-20 mx-16 ">
    <div class="face front flex flex-col justify-center bg-gray-500 rounded-lg">
        <div class="bg-gray-700 h-40 w-40 flex justify-center mb-5 mx-12 rounded-lg">
            <img class="p-2" alt="" src="{{$link}}" >
        </div>
        <div class="flex justify-center letra">
            <p class="text-white text-center p-10">Posiciónate<br>aquí si {{$accion}}<br>un objeto </p>
        </div>
    </div>
    
    <div class="face back flex justify-between text-center text-white bg-gray-500 rounded-lg">
        <div class="flex justify-center">
            <a href="#" class="rainbow-button mt-64" alt="Registrar Objeto {{$accion2}}"></a>
        </div>
        <div class="flex justify-center mb-20">
            <a href="#" class="rainbow-button" alt="Lista de Objetos {{$accion2}}s"></a>
        </div>
    </div>
</div>