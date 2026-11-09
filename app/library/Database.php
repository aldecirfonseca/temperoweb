<?php

class Database
{
    private static $dbConfigaraConexao;
    private static ?PDO $conexao = null;

    public function __construct($dbConfigaraConexao = DB_CONF_CONEXAO)
    {
        self::$dbConfigaraConexao = $dbConfigaraConexao;
    }

    /**
     * conecta
     *
     * Conexão estática: compartilhada por todas as instâncias de
     * Database durante a requisição, evitando reconectar ao banco
     * a cada select/insert/update/delete ou a cada model criado.
     *
     * @return PDO
     */
    public function conecta(): PDO
    {
        if (self::$conexao instanceof PDO) {
            return self::$conexao;
        }

        $dsn = self::$dbConfigaraConexao['DB_DRIVE'] .
                ":host=" . self::$dbConfigaraConexao['DB_HOST'] .
                ";port=" . self::$dbConfigaraConexao['DB_PORT'] .
                ";dbname=" . self::$dbConfigaraConexao['DB_BASEDADOS'] .
                ";charset=utf8mb4";

        try {
            self::$conexao = new PDO(
                $dsn,
                self::$dbConfigaraConexao['DB_USER'],         // usuário
                self::$dbConfigaraConexao['DB_PASSWORD']      // senha
            );

            // erros do banco viram exceções (PDOException)
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // fetch/fetchAll devolvem só as chaves por nome (sem os índices numéricos)
            self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            // Sem banco não há o que fazer: para aqui com uma mensagem clara,
            // em vez de devolver null e quebrar mais adiante no prepare().
            http_response_code(500);
            exit("Não foi possível conectar ao banco de dados: " . $ex->getMessage());
        }

        return self::$conexao;
    }

    /**
     * select
     *
     * @param string $comando_sql
     * @param array $dados
     * @param string $tipoRetorno  'all' = todas as linhas; 'first' = só a primeira
     * @return array|false         false quando 'first' não encontra nada
     */
    public function select(
        string $comando_sql,
        array $dados = [],
        string $tipoRetorno = 'all'
    ) {
        $data = $this->conecta()->prepare($comando_sql);

        // executa o comando SQL
        $data->execute($dados);

        if ($tipoRetorno == 'all') {
            return $data->fetchAll();
        }

        return $data->fetch();
    }

    /**
     * insert
     *
     * @param string $comando_sql
     * @param array $dados
     * @return int  id gerado pelo AUTO_INCREMENT
     */
    public function insert(
        string $comando_sql,
        array $dados = []
    ): int {
        $conn = $this->conecta();
        $data = $conn->prepare($comando_sql);

        // executa o comando SQL
        $data->execute($dados);

        return (int)$conn->lastInsertId();
    }

    /**
     * update
     *
     * @param string $comando_sql
     * @param array $dados
     * @return int  linhas efetivamente alteradas
     */
    public function update(
        string $comando_sql,
        array $dados = []
    ): int {
        $data = $this->conecta()->prepare($comando_sql);

        // executa o comando SQL
        $data->execute($dados);

        return $data->rowCount();
    }

    /**
     * delete
     *
     * @param string $comando_sql
     * @param array $dados
     * @return int  linhas excluídas
     */
    public function delete(
        string $comando_sql,
        array $dados = []
    ): int {
        $data = $this->conecta()->prepare($comando_sql);

        // executa o comando SQL
        $data->execute($dados);

        return $data->rowCount();
    }
}
