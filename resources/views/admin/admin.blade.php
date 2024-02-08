<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <script>
        // Importe o Axios
        import axios from 'axios';

        console.log("aqui")
        // Faça uma solicitação GET para a API
        axios.get('http://localhost:8000/api/times')
        .then(function (response) {
            // Manipule a resposta da API
            console.log(response.data);

            // Envie os dados recebidos de volta para o servidor usando uma solicitação POST
            axios.post('http://localhost:8000/template/cup.blade.php', {
            dados: response.data
            })
            .then(function (response) {
            console.log('Dados enviados com sucesso para o PHP');
            })
            .catch(function (error) {
            console.error('Erro ao enviar dados para o PHP:', error);
            });
        })
        .catch(function (error) {
            // Manipule erros, se houver
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

                @include('template/cup')

        </div>

        @include ('template/footer')
    </body>
</html>