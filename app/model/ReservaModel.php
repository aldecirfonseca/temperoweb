<?php

class ReservaModel extends BaseModel
{
    protected string $table   = "reserva";
    protected string $orderBy = "data DESC, horario";

    // Horários oferecidos no formulário (site e admin) e aceitos na validação
    public const HORARIOS = ['11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '17:00', '17:30'];

    // Máximo de pessoas por reserva online (grupos maiores: por telefone)
    public const MAXIMO_PESSOAS = 10;

    // situacao => rótulo
    public const SITUACOES = [1 => 'Pendente', 2 => 'Confirmada', 3 => 'Cancelada'];

    /**
     * valida
     *
     * Regras da reserva, usadas pelo site (Home) e pelo admin (Reserva).
     * A validação do navegador (required, type="email"...) ajuda o usuário,
     * mas pode ser desligada: o servidor precisa conferir de novo.
     *
     * @param array $dados
     * @param bool $aceitaDataPassada  true no admin (editar reservas antigas)
     * @return string  mensagem do primeiro erro ou "" se estiver tudo certo
     */
    public function valida(array $dados, bool $aceitaDataPassada = false): string
    {
        if ($dados['nome'] == "") {
            return "Informe o nome.";
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            return "Informe um e-mail válido.";
        }

        if ($dados['telefone'] == "") {
            return "Informe um telefone para contato.";
        }

        $data = DateTime::createFromFormat('Y-m-d', $dados['data']);

        if ($data === false || $data->format('Y-m-d') !== $dados['data']) {
            return "Informe uma data válida.";
        }

        if (!$aceitaDataPassada && $dados['data'] < date('Y-m-d')) {
            return "Escolha uma data a partir de hoje.";
        }

        if (!in_array($dados['horario'], self::HORARIOS)) {
            return "Escolha um dos horários disponíveis.";
        }

        if ($dados['pessoas'] < 1 || $dados['pessoas'] > self::MAXIMO_PESSOAS) {
            return "A reserva online é para 1 a " . self::MAXIMO_PESSOAS . " pessoas.";
        }

        if (!isset(self::SITUACOES[$dados['situacao']])) {
            return "Situação inválida.";
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
            "INSERT INTO {$this->table} (nome, email, telefone, data, horario, pessoas, observacao, situacao)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $dados['nome'], $dados['email'], $dados['telefone'], $dados['data'],
                $dados['horario'], $dados['pessoas'], $dados['observacao'], $dados['situacao']
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
                SET nome = ?, email = ?, telefone = ?, data = ?, horario = ?,
                    pessoas = ?, observacao = ?, situacao = ?
              WHERE id = ?",
            [
                $dados['nome'], $dados['email'], $dados['telefone'], $dados['data'],
                $dados['horario'], $dados['pessoas'], $dados['observacao'], $dados['situacao'],
                $id
            ]
        );
    }
}
