-- =====================================================================
-- Tempero Web - criação das tabelas e carga inicial
-- PHP Básico com MVC - 4º Período ADS - FASM 2026
--
-- Como usar: abrir no phpMyAdmin/HeidiSQL/MySQL Workbench e executar
-- o script inteiro. Ele pode ser executado de novo a qualquer momento:
-- apaga as tabelas do projeto e recria tudo com os dados de exemplo.
--
-- ATENÇÃO: os DROP TABLE abaixo apagam os dados dessas tabelas.
--
-- Usuários de acesso ao admin (senha de ambos: 123456):
--   admin@temperoweb.com.br      -> Administrador (acessa tudo)
--   atendente@temperoweb.com.br  -> Usuário (não acessa o cadastro de usuários)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS temperoweb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE temperoweb;

SET NAMES utf8mb4;

-- ---------------------------------------------------------------------
-- Remove as tabelas do projeto (filhas antes das mães, por causa das FKs)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS noticia;
DROP TABLE IF EXISTS blog_categoria;
DROP TABLE IF EXISTS produto;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS chef;
DROP TABLE IF EXISTS reserva;
DROP TABLE IF EXISTS contato;
DROP TABLE IF EXISTS usuario;

-- ---------------------------------------------------------------------
-- categoria: grupos do cardápio (Entradas, Pratos principais...)
-- ---------------------------------------------------------------------
CREATE TABLE categoria (
    id              INT          NOT NULL AUTO_INCREMENT,
    descricao       VARCHAR(100) NOT NULL,
    statusRegistro  TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- produto: pratos do cardápio
--   destaque = 1 -> aparece com o selo "Recomendado" no cardápio e,
--                   se tiver imagem, nos destaques da home e do cardápio
-- ---------------------------------------------------------------------
CREATE TABLE produto (
    id              INT           NOT NULL AUTO_INCREMENT,
    categoria_id    INT           NOT NULL,
    nome            VARCHAR(100)  NOT NULL,
    descricao       VARCHAR(255)  NOT NULL,
    preco           DECIMAL(10,2) NOT NULL,
    imagem          VARCHAR(100)  NULL COMMENT 'arquivo em assets/img/produto/',
    tag             VARCHAR(30)   NULL COMMENT 'selo exibido sobre a imagem',
    destaque        TINYINT       NOT NULL DEFAULT 0 COMMENT '1=Sim; 0=Não',
    statusRegistro  TINYINT       NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id),
    KEY idx_produto_categoria (categoria_id),
    CONSTRAINT fk_produto_categoria FOREIGN KEY (categoria_id) REFERENCES categoria (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- chef: equipe exibida na página Chefs
-- ---------------------------------------------------------------------
CREATE TABLE chef (
    id              INT          NOT NULL AUTO_INCREMENT,
    nome            VARCHAR(100) NOT NULL,
    cargo           VARCHAR(60)  NOT NULL,
    bio             VARCHAR(255) NOT NULL,
    imagem          VARCHAR(100) NULL COMMENT 'arquivo em assets/img/chef/',
    statusRegistro  TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- blog_categoria: categorias das notícias do blog
-- ---------------------------------------------------------------------
CREATE TABLE blog_categoria (
    id              INT          NOT NULL AUTO_INCREMENT,
    descricao       VARCHAR(100) NOT NULL,
    statusRegistro  TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- noticia: posts do blog
-- ---------------------------------------------------------------------
CREATE TABLE noticia (
    id                 INT          NOT NULL AUTO_INCREMENT,
    blog_categoria_id  INT          NOT NULL,
    titulo             VARCHAR(150) NOT NULL,
    resumo             VARCHAR(255) NOT NULL,
    imagem             VARCHAR(100) NULL COMMENT 'arquivo em assets/img/noticia/',
    dataPublicacao     DATE         NOT NULL,
    statusRegistro     TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id),
    KEY idx_noticia_blog_categoria (blog_categoria_id),
    CONSTRAINT fk_noticia_blog_categoria FOREIGN KEY (blog_categoria_id) REFERENCES blog_categoria (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- reserva: pedidos feitos pelo formulário "Reservar mesa"
-- ---------------------------------------------------------------------
CREATE TABLE reserva (
    id            INT          NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL,
    telefone      VARCHAR(20)  NOT NULL,
    data          DATE         NOT NULL,
    horario       VARCHAR(5)   NOT NULL COMMENT 'HH:MM',
    pessoas       TINYINT      NOT NULL,
    observacao    TEXT         NULL,
    situacao      TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Pendente; 2=Confirmada; 3=Cancelada',
    dataCadastro  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- contato: mensagens do formulário "Fale conosco"
-- ---------------------------------------------------------------------
CREATE TABLE contato (
    id            INT          NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(100) NOT NULL,
    telefone      VARCHAR(20)  NULL,
    email         VARCHAR(150) NOT NULL,
    mensagem      TEXT         NOT NULL,
    lido          TINYINT      NOT NULL DEFAULT 0 COMMENT '1=Lida; 0=Não lida',
    dataCadastro  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- usuario: acesso à área administrativa
--   senha guarda o HASH gerado por password_hash() (nunca a senha pura)
-- ---------------------------------------------------------------------
CREATE TABLE usuario (
    id              INT          NOT NULL AUTO_INCREMENT,
    nome            VARCHAR(100) NOT NULL,
    email           VARCHAR(150) NOT NULL,
    senha           VARCHAR(255) NOT NULL,
    nivel           TINYINT      NOT NULL DEFAULT 2 COMMENT '1=Administrador; 2=Usuário',
    statusRegistro  TINYINT      NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo',
    PRIMARY KEY (id),
    UNIQUE KEY uk_usuario_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================================
-- Carga inicial
-- =====================================================================

INSERT INTO categoria (id, descricao, statusRegistro) VALUES
    (1, 'Entradas', 1),
    (2, 'Pratos principais', 1),
    (3, 'Sobremesas', 1),
    (4, 'Bebidas', 1);

INSERT INTO produto (categoria_id, nome, descricao, preco, imagem, tag, destaque, statusRegistro) VALUES
    (1, 'Torrada com Ovo e Abacate', 'Pão rústico, abacate temperado e ovo com gema mole.',       20.00, 'featured3.png', 'Novidade',    1, 1),
    (1, 'Bruschetta da casa',        'Pão rústico, tomate, manjericão e azeite extravirgem.',      24.00, NULL,            NULL,          0, 1),
    (1, 'Patatas Bravas',            'Batatas crocantes com molho picante.',                       30.00, NULL,            NULL,          1, 1),
    (1, 'Salada de peixe',           'Mix de folhas com peixe grelhado e molho cítrico.',          32.00, NULL,            NULL,          0, 1),
    (2, 'Pizza Vegetariana',         'Tomate, azeitonas, pimentões, milho e muçarela.',            35.00, 'featured1.png', 'Mais pedido', 1, 1),
    (2, 'Asinhas Barbecue',          'Asas de frango glaceadas no molho barbecue da casa.',        30.00, 'featured2.png', 'Picante',     1, 1),
    (2, 'Paella mediterrânea',       'Arroz com frutos do mar e açafrão. Servida aos domingos.',   89.00, NULL,            NULL,          1, 1),
    (2, 'Filé ao molho madeira',     'Filé mignon, arroz e batatas rústicas.',                     68.00, NULL,            NULL,          0, 1),
    (3, 'Petit gâteau',              'Bolo quente de chocolate com sorvete de creme.',             22.00, NULL,            NULL,          0, 1),
    (3, 'Pudim de leite',            'Receita tradicional da casa, com calda de caramelo.',        14.00, NULL,            NULL,          0, 1),
    (4, 'Suco natural',              'Laranja, limão, abacaxi com hortelã ou maracujá (500 ml).',   9.00, NULL,            NULL,          0, 1),
    (4, 'Refrigerante lata',         'Coca-Cola, Guaraná ou Soda (350 ml).',                        6.00, NULL,            NULL,          0, 1),
    (4, 'Água de coco',              'Gelada, direto do coco verde.',                               8.00, NULL,            NULL,          0, 2);

INSERT INTO chef (nome, cargo, bio, imagem, statusRegistro) VALUES
    ('Danielson Lopes', 'Chef executivo', 'Especialista em cozinha mediterrânea e responsável pela paella de domingo.', 'chef-1.png', 1),
    ('Matheus Nazário', 'Chef executivo', 'Comanda as massas e pizzas, sempre com fermentação natural.',               'chef-2.png', 1),
    ('Paulo César',     'Chef executivo', 'Cuida das carnes e do preparo lento na brasa.',                             'chef-3.png', 1);

INSERT INTO blog_categoria (id, descricao, statusRegistro) VALUES
    (1, 'Comida do restaurante', 1),
    (2, 'Viagens', 1),
    (3, 'Tecnologia na cozinha', 1),
    (4, 'Produtos', 1),
    (5, 'Inspiração', 1),
    (6, 'Saúde e bem-estar', 1);

INSERT INTO noticia (blog_categoria_id, titulo, resumo, imagem, dataPublicacao, statusRegistro) VALUES
    (1, 'Paella de domingo: o segredo está no açafrão',  'Do fumet de peixe ao ponto do arroz: os passos que transformam a paella no prato mais pedido do fim de semana.', 'm-blog-1.jpg', '2026-10-15', 1),
    (4, 'Como escolhemos nossos fornecedores locais',    'Visitamos hortas e produtores da Zona da Mata para garantir ingredientes frescos todos os dias.',                'm-blog-2.jpg', '2026-10-12', 1),
    (5, '5 harmonizações de vinho para pratos leves',    'Brancos, rosés e espumantes que combinam com saladas, peixes e entradas do nosso cardápio.',                    'm-blog-3.jpg', '2026-10-09', 1),
    (1, 'Bastidores: um dia na cozinha do Tempero Web',  'Acompanhamos a equipe desde a chegada dos ingredientes, às 7h, até o último prato do almoço.',                  'm-blog-4.jpg', '2026-10-06', 1),
    (6, 'Novo cardápio de sobremesas chega em novembro', 'Menos açúcar, mais fruta da estação: conheça as sobremesas que entram no cardápio no próximo mês.',             'm-blog-5.jpg', '2026-10-03', 1);

INSERT INTO reserva (nome, email, telefone, data, horario, pessoas, observacao, situacao, dataCadastro) VALUES
    ('Mariana Souza',  'mariana@exemplo.com.br',  '(32) 99911-2233', '2026-11-20', '12:30', 4, 'Aniversário da minha mãe.', 1, '2026-11-02 09:15:00'),
    ('Carlos Pereira', 'carlos@exemplo.com.br',   '(32) 98822-3344', '2026-11-21', '13:00', 2, NULL,                        2, '2026-11-02 14:40:00'),
    ('Fernanda Lima',  'fernanda@exemplo.com.br', '(32) 3721-5566',  '2026-11-22', '17:30', 8, 'Precisamos de cadeira para bebê.', 3, '2026-11-03 18:05:00');

INSERT INTO contato (nome, telefone, email, mensagem, lido, dataCadastro) VALUES
    ('João Almeida', '(32) 99955-6677', 'joao@exemplo.com.br', 'Vocês atendem eventos corporativos para 40 pessoas? Gostaria de um orçamento.', 0, '2026-11-03 10:20:00'),
    ('Ana Ribeiro',  NULL,              'ana@exemplo.com.br',  'Parabéns pela paella de domingo, estava maravilhosa!',                          1, '2026-11-01 21:10:00');

-- senha "123456" -> hash gerado com password_hash('123456', PASSWORD_DEFAULT)
INSERT INTO usuario (nome, email, senha, nivel, statusRegistro) VALUES
    ('Administrador', 'admin@temperoweb.com.br',     '$2y$10$reQT6cm.I4oKt.nhE4AljeoOZKYEoYixQXrkVWC8iXXR6E4FYaAvO', 1, 1),
    ('Atendente',     'atendente@temperoweb.com.br', '$2y$10$reQT6cm.I4oKt.nhE4AljeoOZKYEoYixQXrkVWC8iXXR6E4FYaAvO', 2, 1);
