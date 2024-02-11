<div class="navbar-adm">
    
    <a href="/admin">Início</a>
    <a href="/admin/teams">Times</a>
    <a href="/admin/games">Partidas</a>
    <a href="/admin/counts">Contas</a>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="disfarce">Sair</button>
    </form>
</div>