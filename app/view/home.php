<?php require_once "app/view/comuns/cabecalho.php"; ?>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow">Restaurante em Muriaé</span>
                <h1 class="hero-title">Servimos os alimentos <em>mais saborosos</em> da cidade</h1>
                <p class="hero-lead">
                    Ingredientes frescos, receitas feitas com carinho e um ambiente acolhedor
                    para o seu almoço, jantar ou evento especial.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-primary btn-lg" href="<?= baseUrl() ?>Home/reserva">
                        <i class="bi bi-calendar-check" aria-hidden="true"></i>Reservar mesa
                    </a>
                    <a class="btn btn-outline-primary btn-lg" href="<?= baseUrl() ?>Home/menu">
                        Ver cardápio<i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-media">
                    <img src="<?= baseUrl() ?>assets/img/banner/hero-banner1.png" width="825" height="900"
                        alt="Torrada com abacate em formato de rosa e ovo frito servidos em prato branco"
                        fetchpriority="high">
                    <div class="hero-badge">
                        <span class="icon-circle is-accent" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                        <div>
                            <strong>Comida fresca</strong>
                            <span>preparada todos os dias</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diferenciais -->
<section class="section-alt py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-bicycle"></i></span>
                    <div>
                        <h3>Entrega rápida</h3>
                        <p>Seu pedido chega quentinho, do nosso forno até a sua mesa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-basket"></i></span>
                    <div>
                        <h3>Ingredientes frescos</h3>
                        <p>Trabalhamos com fornecedores locais e produtos selecionados.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-balloon-heart"></i></span>
                    <div>
                        <h3>Eventos e reservas</h3>
                        <p>Espaço preparado para celebrações em qualquer dia da semana.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pratos em destaque -->
<section class="section">
    <div class="container">
        <div class="section-head d-md-flex justify-content-between align-items-end gap-4">
            <div>
                <span class="eyebrow">Comida em destaque</span>
                <h2 class="section-title mb-0">Sabor fresco e ótimo preço</h2>
            </div>
            <a class="btn btn-outline-primary mt-3 mt-md-0 flex-shrink-0" href="<?= baseUrl() ?>Home/menu">
                Cardápio completo<i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($aDestaque as $prato): ?>
                <div class="col-md-6 col-lg-4 reveal">
                    <article class="tw-card">
                        <div class="tw-card-media">
                            <img src="<?= baseUrl() ?>assets/img/home/<?= $prato['imagem'] ?>" width="360" height="355"
                                alt="<?= $prato['nome'] ?>" loading="lazy">
                            <span class="tag"><?= $prato['tag'] ?></span>
                        </div>
                        <div class="tw-card-body">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <h3><?= $prato['nome'] ?></h3>
                                <span class="price">R$ <?= formatoValor($prato['preco']) ?></span>
                            </div>
                            <p><?= $prato['descricao'] ?></p>
                            <div class="rating" role="img" aria-label="Avaliação 5 de 5">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sobre (resumo) -->
<section class="section section-alt">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <div class="media-stack">
                    <img src="<?= baseUrl() ?>assets/img/home/about-img1.png" width="390" height="414"
                        alt="Garçom servindo salada e bruschettas no salão do restaurante" loading="lazy">
                    <img src="<?= baseUrl() ?>assets/img/home/about-img2.png" width="263" height="294"
                        alt="" loading="lazy">
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <span class="eyebrow">Quem somos</span>
                <h2 class="section-title">Nós falamos a linguagem da boa comida</h2>
                <p class="section-lead">
                    Desde 2015 no centro de Muriaé, somos referência pela qualidade no atendimento
                    e pelo buffet variado de comidas quentes, saladas e lanches.
                </p>
                <a class="btn btn-outline-primary mt-2" href="<?= baseUrl() ?>Home/quemSomos">
                    Conheça nossa história<i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Chamada para reserva -->
<section class="section">
    <div class="container">
        <div class="cta-band reveal">
            <span class="eyebrow">Reservas abertas</span>
            <h2>Garanta sua mesa para hoje</h2>
            <p class="mb-4">Reserve em menos de um minuto e chegue sem filas. Atendemos também eventos e confraternizações.</p>
            <a class="btn btn-primary btn-lg" href="<?= baseUrl() ?>Home/reserva">
                <i class="bi bi-calendar-check" aria-hidden="true"></i>Reservar mesa
            </a>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
