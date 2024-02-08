<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ACMA - Varzeacup</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    </head>
    <body class="antialiased">
        @include ('template/header')

        <div class="container">

            <div class="nav-bar">
                <div class="auth-buttons">
                    <button class="button-auth" onclick="window.location='{{ url('login') }}'">Entrar</button>
                </div>
            </div>
    
            @include('template/cup')
            
        </div>
        
        @include('template/footer')
    </body>
</html>
