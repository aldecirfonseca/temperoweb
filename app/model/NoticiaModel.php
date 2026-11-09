<?php

class NoticiaModel extends BaseModel
{
    protected string $table   = "noticia";
    protected string $orderBy = "dataPublicacao DESC";

    /**
     * listaComCategoria
     *
     * Lista do admin com o nome da categoria do blog (JOIN).
     *
     * @return array
     */
    public function listaComCategoria(): array
    {
        return $this->db->select(
            "SELECT n.*, bc.descricao AS categoria
               FROM noticia n
               JOIN blog_categoria bc ON bc.id = n.blog_categoria_id
              ORDER BY n.dataPublicacao DESC, n.id DESC"
        );
    }

    /**
     * publicadas
     *
     * Notícias do site: ativas e com data de publicação até hoje.
     * O próprio SQL já devolve o dia ("15") e o mês abreviado ("Out")
     * que a view exibe no selo da data.
     *
     * @return array
     */
    public function publicadas(): array
    {
        return $this->db->select(
            "SELECT n.*,
                    bc.descricao AS categoria,
                    DATE_FORMAT(n.dataPublicacao, '%d') AS dia,
                    ELT(MONTH(n.dataPublicacao), 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                                                 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez') AS mes
               FROM noticia n
               JOIN blog_categoria bc ON bc.id = n.blog_categoria_id
              WHERE n.statusRegistro = 1
                AND bc.statusRegistro = 1
                AND n.dataPublicacao <= CURDATE()
              ORDER BY n.dataPublicacao DESC, n.id DESC"
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
            "INSERT INTO {$this->table} (blog_categoria_id, titulo, resumo, imagem, dataPublicacao, statusRegistro)
             VALUES (?, ?, ?, ?, ?, ?)",
            [
                $dados['blog_categoria_id'], $dados['titulo'], $dados['resumo'],
                $dados['imagem'], $dados['dataPublicacao'], $dados['statusRegistro']
            ]
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
            "UPDATE {$this->table}
                SET blog_categoria_id = ?, titulo = ?, resumo = ?, imagem = ?, dataPublicacao = ?, statusRegistro = ?
              WHERE id = ?",
            [
                $dados['blog_categoria_id'], $dados['titulo'], $dados['resumo'],
                $dados['imagem'], $dados['dataPublicacao'], $dados['statusRegistro'],
                $id
            ]
        );
    }
}
