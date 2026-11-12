<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Usuários", "Usuario") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de usuários do admin">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $value): ?>
                        <tr>
                            <td class="fw-semibold"><?= $value['nome'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $aNivel[$value['nivel']] ?></td>
                            <td><?= badgeStatus($value['statusRegistro']) ?></td>
                            <td class="text-end text-nowrap"><?= botoesAcao("Usuario", $value['id'], $value['nome']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
