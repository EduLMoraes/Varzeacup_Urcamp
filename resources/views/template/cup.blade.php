<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<script>
    axios.get('http://localhost:8000/api/teams')
        .then(function (response) {
            var teams = response.data;
            console.log(teams)
            var tableBody = document.getElementById('teams-table-body');

            var i = 0;
            teams.forEach(function (time) {
                i++;
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${i}</td>
                    <td>${time.name_team}</td>
                    <td>${time.points_team}</td>
                    <td>${time.games_team}</td>
                    <td>${time.victory_team}</td>
                    <td>${time.draw_team}</td>
                    <td>${time.lost_team}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(function (error) {
            console.error('Erro ao consumir a API:', error);
        });

    axios.get('http://localhost:8000/api/games')
        .then(function (response) {

            var games = response.data;

            var tableBody = document.getElementById('games-table-body');

            games.forEach(function (game) {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        ${game.date} às ${game.hour}
                        
                    </td>
                    <td>${game.id_home}</td>
                    <td>
                        ${game.group_name}
                        <br>
                        ${game.home_gols}X${game.visitor_gols}
                    </td>
                    <td>${game.id_visitor}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(function (error) {
            // Manipule erros, se houver
            console.error('Erro ao consumir a API:', error);
        });
</script>

<div class="clas">
    <table class="table-clas">
        <h1 class="title-clas">CLASSIFICAÇÃO DOS TIMES</h1>
        <thead>
            <tr>
                <td>Posição</td>
                <td>Time</td>
                <td>Pts</td>
                <td>PJ</td>
                <td>V</td>
                <td>E</td>
                <td>D</td>
            </tr>
        </thead>
        <tbody id="teams-table-body">
        </tbody>
    </table>

    <h1 class="title-part">Partidas</h1>
    <table class="table-part">
        <thead>
            <tr>
                <td class="datetime">Data e Horário</td>
                <td class="time">Casa</td>
                <td class="result">Rodada<br>X</td>
                <td class="time">Visitante</td>
            </tr>
        </thead>
        <tbody id="games-table-body">
        </tbody>
    </table>
</div>
