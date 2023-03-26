@extends('layouts.plantilla-chat')

@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@section('contenido')
    @livewire('chat-component', compact('chat'))
@endsection