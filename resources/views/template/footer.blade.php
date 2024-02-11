<head>
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>
<footer>
    <p>
        ©2024 ACME, Inc.
    </p>    
    <p>
        @if (Auth::user()){
            User: <a id="navbarDropdown" class="nav-link dropdown-toggle" href="admin" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
        }
        @endif
    </p>
    <p>
        Developed by EduLMoraes
    </p>
</footer>