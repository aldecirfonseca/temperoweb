<?php
/*
 * Campo de imagem dos formulários do admin (Produto, Chef, Notícia).
 * Antes do require, a view define $pastaImagem (ex.: 'produto').
 * O <form> precisa de enctype="multipart/form-data" para enviar arquivos.
 */
$imagemAtual = $dados['imagem'] ?? null;
?>
<div class="col-12">
    <span class="form-label d-block">Imagem</span>
    <div class="d-flex flex-wrap align-items-start gap-3">
        <img src="<?= imagemUrl($imagemAtual, $pastaImagem) ?>" class="form-thumb" width="120" height="120"
            alt="<?= (empty($imagemAtual) ? 'Sem imagem cadastrada' : 'Imagem atual') ?>">

        <?php if (!in_array($action, ["view", "delete"])): ?>
            <div class="flex-grow-1">
                <label for="imagem" class="visually-hidden">Escolher imagem</label>
                <input type="file" class="form-control" name="imagem" id="imagem"
                    accept="image/jpeg,image/png,image/webp" aria-describedby="imagemAjuda">
                <div id="imagemAjuda" class="form-text">
                    JPG, PNG ou WEBP de até 2 MB.
                    <?= (empty($imagemAtual) ? '' : 'Deixe em branco para manter a imagem atual.') ?>
                </div>

                <?php if (!empty($imagemAtual)): ?>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="removerImagem" id="removerImagem" value="1">
                        <label class="form-check-label" for="removerImagem">Remover a imagem atual</label>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
