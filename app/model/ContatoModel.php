<?php

class ContatoModel extends BaseModel
{
    protected string $table   = "contato";
    protected string $orderBy = "dataCadastro DESC";

    /**
     * valida
     *
     * @param array $dados
     * @return string  mensagem do primeiro erro ou "" se estiver tudo certo
     */
    public function valida(array $dados): string
    {
        if ($dados['nome'] == "") {
            return "Informe seu nome.";
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            return "Informe um e-mail válido para respondermos.";
        }

        if (mb_strlen($dados['mensagem']) < 10) {
            return "Escreva sua mensagem (mínimo de 10 caracteres).";
        }

        return "";
    }

    /**
     * insert
     *
     * @param array $dados
     * @return int
     */
    public function insert(array $dados): int
    {
        return $this->db->insert(
            "INSERT INTO {$this->table} (nome, telefone, email, mensagem) VALUES (?, ?, ?, ?)",
            [$dados['nome'], $dados['telefone'], $dados['email'], $dados['mensagem']]
        );
    }

    /**
     * marcaComoLida
     *
     * @param int $id
     * @return int
     */
    public function marcaComoLida(int $id): int
    {
        return $this->db->update("UPDATE {$this->table} SET lido = 1 WHERE id = ?", [$id]);
    }

    /**
     * qtdeNaoLidas
     *
     * @return int
     */
    public function qtdeNaoLidas(): int
    {
        $row = $this->db->select("SELECT COUNT(*) AS qtde FROM {$this->table} WHERE lido = 0", [], 'first');

        return (int)$row['qtde'];
    }
}
