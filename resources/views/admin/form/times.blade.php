<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de times</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            async function getTimes() {
                try {
                    const response = await axios.get('http://localhost:8000/api/times');
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

                var time;
                var vit;
                var emp;
                var der;
                var times = await getTimes();
                var allComplete = false;

                var has_time = false;

                

                function timeComplet() {
                    time = document.getElementById('time').value;

                    for (var i = 0; i < times.length; i++) {
                        if (time == times[i].name) { 
                            has_time = true;
                            break;
                        }
                        else { has_time = false } 
                    }
                    
                    if (time.length > 3 && /^[a-zA-Z]+$/.test(time)){
                        hasTime();
                        document.getElementById('vit').hidden = false;
                        document.getElementById('l-vit').hidden = false;
                    }else{
                        document.getElementById('vit').hidden = true;
                        document.getElementById('l-vit').hidden = true;
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

                document.getElementById("time").addEventListener("input", timeComplet);
                document.getElementById("vit").addEventListener("input", vitComplet);
                document.getElementById("emp").addEventListener("input", empComplet);
                document.getElementById("der").addEventListener("input", derComplet);
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
                
                <label id="l-time">Time:</label>
                <input type="text"  id="time" required>
                
                <label id="l-vit">Vitórias:</label>
                <input type="number"  id="vit" required>
                
                <label id="l-emp">Empates:</label>
                <input type="number"  id="emp" required>
                
                <label id="l-der">Derrotas:</label>
                <input type="number"  id="der" required>

                <div class="submits">
                    <button type="submit" class="button-submit del"  id="d-submit">Deletar</button>
                    <button type="submit" class="button-submit edit" id="e-submit">Editar</button>
                    <button type="submit" class="button-submit cad"  id="r-submit">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>