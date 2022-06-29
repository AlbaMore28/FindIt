<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        <title>FindIt</title>
        <link rel="icon" href="{{ asset('storage/img/brujula.png') }}">
    </head>
    <body>
        <x-cabecera/>
        <div class="flex flex-col justify-center bg-gradient-to-t from-blush via-steel to-blue-gray h-full">
            @yield('contenido')
        
            <div class="flex justify-center">
                <hr>
            </div>
            <x-destacados :objetos='$objetos'/>
            
        </div>
    </body>
</html>