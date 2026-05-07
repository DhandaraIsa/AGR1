<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <div class="brand">
            <img src="{{ asset('img/AGR_LOGO.png') }}" class="logo-nav">
        </div>

        <!-- MOBILE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">

            <!-- MENU -->
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        Início
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/catalogo') }}">Catálogo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/planos') }}">Planos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/congressos') }}">Congressos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/eventos') }}">Eventos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cursos') }}">Cursos</a>
                </li>

            </ul>

            <!-- LOGIN / USUÁRIO -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-login dropdown-toggle" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('perfil') }}">
                                👤 Meu perfil
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    🚪 Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-login">
                    Entrar
                </a>
            @endguest

        </div>
    </div>
</nav>