<?php

namespace Repositories;

use FTP\Connection;
use Lib\DataBase;

class EntryRepository
{
    private DataBase $connection;

    function __construct()
    {
        $this->connection = new DataBase();
    }

    public function getAll(): ? array{
        $this->connection->query("SELECT * FROM entries ORDER BY id ASC");
        
        $categories = $this->connection->extractAll();
        $this->connection->close();
        return $categories;
    }

    public function saveEntry($newEntry): void{
        $this->connection->query("INSERT INTO entries (user_id, category_id, title, description, date) VALUES ({$_SESSION['login']->id}, \"{$newEntry["category_id"]}\", \"{$newEntry["title"]}\", \"{$newEntry["description"]}\", CURRENT_DATE())");
        $this->connection->close();
    }

    public function deleteEntry($idEntry){
        $this->connection->query("DELETE FROM entries WHERE id = $idEntry");
        $this->connection->close();
    }

    public function updateEntry($updateEntry){
        $this->connection->query("UPDATE entries SET user_id={$_SESSION['login']->id}, title=\"{$updateEntry["title"]}\", category_id=\"{$updateEntry["category_id"]}\", description = \"{$updateEntry["description"]}\", date=CURRENT_DATE() WHERE id={$updateEntry["id"]}");
        $this->connection->close();
    }
}