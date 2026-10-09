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
     * @return object
     */
    public function conecta()
    {
        if (self::$conexao instanceof PDO) {
            return self::$conexao;
        }

        $dsn = self::$dbConfigaraConexao['DB_DRIVE'] .
                ":host=" . self::$dbConfigaraConexao['DB_HOST'] .
                ";port=" . self::$dbConfigaraConexao['DB_PORT'] .
                ";dbname=" . self::$dbConfigaraConexao['DB_BASEDADOS'];

        try {
            self::$conexao = new PDO(
                $dsn,
                self::$dbConfigaraConexao['DB_USER'],         // usuário
                self::$dbConfigaraConexao['DB_PASSWORD'],     // senha
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            //configurando o modo de tratamento de erro
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\Exception $ex) {
            echo $ex->getMessage();
            self::$conexao = null;
        }

        return self::$conexao;
    }

    /**
     * select
     *
     * @param string $comando_sql 
     * @param array $dados 
     * @param string $tipoRetorno 
     * @return array
     */
    public function select(
        string $comando_sql, 
        array $dados = [],
        string $tipoRetorno = 'all'
    ) {
        $conn = $this->conecta();
        $data = $conn->prepare($comando_sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );

        // executa o comando SQL
        $data->execute($dados);

        if ($tipoRetorno == 'all') {
            $dadosRows = $data->fetchAll();
        } else {
            $dadosRows = $data->fetch();
        }

        return $dadosRows;
    }

    /**
     * insert
     *
     * @param string $comando_sql 
     * @param array $dados 
     * @return int
     */
    public function insert(
        string $comando_sql, 
        array $dados = []
    ) {
        $conn = $this->conecta();
        $data = $conn->prepare($comando_sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );

        // executa o comando SQL
        $data->execute($dados);

        if ($conn->lastInsertId() > 0) {
            return $conn->lastInsertId();
        } else {
            return 0;
        }
    }

    /**
     * update
     *
     * @param string $comando_sql 
     * @param array $dados 
     * @return int
     */
    public function update(
        string $comando_sql, 
        array $dados = []
    ) {
        $conn = $this->conecta();
        $data = $conn->prepare($comando_sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );

        // executa o comando SQL
        $data->execute($dados);

        if ($data->rowCount() > 0) {
            return $data->rowCount();
        } else {
            return 0;
        }
    }

    /**
     * delete
     *
     * @param string $comando_sql 
     * @param array $dados 
     * @return int
     */
    public function delete(
        string $comando_sql, 
        array $dados = []
    ) {
        $conn = $this->conecta();
        $data = $conn->prepare($comando_sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );

        // executa o comando SQL
        $data->execute($dados);

        if ($data->rowCount() > 0) {
            return $data->rowCount();
        } else {
            return 0;
        }
    }
}