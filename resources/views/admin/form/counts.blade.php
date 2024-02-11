<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de contas</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            async function getCounts(){
                try {
                    const response = await axios.get('http://localhost:8000/api/users');
                    return response.data;
                } catch (error) {
                    console.error('Erro ao consumir a API:', error);
                    throw error; 
                }
            }

            document.addEventListener("DOMContentLoaded", async function() {
            
                document.getElementById('name').hidden = true;
                document.getElementById('pass').hidden = true;
                document.getElementById('cpass').hidden = true;

                document.getElementById('l-name').hidden = true;
                document.getElementById('l-pass').hidden = true;
                document.getElementById('l-cpass').hidden = true;
                
                document.getElementById('d-button-submit').hidden = true;
                document.getElementById('e-button-submit').hidden = true;
                document.getElementById('r-button-submit').hidden = true;

                var email;
                var username;
                var password;
                var cpassword;

                var users = getCounts();

                function validEmail(email) {
                    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    return re.test(email);
                }

                function validName(name) {
                    return name.length > 4;
                }

                function validPass(pass, cpass) {
                    return pass == cpass;
                }

                function emailComplet() {
                    email = document.getElementById('email').value;

                    if (validEmail(email)){
                        document.getElementById('name').hidden = false;
                        document.getElementById('l-name').hidden = false;
                    }else{
                        document.getElementById('name').hidden = true;
                        document.getElementById('l-name').hidden = true;
                    }
                }

                function nameComplet() {
                    name = document.getElementById('name').value;

                    if (validName(name)){
                        document.getElementById('pass').hidden = false;
                        document.getElementById('l-pass').hidden = false;
                    }else{
                        document.getElementById('pass').hidden = true;
                        document.getElementById('l-pass').hidden = true;
                    }
                }

                function passComplet() {
                    pass = document.getElementById('pass').value;

                    if (pass.length >= 6 ){
                        document.getElementById('cpass').hidden = false;
                        document.getElementById('l-cpass').hidden = false;
                    }else{
                        document.getElementById('cpass').hidden = true;
                        document.getElementById('l-cpass').hidden = true;
                    }
                }

                function cpassComplet() {
                    cpass = document.getElementById('cpass').value;

                    if (validPass(pass, cpass)){
                        document.getElementById('d-button-submit').hidden = false;
                        document.getElementById('e-button-submit').hidden = false;
                        document.getElementById('r-button-submit').hidden = false;
                    }else{
                        document.getElementById('d-button-submit').hidden = true;
                        document.getElementById('e-button-submit').hidden = true;
                        document.getElementById('r-button-submit').hidden = true;
                    }
                }

                document.getElementById("email").addEventListener("input", emailComplet);
                document.getElementById("name").addEventListener("input", nameComplet);
                document.getElementById("pass").addEventListener("input", passComplet);
                document.getElementById("cpass").addEventListener("input", cpassComplet);
            });

            function registerUser(){
                axios.post('http://localhost:8000/api/users', {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*' // Permitir solicitações de qualquer origem
                    }
                }).then(() =>{
                    alert("Registrado com sucesso!");
                });

            }

            async function updateUser(){
                let selected = document.getElementById('select-game').value;
                let games = await getGames();
                let id;

                if (selected != "new"){
                    games.forEach(_game => {
                        if (selected == _game.id){
                            id = _game.id;
                        }
                    });
    
                    axios.put('http://localhost:8000/api/users/'+id, {
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value,
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

            async function deleteUser(){
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

                axios.delete('http://localhost:8000/api/users/'+id).then(() => {
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
                <label for="email" id="l-email">Email:</label>
                <input type="email" name="" id="email" required>

                <label for="name" id="l-name">Nome de usuário:</label>
                <input type="text" name="" id="name" required>
                
                <label for="pass" id="l-pass">Senha:</label>
                <input type="password" name="" id="pass" required>
                
                <label for="cpass" id="l-cpass">Confirme sua senha:</label>
                <input type="password" name="" id="cpass" required>

                <div class="submits">
                    <button type="submit" class="button-submit del" id="d-button-submit">Deletar</button>
                    <button type="submit" class="button-submit edit" id="e-button-submit">Editar</button>
                    <button type="submit" class="button-submit cad" id="r-button-submit">Cadastrar</button>
                </div>
                <p id="response"></p>
            </form>

        </div>

        @include ('template/footer')
    </body>
</html>