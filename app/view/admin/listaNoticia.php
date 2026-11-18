<?php require_once "app/view/comuns/cabecalho.php"; ?>

<div class="container admin-area">

    <?= cabecalho("Notícias", "Noticia") ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover" aria-label="Lista de notícias do blog">
                <thead>
                    <tr>
                        <th scope="col">Imagem</th>
                        <th scope="col">Publicação</th>
                        <th scope="col">Título</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): ?>
                        <?php foreach ($rows as $value): ?>
                            <tr>
                                <td><img src="<?= imagemUrl($value['imagem'], 'noticia') ?>" class="admin-thumb" width="48" height="48" alt=""></td>
                                <td class="text-nowrap"><?= formatoData($value['dataPublicacao']) ?></td>
                                <td class="fw-semibold"><?= $value['titulo'] ?></td>
                                <td><?= $value['categoria'] ?></td>
                                <td><?= badgeStatus($value['statusRegistro']) ?></td>
                                <td class="text-end text-nowrap"><?= botoesAcao("Noticia", $value['id'], $value['titulo']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted-tw" aria-hidden="true"></i>
                                <p class="mb-3 text-muted-tw">Nenhuma notícia cadastrada ainda.</p>
                                <a href="<?= baseUrl() ?>Noticia/form/insert" class="btn btn-primary btn-sm">
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
