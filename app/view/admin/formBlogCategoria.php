<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Categoria do blog", "BlogCategoria") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>BlogCategoria/<?= $action ?>" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão desta categoria não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="descricao" class="form-label">Descrição <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100"
                            placeholder="Ex.: Receitas" value="<?= $dados['descricao'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe a descrição da categoria.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="statusRegistro" class="form-label">Status <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                            <option value="1" <?= selected($dados['statusRegistro'] ?? "1", "1") ?>>Ativo</option>
                            <option value="2" <?= selected($dados['statusRegistro'] ?? "1", "2") ?>>Inativo</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <?php $programa = "BlogCategoria"; $nomeRegistro = "categoria"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
