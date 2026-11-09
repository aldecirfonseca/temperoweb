<?php

// Carregando configurações, libraries e classes base
require_once 'app/config/Config.php';
require_once 'app/library/Request.php';
require_once 'app/controller/BaseController.php';
require_once 'app/model/BaseModel.php';

// Obter Controller e Método a partir da URL: /{controller}/{metodo}/{action}/{id}
$caminho        = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri            = explode("/", $caminho);
$controllerName = ($caminho == "/" ? "Home" : ucfirst($uri[1]));
$method         = (isset($uri[2]) && $uri[2] != "" ? $uri[2] : 'index');

// Só aceita nomes feitos de letras e números: bloqueia "../", "__construct" etc.
// As classes base (BaseController, AdminController) não podem ser abertas pela URL.
$controllerValido = ctype_alnum($controllerName)
    && !str_ends_with($controllerName, 'Controller')
    && file_exists("app/controller/" . $controllerName . ".php");

if (!$controllerValido) {
    paginaNaoEncontrada("Página não encontrada.");
}

// carregando o controller
require_once "app/controller/" . $controllerName . ".php";

$controller = new $controllerName();

// is_callable() só aceita métodos PÚBLICOS: os protected/private
// (view, model, redirect, dados internos...) não respondem pela URL.
if (!ctype_alnum($method) || !is_callable([$controller, $method])) {
    paginaNaoEncontrada("Página não encontrada.");
}

// executar o método desejado do objeto controller
$controller->$method();

/**
 * paginaNaoEncontrada
 *
 * Responde com o código HTTP 404 e encerra a requisição.
 *
 * @param string $mensagem
 * @return never
 */
function paginaNaoEncontrada(string $mensagem): never
{
    http_response_code(404);
    echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');
    exit;
}
