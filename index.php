<?php
    // Carregando configurações, libraries e BaseController
    require_once 'app/config/Config.php';
    require_once 'app/library/Request.php';
    require_once 'app/controller/BaseController.php';

    //

    $caminho        = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri            = explode("/", $caminho);
    $controllerName = ($caminho == "/" ? "Home" : ucfirst($uri[1]));
    $method         = (isset($uri[2]) ? $uri[2] : 'index');

    if (file_exists("app/controller/" . $controllerName . ".php")) {
        // carregando o controller
        require_once "app/controller/" . $controllerName . ".php";

        $controller = new $controllerName();

        if (method_exists($controller, $method)) {
            // executar o método desejado do objeto controller
            $controller->$method();
        } else {
            echo "Método {$method} não localizado no controller."; exit;
        }
    } else {
        echo "Controller {$controllerName} não localizado."; exit;
    }