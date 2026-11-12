<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Trocar a senha", "Senha", false) ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Senha/update" novalidate>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="senhaAtual" class="form-label">Senha atual <span class="req" aria-hidden="true">*</span></label>
                    <input type="password" class="form-control" name="senhaAtual" id="senhaAtual"
                        autocomplete="current-password" required autofocus>
                    <div class="invalid-feedback">Informe a senha atual.</div>
                </div>
                <div class="col-md-4">
                    <label for="novaSenha" class="form-label">Nova senha <span class="req" aria-hidden="true">*</span></label>
                    <input type="password" class="form-control" name="novaSenha" id="novaSenha"
                        autocomplete="new-password" minlength="6" required aria-describedby="novaSenhaAjuda">
                    <div id="novaSenhaAjuda" class="form-text">Mínimo de 6 caracteres.</div>
                    <div class="invalid-feedback">A nova senha precisa ter pelo menos 6 caracteres.</div>
                </div>
                <div class="col-md-4">
                    <label for="confirmaSenha" class="form-label">Confirme a nova senha <span class="req" aria-hidden="true">*</span></label>
                    <input type="password" class="form-control" name="confirmaSenha" id="confirmaSenha"
                        autocomplete="new-password" minlength="6" required>
                    <div class="invalid-feedback">Repita a nova senha.</div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg" aria-hidden="true"></i>Alterar senha</button>
            </div>
        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
