let pedido = [];
let total = 0;

function adicionarAoPedido(nome, preco) {
    pedido.push({ nome, preco });
    total += preco;
    atualizarPedido();
}

function atualizarPedido() {
    const listaPedido = document.getElementById("lista-pedido");
    const pedidoCount = document.getElementById("pedido-count");
    const totalPedido = document.getElementById("total-pedido");

    if (!listaPedido || !pedidoCount || !totalPedido) {
        return;
    }

    listaPedido.innerHTML = "";

    if (pedido.length === 0) {
        listaPedido.innerHTML =
            '<li class="list-group-item">Nenhum item adicionado ainda.</li>';
    } else {
        pedido.forEach((item, index) => {
            listaPedido.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span>${item.nome} - R$ ${item.preco.toFixed(2).replace(".", ",")}</span>
                    <button class="btn btn-sm btn-danger rounded-pill" onclick="removerItem(${index})">
                        Remover
                    </button>
                </li>
            `;
        });
    }

    pedidoCount.textContent = pedido.length;
    totalPedido.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
}

function removerItem(index) {
    total -= pedido[index].preco;
    pedido.splice(index, 1);
    atualizarPedido();
}

function finalizarPedidoWhatsapp() {
    if (pedido.length === 0) {
        alert("Adicione pelo menos um item ao pedido.");
        return;
    }

    let mensagem = "Olá, gostaria de finalizar este pedido:%0A%0A";

    pedido.forEach((item) => {
        mensagem += `- ${item.nome} - R$ ${item.preco.toFixed(2).replace(".", ",")}%0A`;
    });

    mensagem += `%0ATotal: R$ ${total.toFixed(2).replace(".", ",")}`;

    const numeroWhatsapp = "5511999999999";
    const url = `https://wa.me/${numeroWhatsapp}?text=${mensagem}`;

    window.open(url, "_blank");

    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".filter-btn");
        const items = document.querySelectorAll(".product-item");

        buttons.forEach((button) => {
            button.addEventListener("click", function () {
                const category = this.dataset.category;

                buttons.forEach((btn) => btn.classList.remove("active"));
                this.classList.add("active");

                items.forEach((item) => {
                    const itemCategory = item.dataset.category;

                    if (category === "all" || itemCategory === category) {
                        item.style.display = "";
                        item.style.opacity = "1";
                        item.style.transform = "scale(1)";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll(".filter-btn");
    const planButtons = document.querySelectorAll(".plan-btn");
    const items = document.querySelectorAll(".product-item");
    const currentPlanLabel = document.getElementById("current-plan-label");

    let currentCategory = "all";
    let currentPlan = "bronze";

    function formatBRL(value) {
        return Number(value).toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL",
        });
    }

    function getExclusiveBadge(item) {
        const bronze = item.dataset.bronzeEnabled === "1";
        const prata = item.dataset.prataEnabled === "1";
        const ouro = item.dataset.ouroEnabled === "1";
        const diamond = item.dataset.diamondEnabled === "1";

        if (diamond && !ouro && !prata && !bronze)
            return "🔒 Exclusivo Diamond";
        if (ouro && !prata && !bronze) return "🔒 Exclusivo Ouro";
        if (prata && !bronze) return "🔒 Exclusivo Prata+";

        return "";
    }

    function renderPrice(item) {
        const normalPrice = parseFloat(item.dataset.price || 0);
        const enabled = item.dataset[`${currentPlan}Enabled`] === "1";
        const specialPriceRaw = item.dataset[`${currentPlan}Price`];
        const specialPrice = specialPriceRaw
            ? parseFloat(specialPriceRaw)
            : normalPrice;

        const priceArea = item.querySelector(".product-price-area");
        const badge = item.querySelector(".product-exclusive-badge");

        const exclusiveText = getExclusiveBadge(item);
        if (exclusiveText) {
            badge.textContent = exclusiveText;
            badge.classList.remove("d-none");
        } else {
            badge.textContent = "";
            badge.classList.add("d-none");
        }

        if (!enabled) {
            item.style.display = "none";
            return false;
        }

        item.style.display = "";

        if (specialPrice < normalPrice) {
            const discount = Math.round(
                ((normalPrice - specialPrice) / normalPrice) * 100,
            );

            priceArea.innerHTML = `
                <p class="catalog-old-price">${formatBRL(normalPrice)}</p>
                <div class="catalog-price">${formatBRL(specialPrice)}</div>
                <span class="catalog-plan-badge">${discount}% OFF no plano ${currentPlan}</span>
            `;
        } else {
            priceArea.innerHTML = `
                <div class="catalog-price">${formatBRL(normalPrice)}</div>
            `;
        }

        return true;
    }

    function applyFilters() {
        currentPlanLabel.textContent = `Plano ${currentPlan}`;

        items.forEach((item) => {
            const itemCategory = item.dataset.category;

            const matchesCategory =
                currentCategory === "all" || itemCategory === currentCategory;
            const matchesPlan = renderPrice(item);

            if (matchesCategory && matchesPlan) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }

    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            categoryButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");
            currentCategory = this.dataset.category;
            applyFilters();
        });
    });

    planButtons.forEach((button) => {
        button.addEventListener("click", function () {
            planButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");
            currentPlan = this.dataset.plan;
            applyFilters();
        });
    });

    applyFilters();
});
