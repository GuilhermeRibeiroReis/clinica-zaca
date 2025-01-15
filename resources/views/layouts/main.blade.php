<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Clinica Zaca - Especialistas em Saúde">
        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!-- CSS da Aplicação -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/script.js') }}"></script>

    </head>
    <body class="font-sans antialiased">    
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> . <ion-icon name="medkit-outline"></ion-icon> . C L I N I C A  /  Z A C A . </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                    @endif

                    @if(!auth()->check()) 
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Entrar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/register">Registre-se</a>
                        </li>
                    @endif

                    <!-- MENU ADMINISTRADORES -->

                    <li class="nav-item dropdown">
                        @if(auth()->check() && auth()->user()->idUserTipo == 1)  <!-- Verifica se o usuário está autenticado e é um administrador -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrativo</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/medicos/criar">Registrar Médico</a></li>
                                <li><a class="dropdown-item" href="/administrativo/create">Registrar Usuario Administrativo</a></li>
                                <li><a class="dropdown-item" href="/consultas/create">Registrar Consulta</a></li>
                                <li><a class="dropdown-item" href="/pacientes/create">Registrar Paciente</a></li>
                            </ul>
                        @endif
                    </li>

                    <!-- MENU MEDICOS -->

                    <li class="nav-item dropdown">
                        @if(auth()->check() && auth()->user()->idUserTipo == 2)  <!-- Verifica se o usuário está autenticado e é um médico -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrativo</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/consultas/criar">Consultar ficha paciente </a></li>
                                <li><a class="dropdown-item" href="/medicos/agenda">Listar Agenda</a></li>
                            </ul>
                        @endif
                    </li>                    
                </ul>                        
                    
                <!-- Exibir nome do usuário logado e seu ID -->
                @auth
                    <ion-icon name="person-circle-outline"></ion-icon>
                    {{ Auth::user()->name }} (ID: {{ Auth::user()->id }})
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                @endauth

                </div>
            </div>
        </nav>
    </header>
    <main>
        <br><br>
        <div class="col-md-10 mx-auto col-lg-5">

            @if(session('msg'))
                
                    <p class="msg">Mensagem usando session (aqui esta na main - MSG): {{ session('msg') }}</p>

            @endif

            @yield('content')
        </div>
    </main>
    <footer>
        <p>Clinica Zaca &copy; 2024</p>
        <p>Desenvolvido por Guilherme Reis</p>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    </body>
</html>
