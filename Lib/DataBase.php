<?php
namespace Lib;

use PDO;
use PDOException;

class DataBase
{
    /**
     * @var PDO|null La conexión a la base de datos.
     */
    private $connection;

    /**
     * @var mixed|null El resultado de la consulta.
     */
    private mixed $result;

    /**
     * Constructor de la clase `DataBase`.
     *
     * @param string $server El servidor de la base de datos.
     * @param string $user El nombre de usuario para la conexión a la base de datos.
     * @param string $pass La contraseña para la conexión a la base de datos.
     * @param string $database El nombre de la base de datos.
     */
    function __construct(
        private string $server = SERVER,
        private string $user = USER,
        private string $pass = PASSWORD,
        private string $database = DATABASE
    ){
        $this->connection = $this->connect();
    }

    /**
     * Establece la conexión a la base de datos.
     *
     * @return PDO La instancia de la conexión PDO.
     */
    private function connect(): PDO {
        try {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES Utf8",
                PDO::MYSQL_ATTR_FOUND_ROWS => true
            );

            $connection = new PDO("mysql:host={$this->server};dbname={$this->database}", $this->user, $this->pass, $options);
            return $connection;
        } catch(PDOException $e){
            echo "There has been an error, and it's not possible to connect to the database. Details: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Ejecuta una consulta SQL.
     *
     * @param string $sqlQuery La consulta SQL a ejecutar.
     * @return void
     */
    public function query(string $sqlQuery): void
    {
        $this->result = $this->connection->query($sqlQuery);
    }

    /**
     * Extrae un registro de la consulta.
     *
     * @return mixed|array|false El registro extraído o `false` si no hay más registros.
     */
    public function extractRegister(): mixed
    {
        return ($row = $this->result->fetch(PDO::FETCH_ASSOC)) ? $row : false;
    }

    /**
     * Extrae todos los registros de la consulta.
     *
     * @return array Un array de registros extraídos.
     */
    public function extractAll(): array
    {
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el número de filas afectadas por la última consulta.
     *
     * @return int El número de filas afectadas.
     */
    public function affectedRows(): int
    {
        return $this->result->rowCount();
    }

    /**
     * Cierra la conexión a la base de datos.
     *
     * @return void
     */
    public function close()
    {
        if ($this->connection !== null) {
            $this->connection = null;
        }
    }

    /**
     * Prepara una sentencia SQL para su ejecución.
     *
     * @param string $pre La sentencia SQL a preparar.
     */
    public function prepare($pre){
        return $this->connection->prepare($pre);
    }
}