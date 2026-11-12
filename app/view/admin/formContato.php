<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Mensagem", "Contato", false) ?>

    <div class="admin-card">
        <form method="POST" action="<?= baseUrl() ?>Contato/delete">

            <input type="hidden" name="id" value="<?= $dados['id'] ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão desta mensagem não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <dl class="row mb-0">
                <dt class="col-sm-3">Recebida em</dt>
                <dd class="col-sm-9"><?= formatoData($dados['dataCadastro'], true) ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?= $dados['nome'] ?></dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><a href="mailto:<?= $dados['email'] ?>"><?= $dados['email'] ?></a></dd>

                <dt class="col-sm-3">Telefone</dt>
                <dd class="col-sm-9"><?= ($dados['telefone'] != "" ? $dados['telefone'] : "Não informado") ?></dd>

                <dt class="col-sm-3">Mensagem</dt>
                <!-- nl2br depois do escape: mantém as quebras de linha sem liberar HTML -->
                <dd class="col-sm-9"><?= nl2br($dados['mensagem']) ?></dd>
            </dl>

            <?php $programa = "Contato"; $nomeRegistro = "mensagem"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
