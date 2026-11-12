<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Usuário", "Usuario") ?>

    <div class="admin-card">
        <form class="needs-validation" method="POST" action="<?= baseUrl() ?>Usuario/<?= $action ?>" novalidate>

            <input type="hidden" name="id" value="<?= $dados['id'] ?? "" ?>">

            <?php if ($action == "delete"): ?>
                <div class="alert alert-danger d-flex gap-2 align-items-start" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    <div>Confira os dados abaixo. A exclusão deste usuário não poderá ser desfeita.</div>
                </div>
            <?php endif; ?>

            <fieldset <?= (in_array($action, ["view", "delete"]) ? "disabled" : "") ?>>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome <span class="req" aria-hidden="true">*</span></label>
                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100"
                            value="<?= $dados['nome'] ?? "" ?>" required autofocus>
                        <div class="invalid-feedback">Informe o nome.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail <span class="req" aria-hidden="true">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="150"
                            autocomplete="off" value="<?= $dados['email'] ?? "" ?>" required>
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                    </div>

                    <?php if (!in_array($action, ["view", "delete"])): ?>
                        <div class="col-md-4">
                            <label for="senha" class="form-label">
                                Senha <?= ($action == "insert" ? '<span class="req" aria-hidden="true">*</span>' : '') ?>
                            </label>
                            <!-- a senha nunca volta para o formulário: só se digita uma nova -->
                            <input type="password" class="form-control" name="senha" id="senha" minlength="6"
                                autocomplete="new-password" aria-describedby="senhaAjuda"
                                <?= ($action == "insert" ? "required" : "") ?>>
                            <div id="senhaAjuda" class="form-text">
                                <?= ($action == "insert" ? "Mínimo de 6 caracteres." : "Deixe em branco para manter a senha atual.") ?>
                            </div>
                            <div class="invalid-feedback">A senha precisa ter pelo menos 6 caracteres.</div>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-4">
                        <label for="nivel" class="form-label">Nível <span class="req" aria-hidden="true">*</span></label>
                        <select class="form-select" name="nivel" id="nivel" required>
                            <?php foreach ($aNivel as $codigo => $rotulo): ?>
                                <option value="<?= $codigo ?>" <?= selected($dados['nivel'] ?? "2", $codigo) ?>><?= $rotulo ?></option>
                            <?php endforeach; ?>
                        </select>
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

            <?php $programa = "Usuario"; $nomeRegistro = "usuário"; require "app/view/admin/comuns/botoesFormulario.php"; ?>

        </form>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
