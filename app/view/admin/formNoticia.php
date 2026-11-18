<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Notícia", "Noticia") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Noticia/<?= $action ?>"
            enctype="multipart/form-data" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão desta notícia não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="titulo" class="form-label">Título <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="titulo" id="titulo" maxlength="150"
                            value="<?= $dados['titulo'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe o título.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="blog_categoria_id" class="form-label">Categoria <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="blog_categoria_id" id="blog_categoria_id" required>
                            <option value="">Selecione</option>
                            <?php foreach ($aCategoriaBlog as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" <?= selected($dados['blog_categoria_id'] ?? "", $categoria['id']) ?>>
                                    <?= $categoria['descricao'] ?><?= ($categoria['statusRegistro'] == 2 ? " (inativa)" : "") ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Selecione a categoria.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dataPublicacao" class="form-label">Data de publicação <span class="req" aria-hidden="true">*</span></label>
                        <input type="date" class="form-control" name="dataPublicacao" id="dataPublicacao"
                            value="<?= $dados['dataPublicacao'] ?? date('Y-m-d') ?>" required aria-describedby="dataAjuda">
                        <div id="dataAjuda" class="form-text">Data futura: a notícia só aparece no site nesse dia.</div>
                        <div class="invalid-feedback">Informe a data de publicação.</div>
                    </div>
                    <div class="col-md-4">
                        <label for="statusRegistro" class="form-label">Status <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                            <option value="1" <?= selected($dados['statusRegistro'] ?? "1", "1") ?>>Ativo</option>
                            <option value="2" <?= selected($dados['statusRegistro'] ?? "1", "2") ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="resumo" class="form-label">Resumo <span class="req" aria-hidden="true">*</span></label>
                        <textarea class="form-control" name="resumo" id="resumo" rows="3" maxlength="255"
                            required><?= $dados['resumo'] ?? "" ?></textarea>
                        <div class="invalid-feedback">Escreva o resumo.</div>
                    </div>

                    <?php $pastaImagem = 'noticia'; require "app/view/admin/comuns/campoImagem.php"; ?>
                </div>
            </fieldset>

            <?php $programa = "Noticia"; $nomeRegistro = "notícia"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
