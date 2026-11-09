<?php

/**
 * mensagens
 *
 * Alertas de sucesso/erro enviados por redirect() via query string.
 * Os valores vêm da URL (o usuário pode digitar qualquer coisa),
 * por isso passam por htmlspecialchars antes de ir para o HTML.
 *
 * @return string
 */
function mensagens(): string
{
    $msgSucesso = "";
    $msgError = "";
    $retHTML = "";

    if (isset($_GET['msgSucesso']) && is_string($_GET['msgSucesso'])) {
        $msgSucesso = htmlspecialchars($_GET['msgSucesso'], ENT_QUOTES, 'UTF-8');
    }
    if (isset($_GET['msgError']) && is_string($_GET['msgError'])) {
        $msgError = htmlspecialchars($_GET['msgError'], ENT_QUOTES, 'UTF-8');
    }

    if (!empty($msgSucesso)) {
        $retHTML .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>' . $msgSucesso . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>';
    }

    if (!empty($msgError)) {
        $retHTML .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>' . $msgError . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>';
    }

    return $retHTML;
}

/**
 * cabecalho
 *
 * Título das telas do admin + botão Novo (na lista) ou Voltar (no formulário).
 *
 * @param string $titulo
 * @param string $programa    nome do controller (monta os links)
 * @param bool $exibeNovo     false nas telas que não cadastram (ex.: Contatos)
 * @return string
 */
function cabecalho(string $titulo, string $programa, bool $exibeNovo = true): string
{
    $request = new Request();
    $action = $request->getAction();

    $aSubTitulo = [
        "insert" => "- Novo",
        "update" => "- Alteração",
        "delete" => "- Exclusão",
        "view"   => "- Visualização",
    ];

    $subTitulo = $aSubTitulo[$action] ?? "";
    $btHTML    = "";

    if ($action != "") {
        $btHTML = '<a href="' . baseUrl() . $programa . '" class="btn btn-outline-primary"><i class="bi bi-arrow-left" aria-hidden="true"></i>Voltar</a>';
    } elseif ($exibeNovo) {
        $btHTML = '<a href="' . baseUrl() . $programa . '/form/insert" class="btn btn-primary"><i class="bi bi-plus-lg" aria-hidden="true"></i>Novo</a>';
    }

    $retHTML = '<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <span class="eyebrow">Administração</span>
                        <h1 class="admin-title">' . $titulo . ' ' . $subTitulo . '</h1>
                    </div>
                    ' . $btHTML . '
                </div>';

    $retHTML .= mensagens();

    return $retHTML;
}

/**
 * selected
 *
 * "selected" quando a opção é o valor atual do campo (para <option>).
 * Compara como texto: o banco devolve "1" e o código usa 1.
 *
 * @param mixed $valorAtual
 * @param mixed $opcao
 * @return string
 */
function selected($valorAtual, $opcao): string
{
    return ((string)$valorAtual === (string)$opcao ? "selected" : "");
}

/**
 * badgeStatus
 *
 * Selo Ativo/Inativo das listas do admin.
 *
 * @param mixed $statusRegistro  1 = Ativo; 2 = Inativo
 * @return string
 */
function badgeStatus($statusRegistro): string
{
    if ($statusRegistro == 1) {
        return '<span class="status-badge is-active">Ativo</span>';
    }

    return '<span class="status-badge is-inactive">Inativo</span>';
}

/**
 * botoesAcao
 *
 * Botões Visualizar / Alterar / Excluir de uma linha da lista do admin.
 *
 * @param string $programa   nome do controller
 * @param mixed $id
 * @param string $rotulo     texto que identifica o registro (já escapado pela view)
 * @param array $acoes       quais botões exibir
 * @return string
 */
function botoesAcao(string $programa, $id, string $rotulo, array $acoes = ["view", "update", "delete"]): string
{
    $aBotao = [
        "view"   => ["Visualizar", "btn-outline-secondary", "bi-eye"],
        "update" => ["Alterar",    "btn-outline-primary",   "bi-pencil"],
        "delete" => ["Excluir",    "btn-outline-danger",    "bi-trash"],
    ];

    $retHTML = "";

    foreach ($acoes as $acao) {
        [$titulo, $classe, $icone] = $aBotao[$acao];

        $retHTML .= '<a href="' . baseUrl() . $programa . '/form/' . $acao . '/' . (int)$id . '" class="btn btn-sm ' . $classe . '"
                        title="' . $titulo . '" aria-label="' . $titulo . ' ' . $rotulo . '"><i class="bi ' . $icone . '" aria-hidden="true"></i></a> ';
    }

    return $retHTML;
}
