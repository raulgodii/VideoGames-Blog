<?php

namespace Repositories;

use Lib\DataBase;
use Models\User;
use PDO;
use PDOException;

class UserRepository
{
    private DataBase $connection;

    function __construct()
    {
        $this->connection = new DataBase();
    }

    public function findAll()
    {
        $this->connection->query("SELECT * FROM contactos");
        return $this->extractAll();
    }

    public function extractAll()
    {
        $contactos = [];
        $contactosData = $this->connection->extractAll();

        foreach ($contactosData as $contactoData) {
            $contactos[] = User::fromArray($contactoData);
        }

        return $contactos;
    }

    private function extractRegister(){
        return ($Contacto = $this->connection->extractRegister())?User::fromArray($Contacto):null;
    }

    public function read(int $id){
        $consulta = "SELECT id, nombre, apellidos, date FROM users WHERE id= :id";
        $stmt = $this->connection->prepare($consulta);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->closeCursor();

        $stmt=null;

        return $this->extractRegister();
    }

    public function registerUser($user): bool {
        $id = NULL;
        $name = $user->getname();
        $last_name = $user->getlast_name();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $date = $user->getDate();

        try{
            $ins = $this->connection->prepare("INSERT INTO users (id, name, last_name, email, password, date) values (:id, :name, :last_name, :email, :password, :date)");
            $ins->bindValue(':id', $id);
            $ins->bindValue(':name', $name, PDO::PARAM_STR);
            $ins->bindValue(':last_name', $last_name, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);
            $ins->bindValue(':date', $date, PDO::PARAM_STR);

            $ins->execute();
            
            $result = true;
        } catch(PDOException $err){
            $result = false;
        }

        return $result;
    }

    public function buscaMail($email): bool|object{
        
        try{
            $cons = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $cons->bindValue(':email', $email, PDO::PARAM_STR);
            $cons->execute();
            if($cons && $cons->rowCount() == 1){
                
                $result = $cons->fetch(PDO::FETCH_OBJ);
            }else{
                
                $result = false;
            }
            
        } catch(PDOException $err){
            $result = false;
        }

        return $result;
    }

    public function login($user): bool|object {
        $result = false;
        $email = $user->getEmail();
        $password = $user->getPassword();

        $usuario = $this->buscaMail($email);

        if($usuario !== false){
            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }
        return $result;
    }

    public function updateLogin($user): bool|object {
        $result = false;
        $email = $user->getEmail();
        $password = $user->getPassword();

        $usuario = $this->buscaMail($email);

        if($usuario !== false){

            $result = $usuario;

        }else{
            $result = false;
        }
        return $result;
    }

    public function close():void{
        $this->connection->close();
    }

    public function getUserFromId($user_id){
        $this->connection->query("SELECT name FROM users WHERE id=$user_id");
        
        $user_id = $this->connection->extractAll();
        $this->connection->close();
        return $user_id;
    }

    public function updateUser($updateUser){
        $result = true;
        try{
            $this->connection->query("UPDATE users SET name='{$updateUser['name']}', last_name='{$updateUser['last_name']}', email='{$updateUser['email']}', date='{$updateUser['date']}' WHERE id='{$updateUser['id']}'");
            $this->connection->close();
            
        } catch(PDOException $err){
            $result = false;
        }

        return $result;
    }
}