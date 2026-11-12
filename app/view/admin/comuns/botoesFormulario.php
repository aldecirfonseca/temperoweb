<?php
/*
 * Rodapé dos formulários do admin.
 * Antes do require, a view define:
 *   $programa      nome do controller (ex.: 'Produto')
 *   $nomeRegistro  texto do botão de exclusão (ex.: 'produto')
 */
?>
<div class="d-flex flex-wrap gap-2 justify-content-end mt-4 pt-3 border-top">
    <a href="<?= baseUrl() . $programa ?>" class="btn btn-outline-secondary"><?= ($action == "view" ? "Voltar" : "Cancelar") ?></a>
    <?php if ($action == "delete"): ?>
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash" aria-hidden="true"></i>Excluir <?= $nomeRegistro ?></button>
    <?php elseif ($action != "view"): ?>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg" aria-hidden="true"></i>Gravar</button>
    <?php endif; ?>
</div>
