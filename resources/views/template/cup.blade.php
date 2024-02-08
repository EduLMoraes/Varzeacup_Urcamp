<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<script>
    // Faça uma solicitação GET para a API para obter os times
    axios.get('http://localhost:8000/api/times')
        .then(function (response) {
            // Manipule a resposta da API
            console.log(response.data);

            // Preencha a tabela com os dados recebidos
            var times = response.data;

            var tableBody = document.getElementById('times-table-body');

            times.forEach(function (time) {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${time.id}</td>
                    <td>${time.name}</td>
                    <td>${time.points}</td>
                    <td>${time.games}</td>
                    <td>${time.victorys}</td>
                    <td>${time.draws}</td>
                    <td>${time.loses}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(function (error) {
            // Manipule erros, se houver
            console.error('Erro ao consumir a API:', error);
        });

        // Faça uma solicitação GET para a API para obter os times
    axios.get('http://localhost:8000/api/games')
        .then(function (response) {
            // Manipule a resposta da API
            console.log(response.data);

            // Preencha a tabela com os dados recebidos
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
    <h1 class="title-clas">CLASSIFICAÇÃO DOS TIMES</h1>
    <table class="table-clas">
        <thead>
            <tr>
                <td>Posição</td>
                <td>Time</td>
                <td>Pontos</td>
                <td>Jogos</td>
                <td>Vitórias</td>
                <td>Empates</td>
                <td>Derrotas</td>
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
