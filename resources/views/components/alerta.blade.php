@props(['color','mensaje'])

<div id="info" class="bg-{{$color}}-100 border-l-4 border-{{$color}}-500 text-{{$color}}-700 p-4">
    <strong>{{$mensaje}} <i id="close-info" class="fas fa-close ml-2"></i></strong>
</div>  