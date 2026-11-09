<?php

class BlogCategoriaModel extends BaseModel
{
    protected string $table = "blog_categoria";

    /**
     * comQuantidade
     *
     * Categorias ativas com a quantidade de notícias publicadas em cada uma
     * (barra lateral do blog). LEFT JOIN: categoria sem notícia aparece com 0.
     *
     * @return array
     */
    public function comQuantidade(): array
    {
        return $this->db->select(
            "SELECT bc.id, bc.descricao, COUNT(n.id) AS qtde
               FROM blog_categoria bc
               LEFT JOIN noticia n ON n.blog_categoria_id = bc.id
                                  AND n.statusRegistro = 1
                                  AND n.dataPublicacao <= CURDATE()
              WHERE bc.statusRegistro = 1
              GROUP BY bc.id, bc.descricao
              ORDER BY bc.descricao"
        );
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
