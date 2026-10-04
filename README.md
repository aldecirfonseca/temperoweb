# Tempero Web

Projeto prático desenvolvido com os alunos do **4º período do curso de Análise e Desenvolvimento de Sistemas** da **Faculdade Santa Marcelina — unidade Muriaé (FASM)**, em **2026**.

O objetivo é construir, do zero e sem frameworks, uma aplicação web em **PHP** seguindo o padrão **MVC (Model-View-Controller)**. Assim, a turma entende na prática como funcionam por dentro os recursos que frameworks como Laravel e CodeIgniter entregam prontos: roteamento, controllers, views, helpers e configuração.

> **Projeto em desenvolvimento.** A estrutura evolui a cada aula, então algumas partes ainda estão incompletas.

---

## 🎯 Objetivos de aprendizagem

- Entender o padrão **MVC** e a separação de responsabilidades
- Implementar um **Front Controller** (um único ponto de entrada da aplicação)
- Criar **URLs amigáveis** com `mod_rewrite` do Apache
- Construir um **roteador** simples baseado na URL
- Aplicar **herança** com um `BaseController` comum a todos os controllers
- Organizar código reutilizável em **helpers** e **libraries**
- Conectar a aplicação a um banco de dados **MySQL** (próximas etapas)

---

## 🛠️ Tecnologias

| Tecnologia | Uso |
|---|---|
| PHP 8.0+ | Linguagem principal (o projeto usa *union types*) |
| Apache + `mod_rewrite` | Servidor web e URLs amigáveis |
| MySQL / MariaDB | Banco de dados |
| HTML | Views |

---

## 📁 Estrutura do projeto

```
temperoweb/
├── .htaccess                  # Redireciona todas as requisições para o index.php
├── index.php                  # Front Controller + roteador
└── app/
    ├── config/
    │   └── Config.php         # Constantes da aplicação (BASEURL e conexão com o banco)
    ├── controller/
    │   ├── BaseController.php # Controller base: carrega views e helpers
    │   └── Home.php           # Controller da página inicial
    ├── helper/
    │   └── Utilits.php        # Funções utilitárias (ex.: baseUrl())
    ├── library/
    │   └── Request.php        # Lê os segmentos da URL (action e id)
    └── view/
        └── home.php           # View da página inicial
```

---

## Como funciona o roteamento

Toda requisição passa pelo `.htaccess`, que a envia ao `index.php`. Em seguida, o `index.php` divide a URL em segmentos e decide qual controller e qual método executar:

```
http://temperoweb/{controller}/{metodo}/{action}/{id}
```

| Segmento | Quem lê | Padrão |
|---|---|---|
| `controller` | `index.php` | `Home` |
| `metodo` | `index.php` | `index` |
| `action` | `Request::getAction()` | `""` |
| `id` | `Request::getId()` | `0` |

**Exemplos:**

| URL | Executa |
|---|---|
| `http://temperoweb/` | `Home::index()` |
| `http://temperoweb/home` | `Home::index()` |
| `http://temperoweb/produto/form/insert` | `Produto::form()` com `action = "insert"` |
| `http://temperoweb/produto/form/update/5` | `Produto::form()` com `action = "update"` e `id = 5` |

O nome do controller recebe a primeira letra maiúscula automaticamente (`produto` → `Produto`), e o arquivo correspondente precisa existir em `app/controller/Produto.php`.

---

## Como rodar localmente

### 1. Pré-requisitos

- PHP 8.0 ou superior
- Apache com `mod_rewrite` habilitado e `AllowOverride All`
- MySQL ou MariaDB

Pacotes como **XAMPP**, **WampServer** ou **Laragon** já trazem tudo isso.

### 2. Clonar o repositório

```bash
git clone https://github.com/<seu-usuario>/temperoweb.git
```

### 3. Configurar um Virtual Host

O roteador assume que a aplicação roda na **raiz do domínio**, então é preciso criar um Virtual Host. Acessar por `http://localhost/temperoweb/` **não funciona**, porque a pasta seria interpretada como o nome do controller.

**Apache (`httpd-vhosts.conf`):**

```apache
<VirtualHost *:80>
    ServerName temperoweb
    DocumentRoot "C:/caminho/para/temperoweb"
    <Directory "C:/caminho/para/temperoweb">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Arquivo `hosts`** (Windows: `C:\Windows\System32\drivers\etc\hosts` · Linux/macOS: `/etc/hosts`):

```
127.0.0.1   temperoweb
```

Depois, reinicie o Apache.

> No **Laragon**, basta colocar a pasta em `www/`: o Virtual Host `temperoweb.test` é criado automaticamente. Nesse caso, ajuste a `BASEURL` no `Config.php`.

### 4. Configurar a aplicação

Edite o arquivo `app/config/Config.php` com os dados do seu ambiente:

```php
define("BASEURL", 'http://temperoweb/');

define("DB_CONF_CONEXAO", [
    "DB_DRIVE"      => 'mysql',
    "DB_HOST"       => 'localhost',
    "DB_PORT"       => '3306',
    'DB_USER'       => 'root',
    'DB_PASSWORD'   => '',
    "DB_BASEDADOS"  => 'temperoweb'
]);
```

### 5. Criar o banco de dados

```sql
CREATE DATABASE temperoweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Acessar

Abra `http://temperoweb/` no navegador. Você deve ver a mensagem de boas-vindas do **Tempero Web**.

---

## Criando um novo controller

1. Crie o arquivo `app/controller/Exemplo.php`:

```php
<?php

class Exemplo extends BaseController
{
    public function index()
    {
        return $this->view("exemplo", [
            'titulo' => 'Minha primeira página'
        ]);
    }
}
```

2. Crie a view `app/view/exemplo.php`:

```php
<h2><?= $titulo ?></h2>
<p>A action atual é: <?= $action ?></p>
```

3. Acesse `http://temperoweb/exemplo`.

> Cada chave do array passado para `view()` vira uma variável dentro da view (via `extract()`). A variável `$action` é injetada automaticamente pelo `BaseController`.

---

## 🗺️ Próximos passos

- [ ] Camada **Model** com conexão PDO ao banco de dados
- [ ] CRUDs das entidades do sistema
- [ ] Layout base (cabeçalho, menu e rodapé) compartilhado entre as views
- [ ] Validação de formulários
- [ ] Autenticação de usuários
- [ ] Página de erro 404 personalizada

---

## Equipe

**Professor:** Aldecir Fonseca

**Turma:** 4º período de Análise e Desenvolvimento de Sistemas, FASM Muriaé, 2026

<!-- Alunos: adicione seu nome e GitHub abaixo via Pull Request -->
| Aluno(a) | GitHub |
|---|---|
| | |

---

## 📄 Licença

Projeto de uso **acadêmico e educacional**, desenvolvido para a Faculdade Santa Marcelina (FASM), unidade Muriaé.
