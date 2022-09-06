<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        @yield('css')
        <title>FindIt</title>
        <link rel="icon" href="{{ asset('storage/img/brujula.png') }}">
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        <header>
            <x-cabecera/>
        </header>
        
        <main>
            @if (session('success'))
                <x-alerta color='green' :mensaje="session('success')"/>
            @endif
            @if (session('info'))
                <x-alerta color='yellow' :mensaje="session('info')"/>
            @endif
            @if (session('error'))
                <x-alerta color='red' :mensaje="session('error')"/>
            @endif
            @yield('contenido')
        </main>

        <footer>
            <x-footer/>
        </footer>
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(document).ready(function(){
                $info = $('#info');
                if($info.length){
                    setTimeout(function(){
                        $info.addClass('hidden');
                    }, 7000);
                    $('#close-info').click(function (){
                        $info.hide();
                    });
                }
                $('body').children('#h_b_bfsin').css("display","none");
            });
        </script>
        @yield('js')
    </body>
</html>