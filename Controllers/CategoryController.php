<?php
namespace Controllers;
use Models\Category;
use Lib\Pages;
use Utils\Utils;

class CategoryController{
    private Pages $pages;
    private Category $Category;

    public function __construct(){
        $this->pages = new Pages();
        $this->Category = new Category();
    }

    public function manageCategories(): void{
        $this->pages->render("Category/manageCategories");
    }

    public function getAll(): ?array{
        return  $this->Category->getAll();
    }

    public function saveCategory():void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newCategory = $_POST['newCategory'];
            $this->Category->saveCategory($newCategory);
        }
        $this->pages->render("Category/manageCategories");
    }

    public function deleteCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deleteCategory = $_POST['deleteCategory'];
            $this->Category->deleteCategory($deleteCategory);
        }
        $this->pages->render("Category/manageCategories");
    }
}