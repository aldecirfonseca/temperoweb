<?php

require_once "app/library/Database.php";

/**
 * BaseModel
 *
 * Classe mãe dos models. O SQL que é igual para todas as tabelas fica aqui
 * e usa {$this->table}; cada model filho só informa a tabela e escreve o que
 * depende das colunas (insert, update e consultas específicas).
 */
abstract class BaseModel
{
    protected Database $db;

    // nome da tabela (definido em cada model filho)
    protected string $table = "";

    // ORDER BY padrão de lista(). Fica no código, nunca vem da URL:
    // nomes de coluna não podem ir num "?" do prepared statement.
    protected string $orderBy = "descricao";

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * lista
     *
     * @return array
     */
    public function lista(): array
    {
        return $this->db->select("SELECT * FROM {$this->table} ORDER BY {$this->orderBy}");
    }

    /**
     * listaAtivos
     *
     * Só os registros com statusRegistro = 1 (para o site e para os <select>).
     *
     * @return array
     */
    public function listaAtivos(): array
    {
        return $this->db->select(
            "SELECT * FROM {$this->table} WHERE statusRegistro = 1 ORDER BY {$this->orderBy}"
        );
    }

    /**
     * getById
     *
     * @param int $id
     * @return array  registro encontrado ou [] (ex.: no insert, id = 0)
     */
    public function getById(int $id): array
    {
        $registro = $this->db->select(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id],
            'first'
        );

        return ($registro === false ? [] : $registro);
    }

    /**
     * delete
     *
     * @param int $id
     * @return int  linhas excluídas
     */
    public function delete(int $id): int
    {
        return $this->db->delete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }
}
