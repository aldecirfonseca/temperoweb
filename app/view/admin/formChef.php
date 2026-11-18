<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Chef", "Chef") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Chef/<?= $action ?>"
            enctype="multipart/form-data" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão deste chef não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="nome" class="form-label">Nome <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100"
                            value="<?= $dados['nome'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe o nome.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="cargo" class="form-label">Cargo <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="cargo" id="cargo" maxlength="60"
                            placeholder="Ex.: Chef executivo" value="<?= $dados['cargo'] ?? "" ?>" required>
                        <div class="invalid-feedback">Informe o cargo.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="statusRegistro" class="form-label">Status <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                            <option value="1" <?= selected($dados['statusRegistro'] ?? "1", "1") ?>>Ativo</option>
                            <option value="2" <?= selected($dados['statusRegistro'] ?? "1", "2") ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="bio" class="form-label">Apresentação <span class="req" aria-hidden="true">*</span></label>
                        <textarea class="form-control" name="bio" id="bio" rows="3" maxlength="255"
                            required><?= $dados['bio'] ?? "" ?></textarea>
                        <div class="invalid-feedback">Escreva uma breve apresentação.</div>
                    </div>

                    <?php $pastaImagem = 'chef'; require "app/view/admin/comuns/campoImagem.php"; ?>
                </div>
            </fieldset>

            <?php $programa = "Chef"; $nomeRegistro = "chef"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
