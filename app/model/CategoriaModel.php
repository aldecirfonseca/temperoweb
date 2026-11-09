<?php

class CategoriaModel extends BaseModel
{
    protected string $table = "categoria";

    /**
     * insert
     *
     * @param array $dados
     * @return int
     */
    public function insert(array $dados): int
    {
        return $this->db->insert(
            "INSERT INTO {$this->table} (descricao, statusRegistro) VALUES (?, ?)",
            [$dados['descricao'], $dados['statusRegistro']]
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
            "UPDATE {$this->table} SET descricao = ?, statusRegistro = ? WHERE id = ?",
            [$dados['descricao'], $dados['statusRegistro'], $id]
        );
    }
}
