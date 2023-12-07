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

    public function __construct(string|null $id, string $name, string $last_name, string $email, string $password, string $date){
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

    public static function validSanitizeUser($data) {
        // Rules of validation
        $rules = array(
            'name' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'last_name' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'email' => FILTER_VALIDATE_EMAIL,
            'date' => array('filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'password' => array('filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        );
    
        $validData = filter_var_array($data, $rules);
    
        // Valid date format
        if (isset($validData['date']) && !self::validDateFormat($validData['date'])) {
            return false;
        }
    
        // Return valid and sanitize data
        return $validData;
    }
    
    // Valid Format Date (DD/MM/AAAA)
    public static function validDateFormat($date) {
        $pattern = "/^\d{4}-\d{2}-\d{2}$/";
        return preg_match($pattern, $date);
    }    

}