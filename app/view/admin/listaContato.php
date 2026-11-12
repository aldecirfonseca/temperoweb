<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <!-- false: mensagens chegam pelo site, o admin não cadastra -->
    <?= cabecalho("Mensagens", "Contato", false) ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Mensagens recebidas pelo Fale conosco">
                <thead>
                    <tr>
                        <th scope="col">Recebida em</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col">Situação</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr class="<?= ($value['lido'] == 0 ? "fw-semibold" : "") ?>">
                                <td class="text-nowrap"><?= formatoData($value['dataCadastro'], true) ?></td>
                                <td><?= $value['nome'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><span class="d-inline-block text-truncate admin-resumo"><?= $value['mensagem'] ?></span></td>
                                <td>
                                    <?php if ($value['lido'] == 0): ?>
                                        <span class="status-badge is-pending">Nova</span>
                                    <?php else: ?>
                                        <span class="status-badge is-inactive">Lida</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end text-nowrap"><?= botoesAcao("Contato", $value['id'], $value['nome'], ["view", "delete"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-0 text-muted-tw">Nenhuma mensagem recebida ainda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
