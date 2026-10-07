<?php
    // Itens do menu principal: rota => rótulo
    $aMenu = [
        'Home'             => 'Início',
        'Home/quemSomos'   => 'Quem somos',
        'Home/menu'        => 'Cardápio',
        'Home/chef'        => 'Chefs',
        'Home/blog'        => 'Blog',
        'Home/faleConosco' => 'Contato',
    ];
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Tempero Web - restaurante com comida fresca, cardápio variado e reservas online.">
        <meta name="theme-color" content="#B42318">

        <title>Tempero Web</title>

        <link rel="icon" href="<?= baseUrl() ?>assets/img/favicon.svg" type="image/svg+xml">

        <!-- Fontes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS + ícones -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

        <link href="<?= baseUrl() ?>assets/css/stilo.css" rel="stylesheet">

        <!-- Indica que o JS está ativo (usado pelas animações de entrada) -->
        <script>document.documentElement.classList.add('js');</script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </head>

    <body>

        <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

        <header class="site-header sticky-top">
            <nav class="navbar navbar-expand-lg" aria-label="Navegação principal">
                <div class="container">
                    <a class="navbar-brand brand" href="<?= baseUrl() ?>Home" aria-label="Tempero Web - página inicial">
                        <span class="brand-mark" aria-hidden="true">TW</span>
                        <span class="brand-name">Tempero Web</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                        aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menu">
                        <i class="bi bi-list fs-4" aria-hidden="true"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="menuPrincipal">
                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            <?php foreach ($aMenu as $rota => $rotulo): ?>
                                <?php $ativo = menuAtivo($rota); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $ativo ?>" href="<?= baseUrl() . $rota ?>" <?= ($ativo ? 'aria-current="page"' : '') ?>><?= $rotulo ?></a>
                                </li>
                            <?php endforeach; ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1" aria-hidden="true"></i>Aldecir
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Administração</h6></li>
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>Categoria"><i class="bi bi-tags" aria-hidden="true"></i>Categorias</a></li>
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>Produto"><i class="bi bi-basket" aria-hidden="true"></i>Produtos</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-people" aria-hidden="true"></i>Usuários</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-key" aria-hidden="true"></i>Trocar a senha</a></li>
                                </ul>
                            </li>

                            <li class="nav-item ms-lg-2">
                                <a class="btn btn-primary nav-cta" href="<?= baseUrl() ?>Home/reserva" <?= (menuAtivo('Home/reserva') ? 'aria-current="page"' : '') ?>>
                                    <i class="bi bi-calendar-check" aria-hidden="true"></i>Reservar mesa
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main id="conteudo" tabindex="-1">
