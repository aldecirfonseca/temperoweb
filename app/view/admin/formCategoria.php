<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Categoria", "Categoria") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Categoria/<?= $action ?>" novalidate>

            <input type="hidden" name="id" id="id"
                value="<?= (isset($dados['id']) ? $dados['id'] : "") ?>">

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
                        <input type="text" class="form-control"
                            name="descricao" id="descricao"
                            placeholder="Ex.: Bebidas"
                            value="<?= (isset($dados['descricao']) ? $dados['descricao'] : "") ?>"
                            required autofocus>
                        <div class="invalid-feedback">Informe a descrição da categoria.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="statusRegistro" class="form-label">Status <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                            <option <?= (isset($dados['statusRegistro']) ? ($dados['statusRegistro'] == ""  ? "selected" : "") : "") ?> value="">Selecione</option>
                            <option <?= (isset($dados['statusRegistro']) ? ($dados['statusRegistro'] == "1" ? "selected" : "") : "") ?> value="1">Ativo</option>
                            <option <?= (isset($dados['statusRegistro']) ? ($dados['statusRegistro'] == "2" ? "selected" : "") : "") ?> value="2">Inativo</option>
                        </select>
                        <div class="invalid-feedback">Selecione o status.</div>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex flex-wrap gap-2 justify-content-end mt-4 pt-3 border-top">
                <a href="<?= baseUrl() ?>Categoria" class="btn btn-outline-secondary">Cancelar</a>
                <?php if ($action == "delete"): ?>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash" aria-hidden="true"></i>Excluir categoria</button>
                <?php elseif ($action != "view"): ?>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg" aria-hidden="true"></i>Gravar</button>
                <?php endif; ?>
            </div>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
