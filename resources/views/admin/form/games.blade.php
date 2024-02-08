<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de partidas</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    </head>
    <body>
        @include ('template/header')

        <div class="container">


            <div class="navbar-adm">
                    <a href="/admin">Início</a>
                    <a href="/admin/times">Times</a>
                    <a href="/admin/games">Partidas</a>
                    <a href="/admin/counts">Contas</a>
                    <a href="/">Sair</a>
            </div>

            <form action="post">
                <label>Jogo:</label>
                <select name="" id="">
                    <option value="{{ count($games) + 1}}">Novo jogo</option>
                    @foreach($games as $game){
                        <option value="$game->id">{{$game->desc}}</option>
                    }
                    @endforeach
                </select>
                
                <label>Casa:</label>
                <input type="text" name="" id="">
                
                <label></label>
                Pontos da Casa:
                <input type="number" name="" id="">
                
                <label>Visitante:</label>
                <input type="number" name="" id="">
                
                <label>Pontos do visitante:</label>
                <input type="number" name="" id="">

                <div class="submits">
                    <button type="submit" class="button-submit del">Deletar</button>
                    <button type="submit" class="button-submit edit">Editar</button>
                    <button type="submit" class="button-submit cad">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>