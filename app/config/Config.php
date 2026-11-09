<?php

    // URL base da aplicação
    // (usa o host da requisição, funcionando em qualquer virtual host)
    defined('BASEURL') || define("BASEURL",
        ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://')
        . $_SERVER['HTTP_HOST'] . '/');

    // Dados de conexão com o banco de dados
    // (em produção, a senha não fica no código: usar variáveis de ambiente/.env)
    defined("DB_CONF_CONEXAO") || define("DB_CONF_CONEXAO", [
        "DB_DRIVE"      => 'mysql',
        "DB_HOST"       => 'localhost',
        "DB_PORT"       => '3306',
        'DB_USER'       => 'root',
        'DB_PASSWORD'   => '',
        "DB_BASEDADOS"  => 'temperoweb'
    ]);
