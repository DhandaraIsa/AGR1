@extends('layouts.app')

@section('content')

<div class="experiences-shell">
    <section class="experiences-hero py-5">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="eyebrow text-glow">Experiências Exclusivas AGR</span>
                    <h1 class="display-5 text-white fw-bold hero-title">Experiências Exclusivas AGR</h1>
                    <p class="hero-copy text-light">Uma nova forma de consumir cursos, eventos e congressos em uma única plataforma premium, com conteúdo selecionado para mentes ambiciosas.</p>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="#experiences-list" class="btn glow-button btn-lg">Ver experiências</a>
                        <a href="{{ route('planos') }}" class="btn btn-outline-light btn-lg">Conhecer planos</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-card glass-card p-4 mx-auto">
                        <img src="{{ asset('img/experiences-hero.png') }}" alt="Experiências Premium" class="img-fluid rounded-4 experience-hero-image" onerror="this.src='https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="experiences-filters py-4">
        <div class="container">
            <div class="filter-list d-flex flex-wrap gap-2 justify-content-center" x-data="{}">
                <button type="button" class="filter-pill active" data-filter="all">Todos</button>
                <button type="button" class="filter-pill" data-filter="curso">Cursos</button>
                <button type="button" class="filter-pill" data-filter="evento">Eventos</button>
                <button type="button" class="filter-pill" data-filter="online">Online</button>
                <button type="button" class="filter-pill" data-filter="presencial">Presencial</button>
                <button type="button" class="filter-pill" data-filter="premium">Premium</button>
            </div>
        </div>
    </section>

    <section class="experiences-list py-5" id="experiences-list">
        <div class="container">
            <div class="section-head d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                <div>
                    <p class="section-subtitle text-glow">Navegue por experiências premium</p>
                    <h2 class="section-title text-white">Mais procurados</h2>
                </div>
                <div class="text-end text-muted">Total: {{ $experiences->count() }}</div>
            </div>

            <div class="row g-4" id="experiencesGrid">
                @forelse ($experiences as $experience)
                    @php
                        $format = str_contains(strtolower($experience->location ?? ''), 'online') ? 'online' : 'presencial';
                    @endphp
                    <div class="col-12 col-md-6 col-xl-4 experience-card-wrap" data-type="{{ $experience->type }}" data-format="{{ $format }}" data-premium="{{ $experience->is_premium ? 'premium' : 'regular' }}">
                        <article class="experience-card glass-card h-100 overflow-hidden position-relative">
                            <div class="experience-image-wrap position-relative">
                                <img src="{{ $experience->image ?: asset('img/experience-placeholder.jpg') }}" alt="{{ $experience->title }}" class="experience-image">
                                @if($experience->is_premium)
                                    <span class="badge premium-badge">Premium</span>
                                @endif
                                <span class="badge category-badge">{{ ucfirst($experience->type) }}</span>
                            </div>
                            <div class="experience-body p-4 d-flex flex-column h-100">
                                <h3 class="experience-title text-white">{{ $experience->title }}</h3>
                                <div class="experience-meta text-muted mb-3">
                                    <span>{{ $experience->date?->format('d/m/Y') ?? 'Em breve' }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $experience->location ?: 'Local a definir' }}</span>
                                </div>
                                <p class="experience-description text-light mb-4">{{ \Illuminate\Support\Str::limit($experience->description, 110, '...') }}</p>
                                <div class="mt-auto d-flex align-items-center justify-content-between gap-3">
                                    <span class="experience-price text-white fw-bold">R$ {{ number_format($experience->price, 2, ',', '.') }}</span>
                                    <a href="#" class="btn btn-sm btn-premium px-4">Ver agora</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="glass-card p-5 text-center">
                            <h3 class="text-white">Nenhuma experiência disponível ainda.</h3>
                            <p class="text-muted">Adicione experiências à base de dados para visualizar aqui.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="section-block py-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="highlight-card glass-card p-4">
                            <h4 class="text-white">Premium</h4>
                            <p class="text-muted">Conteúdos exclusivos com curadoria AGR Prime para usuários selecionados.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="highlight-card glass-card p-4">
                            <h4 class="text-white">Próximos eventos</h4>
                            <p class="text-muted">Eventos futuros, lives e aulas ao vivo com anfitriões renomados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.filter-pill');
        const cards = document.querySelectorAll('.experience-card-wrap');

        function setActive(button) {
            filterButtons.forEach((btn) => btn.classList.remove('active'));
            button.classList.add('active');
        }

        function filterCards(filter) {
            cards.forEach((card) => {
                const type = card.dataset.type;
                const format = card.dataset.format;
                const premium = card.dataset.premium;
                let show = false;

                if (filter === 'all') {
                    show = true;
                } else if (filter === 'premium') {
                    show = premium === 'premium';
                } else if (filter === 'online' || filter === 'presencial') {
                    show = format === filter;
                } else {
                    show = type === filter;
                }

                card.style.display = show ? 'block' : 'none';
                if (show) {
                    card.classList.add('fade-in');
                } else {
                    card.classList.remove('fade-in');
                }
            });
        }

        filterButtons.forEach((button) => {
            button.addEventListener('click', () => {
                setActive(button);
                filterCards(button.dataset.filter);
            });
        });
    });
</script>

@endsection
