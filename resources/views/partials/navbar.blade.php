<nav class="navbar navbar-expand-lg premium-nav py-3">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('img/AGR_LOGO.png') }}" alt="AGR Prime" class="logo-nav" style="width: 140px; filter: drop-shadow(0 0 18px rgba(29, 209, 161, 0.5));">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPremium" aria-controls="navbarPremium" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPremium">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Início</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('catalogo') ? 'active' : '' }}" href="{{ route('catalogo') }}">Catálogo</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('planos') ? 'active' : '' }}" href="{{ route('planos') }}">Planos</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('congressos') ? 'active' : '' }}" href="{{ route('congressos') }}">Congressos</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('eventos') ? 'active' : '' }}" href="{{ route('eventos') }}">Eventos</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->is('cursos') ? 'active' : '' }}" href="{{ route('cursos') }}">Cursos</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-premium dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('perfil') }}">Meu perfil</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
