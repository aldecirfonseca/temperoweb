<?php

/**
 * Undocumented function
 *
 * @return string
 */
function baseUrl(): string
{
    return BASEURL;
}

/**
 * Undocumented function
 *
 * @param string $rota
 * @return string
 */
function menuAtivo(string $rota): string
{
    $caminho = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");

    if ($caminho == "" || strcasecmp($caminho, "Home/index") == 0) {
        $caminho = "Home";
    }

    return (strcasecmp($caminho, $rota) == 0 ? "active" : "");
}

/**
 * Undocumented function
 *
 * @param string $titulo
 * @param string $subtitulo
 * @return string
 */
function tituloPagina(string $titulo, string $subtitulo = ""): string
{
    $titulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');

    $retHTML = '<section class="page-hero">
                    <div class="container">
                        <nav aria-label="Você está em">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="' . baseUrl() . 'Home">Início</a></li>
                                <li class="breadcrumb-item active" aria-current="page">' . $titulo . '</a></li>
                            </ol>
                        </nav>
                        <h1>' . $titulo . '</h1>';
    
    if (!empty($subtitulo)) {
        $retHTML .= '<p class="section-lead mb-0">' . htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') . '</p>';
    }

    $retHTML .= '</div>
            </section>';
    
    return $retHTML;
}

/**
 * Undocumented function
 *
 * @param string $valor
 * @return float
 */
function strFloat(string $valor): float
{
    return (float)str_replace(",", ".", str_replace(".", "", $valor));
}

/**
 * Undocumented function
 *
 * @param float $valor
 * @param integer $decimais
 * @return string
 */
function formataValor(float $valor, int $decimais = 2): string
{
    return number_format($valor, $decimais, ",", ".");
}