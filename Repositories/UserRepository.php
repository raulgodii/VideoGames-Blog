<?php

namespace Repositories;

use Lib\DataBase;
use Models\User;
use PDO;
use PDOException;

class ContactoRepository
{
    private DataBase $conexion;

    function __construct()
    {
        $this->conexion = new DataBase();
    }

    public function findAll()
    {
        $this->conexion->query("SELECT * FROM contactos");
        return $this->extractAll();
    }

    public function extractAll()
    {
        $contactos = [];
        $contactosData = $this->conexion->extractAll();

        foreach ($contactosData as $contactoData) {
            $contactos[] = User::fromArray($contactoData);
        }

        return $contactos;
    }

    private function extractRegister(){
        return ($Contacto = $this->conexion->extractRegister())?User::fromArray($Contacto):null;
    }

    public function read(int $id){
        $consulta = "SELECT id, nombre, apellidos, date FROM users WHERE id= :id";
        $stmt = $this->conexion->prepare($consulta);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->closeCursor();

        $stmt=null;

        return $this->extractRegister();
    }

    public function save(array $contacto):void {

    }
}