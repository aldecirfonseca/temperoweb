<?php

require_once "app/library/Database.php";

class BaseModel
{
    protected $db;

    protected $table;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Undocumented function
     *
     * @param string $orderField
     * @return array
     */
    public function lista(string $orderField = 'descricao'): array
    {
        return $this->db->select("SELECT * FROM {$this->table} ORDER BY {$orderField}");
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return array
     */
    public function getById(int $id): array
    {
        return $this->db->select(
            "SELECT * FROM {$this->table} WHERE id = ?", 
            [$id],
            'fist'
        );
    }
}