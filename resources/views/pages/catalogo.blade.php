@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="text-white fw-bold mb-1">Catálogo AGR</h2>
            <p class="text-white-50 mb-0">
                Confira os produtos e visualize os benefícios por plano.
            </p>
        </div>

        <span class="client-plan-badge text-uppercase" id="current-plan-label">
            Plano {{ $planoCliente }}
        </span>
    </div>

    <div class="catalog-toolbar mb-4">
        <div class="catalog-filters">
            <button class="filter-btn active" data-category="all">Todos</button>
            <button class="filter-btn" data-category="Toxinas">Toxinas</button>
            <button class="filter-btn" data-category="Preenchedores">Preenchedores</button>
            <button class="filter-btn" data-category="Bioestimuladores">Bioestimuladores</button>
            <button class="filter-btn" data-category="Skinboosters">Skinboosters</button>
        </div>

        <div class="plan-filters">
            <button class="plan-btn bronze-btn" data-plan="bronze">Bronze</button>
            <button class="plan-btn prata-btn active" data-plan="prata">Prata</button>
            <button class="plan-btn ouro-btn" data-plan="ouro">Ouro</button>
            <button class="plan-btn diamond-btn" data-plan="diamond">Diamond</button>
        </div>
    </div>

    <div class="row g-4" id="catalog-grid">
        @foreach($products as $product)
            <div
                class="col-12 col-sm-6 col-lg-3 product-item"
                data-category="{{ $product->category }}"
                data-price="{{ $product->price }}"
                data-bronze-enabled="{{ $product->bronze_enabled }}"
                data-prata-enabled="{{ $product->prata_enabled }}"
                data-ouro-enabled="{{ $product->ouro_enabled }}"
                data-diamond-enabled="{{ $product->diamond_enabled }}"
                data-bronze-price="{{ $product->bronze_price }}"
                data-prata-price="{{ $product->prata_price }}"
                data-ouro-price="{{ $product->ouro_price }}"
                data-diamond-price="{{ $product->diamond_price }}"
            >
                <div class="catalog-card h-100">
                    <div class="catalog-image-wrap">
                        <img
                            src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/500x320?text=Produto+AGR' }}"
                            alt="{{ $product->name }}"
                            class="catalog-image"
                        >
                    </div>

                    <div class="catalog-body">
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="catalog-tag">{{ $product->category }}</span>

                            @if($product->bronze_enabled)
                                <span class="exclusive-tag bronze-label">Bronze</span>
                            @endif

                            @if($product->prata_enabled)
                                <span class="exclusive-tag prata-label">Prata</span>
                            @endif

                            @if($product->ouro_enabled)
                                <span class="exclusive-tag ouro-label">Ouro</span>
                            @endif

                            @if($product->diamond_enabled)
                                <span class="exclusive-tag diamond-label">Diamond</span>
                            @endif
                        </div>

                        <h5 class="catalog-title">{{ $product->name }}</h5>

                        @if(!empty($product->description))
                            <p class="catalog-description">{{ $product->description }}</p>
                        @endif

                        <div class="product-price-area"></div>

                        @php
                            $telefone = '5511999999999';
                            $mensagem = "Olá, tenho interesse no produto {$product->name}.";
                            $linkWhatsapp = "https://wa.me/{$telefone}?text=" . urlencode($mensagem);
                        @endphp

                        <a href="{{ $linkWhatsapp }}" target="_blank" class="catalog-button mt-3">
                            Saiba mais
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.filter-btn');
    const planButtons = document.querySelectorAll('.plan-btn');
    const items = document.querySelectorAll('.product-item');
    const currentPlanLabel = document.getElementById('current-plan-label');

    let selectedCategory = 'all';
    let selectedPlan = 'prata';

    function formatBRL(value) {
        return Number(value).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    function renderPrice(item) {
        const normalPrice = parseFloat(item.dataset.price || 0);
        const enabled = item.dataset[selectedPlan + 'Enabled'] === '1';
        const specialPriceRaw = item.dataset[selectedPlan + 'Price'];
        const specialPrice = specialPriceRaw ? parseFloat(specialPriceRaw) : normalPrice;
        const priceArea = item.querySelector('.product-price-area');

        if (!enabled) {
            return false;
        }

        if (specialPrice < normalPrice) {
            const discount = Math.round(((normalPrice - specialPrice) / normalPrice) * 100);

            priceArea.innerHTML = `
                <p class="catalog-old-price">${formatBRL(normalPrice)}</p>
                <div class="catalog-price">${formatBRL(specialPrice)}</div>
                <span class="catalog-plan-badge">${discount}% OFF no plano ${selectedPlan}</span>
            `;
        } else {
            priceArea.innerHTML = `
                <div class="catalog-price">${formatBRL(normalPrice)}</div>
            `;
        }

        return true;
    }

    function applyFilters() {
        currentPlanLabel.textContent = `Plano ${selectedPlan}`;

        items.forEach(item => {
            const category = item.dataset.category;
            const categoryMatch = selectedCategory === 'all' || category === selectedCategory;
            const planMatch = renderPrice(item);

            item.style.display = categoryMatch && planMatch ? 'block' : 'none';
        });
    }

    categoryButtons.forEach(button => {
        button.addEventListener('click', function () {
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            selectedCategory = this.dataset.category;
            applyFilters();
        });
    });

    planButtons.forEach(button => {
        button.addEventListener('click', function () {
            planButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            selectedPlan = this.dataset.plan;
            applyFilters();
        });
    });

    applyFilters();
});
</script>
@endsection