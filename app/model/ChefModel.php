<?php

class ChefModel extends BaseModel
{
    protected string $table   = "chef";
    protected string $orderBy = "nome";

    /**
     * insert
     *
     * @param array $dados
     * @return int
     */
    public function insert(array $dados): int
    {
        return $this->db->insert(
            "INSERT INTO {$this->table} (nome, cargo, bio, imagem, statusRegistro) VALUES (?, ?, ?, ?, ?)",
            [$dados['nome'], $dados['cargo'], $dados['bio'], $dados['imagem'], $dados['statusRegistro']]
        );
    }

    /**
     * update
     *
     * @param int $id
     * @param array $dados
     * @return int
     */
    public function update(int $id, array $dados): int
    {
        return $this->db->update(
            "UPDATE {$this->table} SET nome = ?, cargo = ?, bio = ?, imagem = ?, statusRegistro = ? WHERE id = ?",
            [$dados['nome'], $dados['cargo'], $dados['bio'], $dados['imagem'], $dados['statusRegistro'], $id]
        );
    }
}
