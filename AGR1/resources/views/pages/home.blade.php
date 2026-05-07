@extends('layouts.app')

@section('content')
<div class="container py-5">

    <section class="hero-home mb-5">
        <div class="row align-items-center g-4">

            {{-- LADO ESQUERDO --}}
            <div class="col-lg-6">

                <span class="badge bg-primary-subtle text-info px-3 py-2 mb-2">
                    💎 Plataforma Premium
                </span>

                {{-- TÍTULO DINÂMICO --}}
                @auth
                    <h1 class="hero-title mt-3 fw-bold">
                        Bem-vindo(a), <span class="text-info">{{ Auth::user()->name }}</span>
                    </h1>
                @else
                    <h1 class="hero-title mt-3 fw-bold">
                        Soluções exclusivas para clientes AGR
                    </h1>
                @endauth

                <p class="hero-text">
                    Acesse catálogos, conheça planos especiais, participe de congressos,
                    cursos e eventos, e finalize seus pedidos com praticidade.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ url('/catalogo') }}" class="btn btn-primary btn-lg px-4">
                        Ver catálogo
                    </a>

                    <a href="{{ url('/planos') }}" class="btn btn-outline-light btn-lg px-4">
                        Conhecer planos
                    </a>
                </div>

            </div>

            {{-- LADO DIREITO --}}
            <div class="col-lg-6 text-center">

                <img 
                    src="{{ asset('img/AGR_LOGO.png') }}" 
                    alt="AGR Prime"
                    class="hero-logo mb-3"
                >

                <h4 class="hero-card-title mt-3">
                    Vantagens para clientes AGR
                </h4>

                <ul class="hero-list list-unstyled mt-3">
                    <li class="mb-2">⚡ Pedidos rápidos e práticos</li>
                    <li class="mb-2">💎 Planos com benefícios exclusivos</li>
                    <li class="mb-2">🎓 Acesso a cursos e congressos</li>
                    <li class="mb-2">📲 Finalização via WhatsApp</li>
                </ul>

            </div>

        </div>
    </section>

    {{-- CARDS --}}
    <section class="mb-5">
        <div class="row g-4">

            <div class="col-md-6 col-xl-3">
                <div class="card-home h-100">
                    <h4>Catálogo</h4>
                    <p>Consulte produtos e monte seu pedido com facilidade.</p>
                    <a href="{{ url('/catalogo') }}" class="home-link">
                        Acessar catálogo
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-home h-100">
                    <h4>Planos</h4>
                    <p>Confira Bronze, Prata, Ouro e Diamond.</p>
                    <a href="{{ url('/planos') }}" class="home-link">
                        Ver planos
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-home h-100">
                    <h4>Congressos</h4>
                    <p>Veja os congressos disponíveis e demonstre interesse.</p>
                    <a href="{{ url('/congressos') }}" class="home-link">
                        Ver congressos
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-home h-100">
                    <h4>Cursos e Eventos</h4>
                    <p>Participe das experiências exclusivas da AGR Medical.</p>
                    <a href="#" class="home-link">
                        Em breve
                    </a>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection