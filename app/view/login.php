<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Entrar", "Acesso restrito à equipe do Tempero Web.") ?>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="form-card">
                    <h2 class="h3 mb-4">Área administrativa</h2>

                    <?= mensagens() ?>

                    <form class="needs-validation" action="<?= baseUrl() ?>Login/entrar" method="post" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail <span class="req" aria-hidden="true">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="username" required autofocus>
                            <div class="invalid-feedback">Informe o seu e-mail.</div>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha <span class="req" aria-hidden="true">*</span></label>
                            <input type="password" class="form-control" id="senha" name="senha" autocomplete="current-password" required>
                            <div class="invalid-feedback">Informe a sua senha.</div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
