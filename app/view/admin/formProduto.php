<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Produto", "Produto") ?>

    <div class="admin-card">
        <!-- enctype="multipart/form-data": obrigatório para enviar arquivos ($_FILES) -->
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Produto/<?= $action ?>"
            enctype="multipart/form-data" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão deste produto não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100"
                            placeholder="Ex.: Pizza Vegetariana" value="<?= $dados['nome'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe o nome do produto.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="categoria_id" class="form-label">Categoria <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="categoria_id" id="categoria_id" required>
                            <option value="">Selecione</option>
                            <?php foreach ($aCategoria as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" <?= selected($dados['categoria_id'] ?? "", $categoria['id']) ?>>
                                    <?= $categoria['descricao'] ?><?= ($categoria['statusRegistro'] == 2 ? " (inativa)" : "") ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Selecione a categoria.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="preco" class="form-label">Preço (R$) <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="preco" id="preco" inputmode="decimal"
                            data-mascara="valor" placeholder="0,00"
                            value="<?= (isset($dados['preco']) ? formatoValor($dados['preco']) : "") ?>" required>
                        <div class="invalid-feedback">Informe o preço.</div>
                    </div>
                    <div class="col-12">
                        <label for="descricao" class="form-label">Descrição <span class="req" aria-hidden="true">*</span></label>
                        <textarea class="form-control" name="descricao" id="descricao" rows="2" maxlength="255"
                            required><?= $dados['descricao'] ?? "" ?></textarea>
                        <div class="invalid-feedback">Informe a descrição.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="tag" class="form-label">Selo</label>
                        <input type="text" class="form-control" name="tag" id="tag" maxlength="30"
                            placeholder="Ex.: Novidade" value="<?= $dados['tag'] ?? "" ?>" aria-describedby="tagAjuda">
                        <div id="tagAjuda" class="form-text">Aparece sobre a foto nos destaques.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="destaque" class="form-label">Destaque <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="destaque" id="destaque" required aria-describedby="destaqueAjuda">
                            <option value="0" <?= selected($dados['destaque'] ?? "0", "0") ?>>Não</option>
                            <option value="1" <?= selected($dados['destaque'] ?? "0", "1") ?>>Sim</option>
                        </select>
                        <div id="destaqueAjuda" class="form-text">Com imagem, aparece na home.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="statusRegistro" class="form-label">Status <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                            <option value="1" <?= selected($dados['statusRegistro'] ?? "1", "1") ?>>Ativo</option>
                            <option value="2" <?= selected($dados['statusRegistro'] ?? "1", "2") ?>>Inativo</option>
                        </select>
                    </div>

                    <?php $pastaImagem = 'produto'; require "app/view/admin/comuns/campoImagem.php"; ?>
                </div>
            </fieldset>

            <?php $programa = "Produto"; $nomeRegistro = "produto"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
