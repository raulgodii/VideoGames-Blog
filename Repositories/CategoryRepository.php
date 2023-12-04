<?php

namespace Repositories;

use Lib\DataBase;

class CategoryRepository
{
    private DataBase $connection;

    function __construct()
    {
        $this->connection = new DataBase();
    }

    public function getAll(): ? array{
        $this->connection->query("SELECT * FROM categories ORDER BY id ASC");
        
        $categories = $this->connection->extractAll();
        $this->connection->close();
        return $categories;
    }

    public function saveCategory($newCategory): void{
        $this->connection->query("INSERT INTO categories (name) VALUES (\"$newCategory\")");
        $this->connection->close();
    }

    public function deleteCategory($idCategory){
        $this->connection->query("DELETE FROM categories WHERE id = $idCategory");
        $this->connection->close();
    }

    public function editCategory($idCategory, $nameCategory){
        $this->connection->query("UPDATE categories SET name='$nameCategory' WHERE id=$idCategory");
        $this->connection->close();
    }
}