<?php
namespace Models;

use Lib\DataBase;
use PDO;
use PDOException;
use DateTime;

class User{
    private string|null $id;
    private string $name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $date;

    private DataBase $db;

    public function __construct(string|null $id, string $name, string $last_name, string $email, string $password, string $date){
        $this->db = new DataBase();
        $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
    }

    public function getId(): string|null {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLast_name(): string {
        return $this->last_name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setLast_name(string $last_name): void {
        $this->last_name = $last_name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public static function fromArray(array $data): User {
        return new User(
            $data['id'] ?? null,
            $data['name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['date'] ?? ''
        );
    }

    public function validar(){

    }

    public function sanititizar(){

    }

}