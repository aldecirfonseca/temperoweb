<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Chefs", "Chef") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de chefs cadastrados">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr>
                                <td><img src="<?= imagemUrl($value['imagem'], 'chef') ?>" class="admin-thumb" width="48" height="48" alt=""></td>
                                <td class="fw-semibold"><?= $value['nome'] ?></td>
                                <td><?= $value['cargo'] ?></td>
                                <td><?= badgeStatus($value['statusRegistro']) ?></td>
                                <td class="text-end text-nowrap"><?= botoesAcao("Chef", $value['id'], $value['nome']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-3 text-muted-tw">Nenhum chef cadastrado ainda.</p>
                                <a href="<?= baseUrl() ?>Chef/form/insert" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg" aria-hidden="true"></i>Cadastrar o primeiro
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once "app/view/comuns/rodape.php"; ?>
