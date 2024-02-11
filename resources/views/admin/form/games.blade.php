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
            async function getGames(){
                try {
                    const response = await axios.get('http://localhost:8000/api/games');
                    return response.data;
                } catch (error) {
                    console.error('Erro ao consumir a API:', error);
                    throw error; // Lançar o erro novamente para lidar com ele fora desta função, se necessário
                }
            }

           
             document.addEventListener("DOMContentLoaded", async function() {
            
                var games = await getGames();

                var select_game = document.getElementById('select-game');

                games.forEach(function (game) {
                    var row = document.createElement('option');
                    row.value = game.id;
                    row.innerHTML = `
                        ${game.id}| ${game.id_home} ${game.home_gols}X${game.visitor_gols} ${game.id_visitor}
                    `;
                    select_game.appendChild(row);

                });

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

                async function selectedGame(){
                    selected = document.getElementById('select-game').value;

                    if (selected !== "new"){

                        var game;
                        for(let i = 0; i <games.length; i++){
                            if(selected == games[i].id){
                                game = games[i];
                            }
                        };

                        document.getElementById('home').value = game.id_home;
                        document.getElementById('vis').value = game.id_visitor;
                        document.getElementById('ghome').value = game.home_gols;
                        document.getElementById('gvis').value = game.visitor_gols;
                        document.getElementById('date').value = game.date;
                        document.getElementById('hour').value = game.hour;
                        document.getElementById('group').value = game.group_name;
    
                        document.getElementById('l-ghome').value = games;
                        document.getElementById('l-vis').value = games;
                        document.getElementById('l-gvis').value = games;

                        document.getElementById('ghome').hidden = false;
                        document.getElementById('vis').hidden = false;
                        document.getElementById('gvis').hidden = false;
    
                        document.getElementById('l-ghome').hidden = false;
                        document.getElementById('l-vis').hidden = false;
                        document.getElementById('l-gvis').hidden = false;

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

            function registerGame(){
                axios.post('http://localhost:8000/api/games', {
                    home: document.getElementById('home').value,
                    visitor: document.getElementById('vis').value,
                    hgols: document.getElementById('ghome').value,
                    vgols: document.getElementById('gvis').value,
                    date: document.getElementById('date').value,
                    group: document.getElementById('group').value,
                    hour: document.getElementById('hour').value
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*' // Permitir solicitações de qualquer origem
                    }
                }).then(() =>{
                    alert("Registrado com sucesso!");
                });

            }

            async function updateGame(){
                let selected = document.getElementById('select-game').value;
                let games = await getGames();
                let id;

                if (selected != "new"){
                    games.forEach(_game => {
                        if (selected == _game.id){
                            id = _game.id;
                        }
                    });
    
                    axios.put('http://localhost:8000/api/games/'+id, {
                        home: document.getElementById('home').value,
                        visitor: document.getElementById('vis').value,
                        hgols: document.getElementById('ghome').value,
                        vgols: document.getElementById('gvis').value,
                        date: document.getElementById('date').value,
                        group: document.getElementById('group').value,
                        hour: document.getElementById('hour').value
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Access-Control-Allow-Origin': '*' // Permitir solicitações de qualquer origem
                        }
                    }).then(() => {
                        alert("Editado com sucesso!");
                    });
                }else{
                    alert("Selecione um jogo existente para editar");
                }

            }

            async function deleteGame(){
                let selected = document.getElementById('select-game').value;
                let games = await getGames();
                let id;

                if (selected == "new"){
                    alert("Selecione um jogo existente para excluir");
                    return 0;
                }
                
                games.forEach(games => {
                    if (selected == games.id){
                        id = games.id;
                    }
                });

                axios.delete('http://localhost:8000/api/games/'+id).then(() => {
                    alert("Deletado com sucesso!");
                });
                
                location.reload();
            }
        </script>
        
    </head>
    <body>
        @include ('template/header')

        <div class="container">


            @include('admin/navbar')


            <form action="post" class="form">
                @csrf


                <label>Jogo:</label>
                    <select id="select-game">
                        <option value="new" id="option">Novo jogo</option>
                                
                    </select>
                
                <label>Grupo:</label>
                    <input type="text" name="" id="group" required>
                </select>

                <label>Data:</label>
                    <input type="date" name="" id="date" required>
                </select>

                <label>Horário:</label>
                    <input type="time" name="" id="hour" required>
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
                    <button type="button" onclick="deleteGame()" class="button-submit del" id="d-submit">Deletar</button>
                    <button type="button" onclick="updateGame()" class="button-submit edit" id="e-submit">Editar</button>
                    <button type="button" onclick="registerGame()" class="button-submit cad" id="r-submit">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>