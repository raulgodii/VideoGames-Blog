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

            if($this->Category->validCategory($newCategory)){
                $this->Category = new Category();
                $newCategory = $this->Category->sanitizeCategory($newCategory);
                $this->Category->saveCategory($newCategory);
                $this->pages->render("Category/manageCategories");
            } else {
                $this->pages->render("Category/manageCategories", ["errorCategory" => true]);
            }
        } else {
            $this->pages->render("Category/manageCategories");
        }
    }

    public function deleteCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $this->Category->deleteCategory($idCategory);
            $this->pages->render("Category/manageCategories");
        }
    }

    public function editCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $this->pages->render("Category/manageCategories", ["idCategoryEdit" => $idCategory]);
        }
    }

    public function editedCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $nameCategory = $_POST['nameCategory'];
            $this->Category->editCategory($idCategory, $nameCategory);
            $this->pages->render("Category/manageCategories");
        }
    }
}