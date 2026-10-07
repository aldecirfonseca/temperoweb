<?php require_once "app/view/comuns/cabecalho.php"; ?>

<?= tituloPagina("Blog", "Receitas, bastidores e novidades da nossa cozinha.") ?>

<section class="section">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-8">
                <div class="row g-4">
                    <?php foreach ($aNoticia as $noticia): ?>
                        <div class="col-md-6 reveal">
                            <article class="tw-card post-card">
                                <div class="tw-card-media">
                                    <img src="<?= baseUrl() ?>assets/img/blog/main-blog/<?= $noticia['imagem'] ?>"
                                        alt="" loading="lazy">
                                    <time class="post-date">
                                        <strong><?= $noticia['dia'] ?></strong>
                                        <span><?= $noticia['mes'] ?></span>
                                    </time>
                                </div>
                                <div class="tw-card-body">
                                    <h2><a href="#"><?= $noticia['titulo'] ?></a></h2>
                                    <p><?= $noticia['resumo'] ?></p>
                                    <ul class="post-meta">
                                        <li><i class="bi bi-tag me-1" aria-hidden="true"></i><?= $noticia['categoria'] ?></li>
                                        <li><i class="bi bi-chat me-1" aria-hidden="true"></i><?= $noticia['comentarios'] ?> comentários</li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <nav class="mt-5" aria-label="Paginação do blog">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Página anterior">
                                <i class="bi bi-chevron-left" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#" aria-current="page">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Próxima página">
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <aside class="col-lg-4" aria-label="Barra lateral do blog">
                <div class="sidebar-widget">
                    <h2>Pesquisar</h2>
                    <form action="#" role="search">
                        <label for="pesquisaBlog" class="visually-hidden">Pesquisar no blog</label>
                        <div class="input-group">
                            <input type="search" class="form-control" id="pesquisaBlog" name="q" placeholder="Ex.: paella, sobremesas">
                            <button class="btn btn-primary" type="submit" aria-label="Pesquisar">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="sidebar-widget">
                    <h2>Categorias</h2>
                    <ul class="category-list">
                        <?php foreach ($aCategoriaBlog as $categoria): ?>
                            <li>
                                <a href="#">
                                    <span><?= $categoria['descricao'] ?></span>
                                    <span class="count" aria-label="<?= $categoria['qtde'] ?> posts"><?= $categoria['qtde'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

<?php require_once "app/view/comuns/rodape.php"; ?>
