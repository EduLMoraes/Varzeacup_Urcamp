<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ACMA - Gerenciamento de contas</title>
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

        <script>
            document.addEventListener("DOMContentLoaded", function() {
            
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
                }
            }

            function nameComplet() {
                name = document.getElementById('name').value;

                if (validName(name)){
                    document.getElementById('pass').hidden = false;
                    document.getElementById('l-pass').hidden = false;
                }else{
                    document.getElementById('pass').hidden = true;
                }
            }

            function passComplet() {
                pass = document.getElementById('pass').value;

                if (pass.length >= 6){
                    document.getElementById('cpass').hidden = false;
                    document.getElementById('l-cpass').hidden = false;
                }else{
                    document.getElementById('cpass').hidden = true;
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