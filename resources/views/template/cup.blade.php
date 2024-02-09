<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<script>
    axios.get('http://localhost:8000/api/times')
        .then(function (response) {
            var times = response.data;
            console.log(times)
            var tableBody = document.getElementById('times-table-body');

            var i = 0;
            times.forEach(function (time) {
                i++;
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${i}</td>
                    <td>${time.name_time}</td>
                    <td>${time.points_time}</td>
                    <td>${time.games_time}</td>
                    <td>${time.victory_time}</td>
                    <td>${time.draw_time}</td>
                    <td>${time.lost_time}</td>
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
                    <td>${game.home}</td>
                    <td>${game.home_gols}X${game.visitor_gols}</td>
                    <td>${game.visitor}</td>
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
        <tbody id="times-table-body">
        </tbody>
    </table>

    <h1 class="title-part">Partidas</h1>
    <table class="table-part">
        <thead>
            <tr>
                <td class="time">Casa</td>
                <td class="result">X</td>
                <td class="time">Visitante</td>
            </tr>
        </thead>
        <tbody id="games-table-body">
        </tbody>
    </table>
</div>
