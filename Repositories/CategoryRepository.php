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

    public function getCategoryFromId($category_id){
        $this->connection->query("SELECT name FROM categories WHERE id=$category_id");
        $category = $this->connection->extractAll();
        $this->connection->close();
        return $category;
    }

    public function showEntriesFromCategorie($category_id){
        $this->connection->query("SELECT * FROM entries WHERE category_id=$category_id ORDER BY id DESC");
        $entries = $this->connection->extractAll();
        $this->connection->close();
        return $entries;
    }

    public function showLastEntries(){
        $this->connection->query("SELECT * FROM entries ORDER BY id DESC  LIMIT 5");
        $entries = $this->connection->extractAll();
        $this->connection->close();
        return $entries;
    }
}