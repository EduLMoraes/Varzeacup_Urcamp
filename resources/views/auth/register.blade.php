<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - login</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </head>
    <body>
        @include ('header')

        <div class="container">
            <form action="" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="">

                <label for="username">Nome de usuário:</label>
                <input type="text" name="username" id="">

                <label for="password">Senha:</label>
                <input type="password" name="password" id="">

                <label for="confirm-password">Confirme sua senha</label>
                <input type="password" name="confirm-password" id="">

                <input class="button-submit" type="submit" value="Criar conta">
            </form>
        </div>

        @include ('footer')
    </body>
</html>