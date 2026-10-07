<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Cardápio", "Pratos preparados na hora, com ingredientes frescos e preço justo.") ?>

<!-- Pratos em destaque -->
<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Comida em destaque</span>
            <h2 class="section-title mb-0">Os favoritos da casa</h2>
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
                            <p class="mb-0"><?= $prato['descricao'] ?></p>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Cardápio completo -->
<section class="section section-alt">
    <div class="container">
        <div class="section-head text-center">
            <span class="eyebrow">Cardápio completo</span>
            <h2 class="section-title">Comida deliciosa</h2>
            <p class="section-lead">Valores por pessoa. Consulte opções vegetarianas e sem glúten com nossa equipe.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php foreach ($aCardapio as $grupo => $aItem): ?>
                    <div class="menu-group reveal">
                        <h3 class="menu-group-title"><?= $grupo ?></h3>
                        <?php foreach ($aItem as $item): ?>
                            <div class="menu-item">
                                <div class="menu-item-head">
                                    <h4 class="menu-item-name">
                                        <?= $item['nome'] ?>
                                        <?php if ($item['destaque']): ?>
                                            <span class="badge-tw ms-1">Recomendado</span>
                                        <?php endif; ?>
                                    </h4>
                                    <span class="price">R$ <?= formatoValor($item['preco']) ?></span>
                                </div>
                                <p><?= $item['descricao'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <div class="text-center mt-5">
                    <a class="btn btn-primary btn-lg" href="<?= baseUrl() ?>Home/reserva">
                        <i class="bi bi-calendar-check" aria-hidden="true"></i>Reservar mesa
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
