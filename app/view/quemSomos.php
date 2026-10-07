<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Quem somos", "Uma cozinha de portas abertas no coração de Muriaé.") ?>

<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <div class="media-stack">
                    <img src="<?= baseUrl() ?>assets/img/home/about-img1.png" width="390" height="414"
                        alt="Garçom servindo salada e bruschettas no salão do restaurante">
                    <img src="<?= baseUrl() ?>assets/img/home/about-img2.png" width="263" height="294" alt="">
                </div>
            </div>

            <div class="col-lg-6 reveal">
                <span class="eyebrow">Nossa história</span>
                <h2 class="section-title">Nós falamos a linguagem da boa comida</h2>
                <p class="section-lead">
                    Inaugurado em 2015, o <strong>Tempero Web</strong> está localizado no centro de Muriaé e
                    é referência pela qualidade no atendimento e pelo extenso buffet de comidas quentes,
                    saladas e lanches.
                </p>
                <p class="text-muted-tw">
                    Estamos abertos a reservas para eventos em qualquer dia da semana. Aos domingos,
                    sofisticamos os pratos com uma cozinha mediterrânea, com direito a paella,
                    antepastos e uma grande variedade de pratos quentes.
                </p>

                <div class="row g-4 mt-2">
                    <div class="col-4">
                        <div class="stat">2015</div>
                        <div class="stat-label">ano de inauguração</div>
                    </div>
                    <div class="col-4">
                        <div class="stat">7</div>
                        <div class="stat-label">dias com reservas para eventos</div>
                    </div>
                    <div class="col-4">
                        <div class="stat">3</div>
                        <div class="stat-label">chefs executivos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-head text-center">
            <span class="eyebrow">Nossos valores</span>
            <h2 class="section-title">O que nos move</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-basket"></i></span>
                    <div>
                        <h3>Frescor</h3>
                        <p>Ingredientes selecionados e preparados no mesmo dia.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-emoji-smile"></i></span>
                    <div>
                        <h3>Acolhimento</h3>
                        <p>Atendimento atencioso, do primeiro contato à sobremesa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature">
                    <span class="icon-circle" aria-hidden="true"><i class="bi bi-fire"></i></span>
                    <div>
                        <h3>Tradição</h3>
                        <p>Receitas da casa que atravessam gerações, com um toque moderno.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
