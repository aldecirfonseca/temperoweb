<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Reserva", "Reserva") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Reserva/<?= $action ?>" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão desta reserva não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <?php if (isset($dados['dataCadastro'])): ?>
                <p class="text-muted-tw">Recebida em <?= formatoData($dados['dataCadastro'], true) ?></p>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100"
                            value="<?= $dados['nome'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe o nome.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">E-mail <span class="req" aria-hidden="true">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="150"
                            value="<?= $dados['email'] ?? "" ?>" required>
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="telefone" class="form-label">Telefone <span class="req" aria-hidden="true">*</span></label>
                        <input type="tel" class="form-control" name="telefone" id="telefone" data-mascara="telefone"
                            value="<?= $dados['telefone'] ?? "" ?>" required>
                        <div class="invalid-feedback">Informe o telefone.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="data" class="form-label">Data <span class="req" aria-hidden="true">*</span></label>
                        <input type="date" class="form-control" name="data" id="data"
                            value="<?= $dados['data'] ?? "" ?>" required>
                        <div class="invalid-feedback">Informe a data.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="horario" class="form-label">Horário <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="horario" id="horario" required>
                            <option value="">Selecione</option>
                            <?php foreach ($aHorario as $horario): ?>
                                <option value="<?= $horario ?>" <?= selected($dados['horario'] ?? "", $horario) ?>><?= $horario ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Escolha o horário.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="pessoas" class="form-label">Pessoas <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="pessoas" id="pessoas" required>
                            <option value="">Selecione</option>
                            <?php for ($i = 1; $i <= $maximoPessoas; $i++): ?>
                                <option value="<?= $i ?>" <?= selected($dados['pessoas'] ?? "", $i) ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback">Informe a quantidade de pessoas.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="situacao" class="form-label">Situação <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="situacao" id="situacao" required>
                            <?php foreach ($aSituacao as $codigo => $rotulo): ?>
                                <option value="<?= $codigo ?>" <?= selected($dados['situacao'] ?? "1", $codigo) ?>><?= $rotulo ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="observacao" class="form-label">Observações</label>
                        <textarea class="form-control" name="observacao" id="observacao" rows="3"><?= $dados['observacao'] ?? "" ?></textarea>
                    </div>
                </div>
            </fieldset>

            <?php $programa = "Reserva"; $nomeRegistro = "reserva"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
