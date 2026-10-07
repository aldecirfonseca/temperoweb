<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Nossos chefs", "Talento e experiência à sua disposição.") ?>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($aChef as $chef): ?>
                <div class="col-md-6 col-lg-4 reveal">
                    <article class="tw-card chef-card">
                        <div class="tw-card-media">
                            <img src="<?= baseUrl() ?>assets/img/home/<?= $chef['imagem'] ?>" width="360" height="420"
                                alt="Foto de <?= $chef['nome'] ?>" loading="lazy">
                        </div>
                        <div class="tw-card-body">
                            <h3><?= $chef['nome'] ?></h3>
                            <p class="chef-role"><?= $chef['cargo'] ?></p>
                            <p><?= $chef['bio'] ?></p>
                            <ul class="social-links">
                                <li><a href="#" aria-label="Instagram de <?= $chef['nome'] ?>"><i class="bi bi-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#" aria-label="Facebook de <?= $chef['nome'] ?>"><i class="bi bi-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" aria-label="LinkedIn de <?= $chef['nome'] ?>"><i class="bi bi-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
