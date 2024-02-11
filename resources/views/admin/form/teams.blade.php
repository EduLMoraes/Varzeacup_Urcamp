<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de teams</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            async function getTeams() {
                try {
                    const response = await axios.get('http://localhost:8000/api/teams');
                    return response.data;
                } catch (error) {
                    console.error('Erro ao consumir a API:', error);
                    throw error; // Lançar o erro novamente para lidar com ele fora desta função, se necessário
                }
            }

            document.addEventListener("DOMContentLoaded", async function() {

                document.getElementById('vit').hidden = true;
                document.getElementById('emp').hidden = true;
                document.getElementById('der').hidden = true;

                document.getElementById('l-vit').hidden = true;
                document.getElementById('l-emp').hidden = true;
                document.getElementById('l-der').hidden = true;
                
                document.getElementById('d-submit').hidden = true;
                document.getElementById('e-submit').hidden = true;
                document.getElementById('r-submit').hidden = true;

                var team;
                var vit;
                var emp;
                var der;
                var teams = await getTeams();
                var allComplete = false;

                var has_time = false;

                

                function timeComplet() {
                    team = document.getElementById('team').value;

                    for (var i = 0; i < teams.length; i++) {
                        if (team === teams[i].name_team) { 
                            has_time = true;
                            allComplete = true;

                            hasTime();
                            document.getElementById('vit').value = teams[i].victory_team;
                            document.getElementById('emp').value = teams[i].draw_team;
                            document.getElementById('der').value = teams[i].lost_team;

                            document.getElementById('vit').hidden = false;
                            document.getElementById('emp').hidden = false;
                            document.getElementById('der').hidden = false;

                            document.getElementById('l-vit').hidden = false;
                            document.getElementById('l-emp').hidden = false;
                            document.getElementById('l-der').hidden = false;

                            break;
                        }
                        else { 
                            has_time = false;
                            allComplete = false;
                            document.getElementById('vit').value = 0;
                            document.getElementById('emp').value = 0;
                            document.getElementById('der').value = 0;

                            document.getElementById('vit').hidden = true;
                            document.getElementById('emp').hidden = true;
                            document.getElementById('der').hidden = true;

                            document.getElementById('l-vit').hidden = true;
                            document.getElementById('l-emp').hidden = true;
                            document.getElementById('l-der').hidden = true;

                            document.getElementById('d-submit').hidden = true;
                            document.getElementById('e-submit').hidden = true;
                            document.getElementById('r-submit').hidden = true;
                        } 
                    }
                    
                    if (team.length > 3 && /^[a-zA-Z]+$/.test(team)){

                        hasTime();
                        document.getElementById('vit').hidden = false;
                        document.getElementById('l-vit').hidden = false;
                    }else{
                        document.getElementById('vit').value = 0;
                        document.getElementById('emp').value = 0;
                        document.getElementById('der').value = 0;

                        document.getElementById('vit').hidden = true;
                        document.getElementById('emp').hidden = true;
                        document.getElementById('der').hidden = true;

                        document.getElementById('l-vit').hidden = true;
                        document.getElementById('l-emp').hidden = true;
                        document.getElementById('l-der').hidden = true;

                        document.getElementById('d-submit').hidden = true;
                        document.getElementById('e-submit').hidden = true;
                        document.getElementById('r-submit').hidden = true;
                    }
                }

                function vitComplet() {
                    vit = document.getElementById('vit').value;

                    if (vit >= 0 && /^[0-9]+$/.test(vit)){
                        document.getElementById('emp').hidden = false;
                        document.getElementById('l-emp').hidden = false;
                    }else{
                        document.getElementById('vit').value = 0;
                        document.getElementById('emp').hidden = true;
                        document.getElementById('l-emp').hidden = true;
                    }
                }

                function empComplet() {
                    emp = document.getElementById('emp').value;

                    if (emp.length >= 0 && /^[0-9]+$/.test(emp)){
                        document.getElementById('der').hidden = false;
                        document.getElementById('l-der').hidden = false;
                    }else{
                        document.getElementById('emp').value = 0;
                        document.getElementById('der').hidden = true;
                        document.getElementById('l-der').hidden = true;
                    }
                }

                function derComplet() {
                    der = document.getElementById('der').value;

                    if (der >= 0 && /^[0-9]+$/.test(der)){
                        allComplete = true;
                        hasTime()
                    }else{
                        document.getElementById('der').value = 0;
                        document.getElementById('d-submit').hidden = true;
                        document.getElementById('e-submit').hidden = true;
                        document.getElementById('r-submit').hidden = true;
                    }
                }

                function hasTime(){
                    if (has_time && allComplete){
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

                

                document.getElementById("team").addEventListener("input", timeComplet);
                document.getElementById("vit").addEventListener("input", vitComplet);
                document.getElementById("emp").addEventListener("input", empComplet);
                document.getElementById("der").addEventListener("input", derComplet);
            });

            function registerTeam(){
                axios.post('http://localhost:8000/api/teams', {
                    name: document.getElementById('team').value,
                    victory: document.getElementById('vit').value,
                    draw: document.getElementById('emp').value,
                    lost: document.getElementById('der').value
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*' // Permitir solicitações de qualquer origem
                    }
                }).then(() =>{
                    alert("Time registrado com sucesso!");
                });

            }

            async function updateTeam(){
                let teams = await getTeams();
                let id;

                teams.forEach(_team => {
                    if (document.getElementById('team').value === _team.name_team){
                        id = _team.id;
                    }
                });

                axios.put('http://localhost:8000/api/teams/'+id, {
                    name: document.getElementById('team').value,
                    victory: document.getElementById('vit').value,
                    draw: document.getElementById('emp').value,
                    lost: document.getElementById('der').value
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*' // Permitir solicitações de qualquer origem
                    }
                }).then(() => {
                    alert("Time atualizado com sucesso!");
                });

            }

            async function deleteTeam(){
                let teams = await getTeams();
                let id;

                teams.forEach(_team => {
                    if (document.getElementById('team').value === _team.name_team){
                        id = _team.id;
                    }
                });

                axios.delete('http://localhost:8000/api/teams/'+id)
                    .then(()=>{
                        alert("Time deletado com sucesso!");
                        location.reload();
                    });

            }
        </script>
    </head>
    <body>
        @include ('template/header')

        <div class="container">


            @include('admin/navbar')


            <form action="{{ route('teams.store') }}" method="POST" class="form">
                @csrf

                <label id="l-team">Time:</label>
                <input type="text" name="name" id="team" required>
                
                <label id="l-vit">Vitórias:</label>
                <input type="number" name="victory" id="vit" required>
                
                <label id="l-emp">Empates:</label>
                <input type="number" name="draw" id="emp" required>
                
                <label id="l-der">Derrotas:</label>
                <input type="number" name="lost" id="der" required>

                <div class="submits">
                    <button type="button" onclick="deleteTeam()" class="button-submit del"  id="d-submit">Deletar</button>
                    <button type="button" onclick="updateTeam()" class="button-submit edit" id="e-submit">Editar</button>
                    <button type="button" onclick="registerTeam()" class="button-submit cad"  id="r-submit">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>