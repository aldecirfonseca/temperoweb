<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Categorias", "Categoria") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de categorias cadastradas">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr>
                                <td class="text-muted-tw"><?= $value['id'] ?></td>
                                <td class="fw-semibold"><?= $value['descricao'] ?></td>
                                <td>
                                    <?php if ($value['statusRegistro'] == 1): ?>
                                        <span class="status-badge is-active">Ativo</span>
                                    <?php else: ?>
                                        <span class="status-badge is-inactive">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="<?= baseUrl() ?>Categoria/form/view/<?= $value['id'] ?>" class="btn btn-sm btn-outline-secondary"
                                        title="Visualizar" aria-label="Visualizar <?= $value['descricao'] ?>"><i class="bi bi-eye" aria-hidden="true"></i></a>
                                    <a href="<?= baseUrl() ?>Categoria/form/update/<?= $value['id'] ?>" class="btn btn-sm btn-outline-primary"
                                        title="Alterar" aria-label="Alterar <?= $value['descricao'] ?>"><i class="bi bi-pencil" aria-hidden="true"></i></a>
                                    <a href="<?= baseUrl() ?>Categoria/form/delete/<?= $value['id'] ?>" class="btn btn-sm btn-outline-danger"
                                        title="Excluir" aria-label="Excluir <?= $value['descricao'] ?>"><i class="bi bi-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-3 text-muted-tw">Nenhuma categoria cadastrada ainda.</p>
                                <a href="<?= baseUrl() ?>Categoria/form/insert" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg" aria-hidden="true"></i>Cadastrar a primeira
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
