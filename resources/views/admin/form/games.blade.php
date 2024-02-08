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
                    <option value="${games.length}" id="max-games">${games.length}| Novo jogo</option>
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

            document.addEventListener("DOMContentLoaded", function() {
            
                document.getElementById('ghome').hidden = true;
                document.getElementById('vis').hidden = true;
                document.getElementById('gvis').hidden = true;

                document.getElementById('l-ghome').hidden = true;
                document.getElementById('l-vis').hidden = true;
                document.getElementById('l-gvis').hidden = true;
                
                document.getElementById('d-submit').hidden = true;
                document.getElementById('e-submit').hidden = true;
                document.getElementById('r-submit').hidden = true;

                var home;
                var ghome;
                var vis;
                var gvis;
                var selected;
                var allComplete = false;

                function homeComplet() {
                    home = document.getElementById('home').value;

                    if (home.length > 3 && /^[a-zA-Z]+$/.test(home)){
                        document.getElementById('ghome').hidden = false;
                        document.getElementById('l-ghome').hidden = false;
                    }else{
                        document.getElementById('ghome').hidden = true;
                        document.getElementById('l-ghome').hidden = true;
                    }
                }

                function ghomeComplet() {
                    ghome = document.getElementById('ghome').value;

                    if (ghome >= 0 && /^[0-9]+$/.test(ghome)){
                        document.getElementById('vis').hidden = false;
                        document.getElementById('l-vis').hidden = false;
                    }else{
                        document.getElementById('ghome').value = 0;
                        document.getElementById('vis').hidden = true;
                        document.getElementById('l-vis').hidden = true;
                    }
                }

                function visComplet() {
                    vis = document.getElementById('vis').value;

                    if (vis.length > 3 && /^[a-zA-Z]+$/.test(vis)){
                        document.getElementById('gvis').hidden = false;
                        document.getElementById('l-gvis').hidden = false;
                    }else{
                        document.getElementById('gvis').hidden = true;
                        document.getElementById('l-gvis').hidden = true;
                    }
                }

                function gvisComplet() {
                    gvis = document.getElementById('gvis').value;

                    if (gvis >= 0 && /^[0-9]+$/.test(gvis)){
                        allComplete = true;
                        selectedGame()
                    }else{
                        document.getElementById('gvis').value = 0;
                        document.getElementById('d-submit').hidden = true;
                        document.getElementById('e-submit').hidden = true;
                        document.getElementById('r-submit').hidden = true;
                    }
                }

                function selectedGame(){
                    selected = document.getElementById('select-game').value;
                    var max = document.getElementById('max-games').value;
                    console.log(max);

                    if (selected < max && allComplete){
                        document.getElementById('d-submit').hidden = false;
                        document.getElementById('e-submit').hidden = false;
                        document.getElementById('r-submit').hidden = true;
                    }
                    else if(allComplete){
                        document.getElementById('d-submit').hidden = true;
                        document.getElementById('e-submit').hidden = true;
                        document.getElementById('r-submit').hidden = false;
                    }
                }

                document.getElementById("home").addEventListener("input", homeComplet);
                document.getElementById("ghome").addEventListener("input", ghomeComplet);
                document.getElementById("vis").addEventListener("input", visComplet);
                document.getElementById("gvis").addEventListener("input", gvisComplet);
                document.getElementById("select-game").addEventListener("input", selectedGame);
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
                
                <label id="l-home">Casa:</label>
                <input type="text" name="" id="home" required>
                
                <label id="l-ghome">Gols da Casa:</label>
                <input type="number" name="" id="ghome" required>
                
                <label id="l-vis">Visitante:</label>
                <input type="text" name="" id="vis" required>
                
                <label id="l-gvis">Gols do visitante:</label>
                <input type="number" name="" id="gvis" required>

                <div class="submits">
                    <button type="submit" class="button-submit del" id="d-submit">Deletar</button>
                    <button type="submit" class="button-submit edit" id="e-submit">Editar</button>
                    <button type="submit" class="button-submit cad" id="r-submit">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>