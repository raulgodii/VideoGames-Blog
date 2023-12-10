<?php

namespace Repositories;

use Lib\DataBase;
use Models\User;
use PDO;
use PDOException;

class UserRepository
{
    private DataBase $connection;

    /**
     * UserRepository constructor.
     */
    function __construct()
    {
        $this->connection = new DataBase();
    }

    /**
     * Obtiene todos los usuarios.
     *
     * @return array
     */
    public function findAll(): array
    {
        $this->connection->query("SELECT * FROM contactos");
        return $this->extractAll();
    }

    /**
     * Extrae todos los usuarios del resultado de la consulta.
     *
     * @return array
     */
    public function extractAll(): array
    {
        $users = [];
        $usersData = $this->connection->extractAll();

        foreach ($usersData as $userData) {
            $users[] = User::fromArray($userData);
        }

        return $users;
    }

    /**
     * Extrae un usuario del resultado de la consulta.
     *
     * @return mixed|null
     */
    private function extractRegister()
    {
        return ($user = $this->connection->extractRegister()) ? User::fromArray($user) : null;
    }

    /**
     * Lee un usuario por su ID.
     *
     * @param int $id
     * @return mixed
     */
    public function read(int $id)
    {
        $consulta = "SELECT id, nombre, apellidos, date FROM users WHERE id= :id";
        $stmt = $this->connection->prepare($consulta);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->closeCursor();

        $stmt = null;

        return $this->extractRegister();
    }

    /**
     * Registra un nuevo usuario.
     *
     * @param User $user
     * @return bool
     */
    public function registerUser(User $user): bool
    {
        $id = null;
        $name = $user->getName();
        $last_name = $user->getLast_name();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $date = $user->getDate();

        try {
            $ins = $this->connection->prepare("INSERT INTO users (id, name, last_name, email, password, date) values (:id, :name, :last_name, :email, :password, :date)");
            $ins->bindValue(':id', $id);
            $ins->bindValue(':name', $name, PDO::PARAM_STR);
            $ins->bindValue(':last_name', $last_name, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);
            $ins->bindValue(':date', $date, PDO::PARAM_STR);

            $ins->execute();

            $result = true;
        } catch (PDOException $err) {
            $result = false;
        }

        return $result;
    }

    /**
     * Busca un usuario por su correo electrónico.
     *
     * @param string $email
     * @return bool|object
     */
    public function buscaMail(string $email): bool|object
    {
        try {
            $cons = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $cons->bindValue(':email', $email, PDO::PARAM_STR);
            $cons->execute();
            if ($cons && $cons->rowCount() == 1) {

                $result = $cons->fetch(PDO::FETCH_OBJ);
            } else {

                $result = false;
            }

        } catch (PDOException $err) {
            $result = false;
        }

        return $result;
    }

    /**
     * Inicia sesión de usuario.
     *
     * @param User $user
     * @return bool|object
     */
    public function login(User $user): bool|object
    {
        $result = false;
        $email = $user->getEmail();
        $password = $user->getPassword();

        $usuario = $this->buscaMail($email);

        if ($usuario !== false) {
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Actualiza la sesión de usuario.
     *
     * @param User $user
     * @return bool|object
     */
    public function updateLogin(User $user): bool|object
    {
        $result = false;
        $email = $user->getEmail();
        $password = $user->getPassword();

        $usuario = $this->buscaMail($email);

        if ($usuario !== false) {

            $result = $usuario;

        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Cierra la conexión.
     */
    public function close(): void
    {
        $this->connection->close();
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $user_id
     * @return mixed
     */
    public function getUserFromId(int $user_id)
    {
        $this->connection->query("SELECT name FROM users WHERE id=$user_id");

        $user = $this->connection->extractAll();
        $this->connection->close();

        return $user;
    }

    /**
     * Actualiza la información del usuario.
     *
     * @param array $updateUser
     * @return bool
     */
    public function updateUser(array $updateUser): bool
    {
        $result = true;
        try {
            $this->connection->query("UPDATE users SET name='{$updateUser['name']}', last_name='{$updateUser['last_name']}', email='{$updateUser['email']}', date='{$updateUser['date']}' WHERE id='{$updateUser['id']}'");
            $this->connection->close();

        } catch (PDOException $err) {
            $result = false;
        }

        return $result;
    }
}
