<?php

/**
 * baseUrl
 *
 * @return string
 */
function baseUrl(): string
{
    return BASEURL;
}

/**
 * menuAtivo
 *
 * Retorna a classe "active" quando a rota informada (ex.: "Home/menu")
 * é a página atual. Usado no menu do cabeçalho.
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
 * tituloPagina
 *
 * Faixa de título (breadcrumb + h1) das páginas internas do site.
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
                                <li class="breadcrumb-item active" aria-current="page">' . $titulo . '</li>
                            </ol>
                        </nav>
                        <h1>' . $titulo . '</h1>';

    if (!empty($subtitulo)) {
        $retHTML .= '<p class="section-lead mb-0">' . htmlspecialchars($subtitulo, ENT_QUOTES, 'UTF-8') . '</p>';
    }

    $retHTML .= '   </div>
                </section>';

    return $retHTML;
}

/**
 * strFloat
 *
 * Do formulário para o banco: "1.234,50" -> 1234.5
 *
 * @param string $valor
 * @return float
 */
function strFloat(string $valor): float
{
    return (float)str_replace(",", ".", str_replace(".", "", $valor));
}

/**
 * formatoValor
 *
 * Do banco para a tela: 1234.5 -> "1.234,50"
 *
 * @param float $valor
 * @param int $decimais
 * @return string
 */
function formatoValor(float $valor, int $decimais = 2): string
{
    return number_format($valor, $decimais, ",", ".");
}

/**
 * formatoData
 *
 * Do banco para a tela: "2026-11-20" -> "20/11/2026"
 * (com $comHora: "2026-11-02 09:15:00" -> "02/11/2026 09:15")
 *
 * @param string|null $data
 * @param bool $comHora
 * @return string
 */
function formatoData(?string $data, bool $comHora = false): string
{
    if (empty($data)) {
        return "";
    }

    return date(($comHora ? "d/m/Y H:i" : "d/m/Y"), strtotime($data));
}

/**
 * imagemUrl
 *
 * Endereço de uma imagem cadastrada em assets/img/{pasta}/.
 * Sem imagem, devolve a ilustração padrão "sem imagem".
 *
 * @param string|null $imagem
 * @param string $pasta
 * @return string
 */
function imagemUrl(?string $imagem, string $pasta): string
{
    if (empty($imagem)) {
        return baseUrl() . "assets/img/sem-imagem.svg";
    }

    return baseUrl() . "assets/img/" . $pasta . "/" . $imagem;
}

/**
 * usuarioLogado
 *
 * Dados do usuário guardados na sessão pelo login, ou null se ninguém entrou.
 *
 * @return array|null  ['id' => ..., 'nome' => ..., 'nivel' => ...]
 */
function usuarioLogado(): ?array
{
    return $_SESSION['usuario'] ?? null;
}
