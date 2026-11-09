<?php

class Request
{
    protected $uri;

    public function __construct()
    {
        $caminho        = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->uri      = explode("/", $caminho);
    }

    /**
     * getAction
     *
     * Terceiro segmento da URL: insert, update, delete ou view.
     *
     * @return string
     */
    public function getAction(): string
    {
        return isset($this->uri[3]) ? $this->uri[3] : "";
    }

    /**
     * getId
     *
     * Quarto segmento da URL: id do registro.
     *
     * @return int
     */
    public function getId(): int
    {
        return isset($this->uri[4]) ? (int)$this->uri[4] : 0;
    }

    /**
     * post
     *
     * Valor de um campo do formulário (POST), sem espaços nas pontas.
     * Devolve "" quando o campo não foi enviado.
     *
     * @param string $campo
     * @return string
     */
    public function post(string $campo): string
    {
        return isset($_POST[$campo]) && is_string($_POST[$campo]) ? trim($_POST[$campo]) : "";
    }

    /**
     * arquivo
     *
     * Dados de um arquivo enviado pelo formulário ($_FILES).
     *
     * @param string $campo
     * @return array
     */
    public function arquivo(string $campo): array
    {
        return isset($_FILES[$campo]) && is_array($_FILES[$campo]) ? $_FILES[$campo] : [];
    }

    /**
     * isPost
     *
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
