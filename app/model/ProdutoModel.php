<?php

class ProdutoModel extends BaseModel
{
    protected string $table   = "produto";
    protected string $orderBy = "nome";

    /**
     * listaComCategoria
     *
     * Lista do admin com o nome da categoria (JOIN).
     *
     * @return array
     */
    public function listaComCategoria(): array
    {
        return $this->db->select(
            "SELECT p.*, c.descricao AS categoria
               FROM produto p
               JOIN categoria c ON c.id = p.categoria_id
              ORDER BY c.descricao, p.nome"
        );
    }

    /**
     * destaques
     *
     * Pratos em destaque da home e do cardápio: ativos, com imagem
     * e de categoria ativa.
     *
     * @param int $limite
     * @return array
     */
    public function destaques(int $limite = 3): array
    {
        // LIMIT não aceita "?" com o PDO padrão do MySQL (o valor iria entre aspas).
        // Como $limite é int (tipado), concatenar aqui é seguro.
        return $this->db->select(
            "SELECT p.*
               FROM produto p
               JOIN categoria c ON c.id = p.categoria_id
              WHERE p.destaque = 1
                AND p.imagem IS NOT NULL
                AND p.statusRegistro = 1
                AND c.statusRegistro = 1
              ORDER BY p.nome
              LIMIT " . $limite
        );
    }

    /**
     * cardapio
     *
     * Produtos ativos agrupados pelo nome da categoria:
     * ["Entradas" => [produto, produto...], "Sobremesas" => [...]]
     *
     * @return array
     */
    public function cardapio(): array
    {
        $rows = $this->db->select(
            "SELECT p.*, c.descricao AS categoria
               FROM produto p
               JOIN categoria c ON c.id = p.categoria_id
              WHERE p.statusRegistro = 1
                AND c.statusRegistro = 1
              ORDER BY c.descricao, p.nome"
        );

        $aCardapio = [];

        foreach ($rows as $produto) {
            $aCardapio[$produto['categoria']][] = $produto;
        }

        return $aCardapio;
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
            "INSERT INTO {$this->table}
                    (categoria_id, nome, descricao, preco, imagem, tag, destaque, statusRegistro)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $dados['categoria_id'], $dados['nome'], $dados['descricao'], $dados['preco'],
                $dados['imagem'], $dados['tag'], $dados['destaque'], $dados['statusRegistro']
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
                SET categoria_id = ?, nome = ?, descricao = ?, preco = ?,
                    imagem = ?, tag = ?, destaque = ?, statusRegistro = ?
              WHERE id = ?",
            [
                $dados['categoria_id'], $dados['nome'], $dados['descricao'], $dados['preco'],
                $dados['imagem'], $dados['tag'], $dados['destaque'], $dados['statusRegistro'],
                $id
            ]
        );
    }
}
