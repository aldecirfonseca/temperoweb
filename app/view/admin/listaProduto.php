<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Produtos", "Produto") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de produtos cadastrados">
                <thead>
                    <tr>
                        <th scope="col">Imagem</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Categoria</th>
                        <th scope="col" class="text-end">Preço</th>
                        <th scope="col">Destaque</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr>
                                <td><img src="<?= imagemUrl($value['imagem'], 'produto') ?>" class="admin-thumb" width="48" height="48" alt=""></td>
                                <td class="fw-semibold"><?= $value['nome'] ?></td>
                                <td><?= $value['categoria'] ?></td>
                                <td class="text-end text-nowrap">R$ <?= formatoValor($value['preco']) ?></td>
                                <td><?= ($value['destaque'] == 1 ? '<span class="badge-tw">Sim</span>' : 'Não') ?></td>
                                <td><?= badgeStatus($value['statusRegistro']) ?></td>
                                <td class="text-end text-nowrap"><?= botoesAcao("Produto", $value['id'], $value['nome']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-3 text-muted-tw">Nenhum produto cadastrado ainda.</p>
                                <a href="<?= baseUrl() ?>Produto/form/insert" class="btn btn-primary btn-sm">
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
