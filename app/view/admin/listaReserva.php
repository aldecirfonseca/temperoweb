<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?php
    // classe CSS do selo de cada situação
    $aClasseSituacao = [1 => "is-pending", 2 => "is-active", 3 => "is-inactive"];
?>

<div class="container admin-area">

    <?= cabecalho("Reservas", "Reserva") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de reservas">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Pessoas</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Situação</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr>
                                <td class="text-nowrap fw-semibold"><?= formatoData($value['data']) ?></td>
                                <td><?= $value['horario'] ?></td>
                                <td><?= $value['nome'] ?></td>
                                <td><?= $value['pessoas'] ?></td>
                                <td class="text-nowrap"><?= $value['telefone'] ?></td>
                                <td>
                                    <span class="status-badge <?= $aClasseSituacao[$value['situacao']] ?>">
                                        <?= $aSituacao[$value['situacao']] ?>
                                    </span>
                                </td>
                                <td class="text-end text-nowrap"><?= botoesAcao("Reserva", $value['id'], $value['nome']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-0 text-muted-tw">Nenhuma reserva recebida ainda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
