<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        
    </head>
    <body>
        @include ('template/header')

        <div class="container">
            @include('admin/navbar')

            @include('template/cup')

        </div>

        @include ('template/footer')
    </body>
</html>