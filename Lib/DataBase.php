<?php
namespace Lib;
use PDO;
use PDOException;

class DataBase{
    private $connection;
    private mixed $result;

    function __construct(
        private string $server = SERVER,
        private string $user = USER,
        private string $pass = PASSWORD,
        private string $database= DATABASE
    ){
        $this->connection = $this->connect();
    }

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

    public function query(string $consultasQL): void
    {
        $this->result = $this->connection->query($consultasQL);
    }
    public function extractRegister(): mixed
    {
        return ( $fila=$this->result->fetch(PDO::FETCH_ASSOC ))? $fila:false;
    }

    public function extractAll(): array
    {
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function affectedRows(): int
    {
        return $this->result->rowCount();
    }

    public function close(){
        if ($this->connection !== null) {
            $this->connection = null;
        }
    }

    public function prepare($pre){
        return $this->connection->prepare($pre);
    }
}