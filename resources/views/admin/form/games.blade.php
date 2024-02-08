<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de partidas</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>

            axios.get('http://localhost:8000/api/games')
            .then(function (response) {

                var games = response.data;

                var select_game = document.getElementById('select-game');

                var row = document.createElement('option');
                row.innerHTML = `
                    <option value="${games.length}">${games.length}| Novo jogo</option>
                `;
                select_game.appendChild(row);

                console.log(games);
                games.forEach(function (game) {
                    var row = document.createElement('option');

                    row.innerHTML = `
                        <option value="${game.id}">${game.id}| ${game.desc}</option>
                    `;
                    select_game.appendChild(row);

                });
            })
            .catch(function (error) {
                console.error('Erro ao consumir a API:', error);
            });
        </script>
        
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
                <select id="select-game">
                </select>
                
                <label>Casa:</label>
                <input type="text" name="" id="">
                
                <label></label>
                Gols da Casa:
                <input type="number" name="" id="">
                
                <label>Visitante:</label>
                <input type="number" name="" id="">
                
                <label>Gols do visitante:</label>
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