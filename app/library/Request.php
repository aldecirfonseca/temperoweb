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
     * Undocumented function
     *
     * @return string
     */
    public function getAction(): string
    {
        return isset($this->uri[3]) ? $this->uri[3] : "";
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function getId(): int
    {
        return isset($this->uri[4]) ? (int)$this->uri[4] : 0;
    }
}