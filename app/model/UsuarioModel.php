<?php

class UsuarioModel extends BaseModel
{
    protected string $table   = "usuario";
    protected string $orderBy = "nome";

    // nivel => rótulo
    public const NIVEIS = [1 => 'Administrador', 2 => 'Usuário'];

    /**
     * lista
     *
     * Sobrescreve a lista do BaseModel para NÃO trazer o hash da senha.
     *
     * @return array
     */
    public function lista(): array
    {
        return $this->db->select(
            "SELECT id, nome, email, nivel, statusRegistro FROM {$this->table} ORDER BY nome"
        );
    }

    /**
     * getById
     *
     * Também sem o hash da senha (os dados vão para o formulário).
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $registro = $this->db->select(
            "SELECT id, nome, email, nivel, statusRegistro FROM {$this->table} WHERE id = ?",
            [$id],
            'first'
        );

        return ($registro === false ? [] : $registro);
    }

    /**
     * getAtivoPorEmail
     *
     * Usado no login: traz o hash da senha para conferir com password_verify().
     *
     * @param string $email
     * @return array
     */
    public function getAtivoPorEmail(string $email): array
    {
        $registro = $this->db->select(
            "SELECT * FROM {$this->table} WHERE email = ? AND statusRegistro = 1",
            [$email],
            'first'
        );

        return ($registro === false ? [] : $registro);
    }

    /**
     * getSenhaHash
     *
     * @param int $id
     * @return string
     */
    public function getSenhaHash(int $id): string
    {
        $registro = $this->db->select("SELECT senha FROM {$this->table} WHERE id = ?", [$id], 'first');

        return ($registro === false ? "" : $registro['senha']);
    }

    /**
     * insert
     *
     * A senha chega pura e é gravada como hash (password_hash gera um "sal"
     * aleatório: a mesma senha gera hashes diferentes a cada vez).
     *
     * @param array $dados
     * @return int
     */
    public function insert(array $dados): int
    {
        return $this->db->insert(
            "INSERT INTO {$this->table} (nome, email, senha, nivel, statusRegistro) VALUES (?, ?, ?, ?, ?)",
            [
                $dados['nome'], $dados['email'], password_hash($dados['senha'], PASSWORD_DEFAULT),
                $dados['nivel'], $dados['statusRegistro']
            ]
        );
    }

    /**
     * update
     *
     * Senha em branco = mantém a senha atual.
     *
     * @param int $id
     * @param array $dados
     * @return int
     */
    public function update(int $id, array $dados): int
    {
        $linhas = $this->db->update(
            "UPDATE {$this->table} SET nome = ?, email = ?, nivel = ?, statusRegistro = ? WHERE id = ?",
            [$dados['nome'], $dados['email'], $dados['nivel'], $dados['statusRegistro'], $id]
        );

        if ($dados['senha'] != "") {
            $linhas += $this->atualizaSenha($id, $dados['senha']);
        }

        return $linhas;
    }

    /**
     * atualizaSenha
     *
     * @param int $id
     * @param string $senha  senha pura (vira hash aqui)
     * @return int
     */
    public function atualizaSenha(int $id, string $senha): int
    {
        return $this->db->update(
            "UPDATE {$this->table} SET senha = ? WHERE id = ?",
            [password_hash($senha, PASSWORD_DEFAULT), $id]
        );
    }
}
