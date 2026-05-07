@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge bg-primary rounded-pill px-4 py-2 mb-3">
            AGR Medical Prime
        </span>

        <h1 class="text-white fw-bold">
            Planos AGR
        </h1>

        <p class="text-white-50">
            Benefícios exclusivos conforme o perfil do cliente.
        </p>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach($plans as $plan)
            @php
                $isDiamond = str_contains(strtolower($plan->name), 'diamond');
                $benefits = explode("\n", $plan->benefits);
            @endphp

            <div class="col-12 col-md-6 col-xl-3">
                <div class="plan-premium-card {{ $isDiamond ? 'diamond-glow' : '' }} h-100">

                    @if($isDiamond)
                        <div class="diamond-badge">
                            💎 Destaque
                        </div>
                    @endif

                    <h3 class="plan-name">
                        {{ $plan->name }}
                    </h3>

                    <p class="plan-subtitle">
                        Benefícios incluídos
                    </p>

                    <ul class="plan-benefits">
                        @foreach($benefits as $benefit)
                            @if(trim($benefit) && !str_contains($benefit, 'Benefícios incluídos'))
                                <li>{{ str_replace('-', '', $benefit) }}</li>
                            @endif
                        @endforeach
                    </ul>

                    <a
                        href="https://wa.me/5511999999999?text={{ urlencode('Olá, quero saber mais sobre o ' . $plan->name) }}"
                        target="_blank"
                        class="plan-button"
                    >
                        Quero esse plano
                    </a>

                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection