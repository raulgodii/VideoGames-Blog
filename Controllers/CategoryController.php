<?php
namespace Controllers;
use Models\Category;
use Lib\Pages;

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

            if($this->Category->validCategory($nameCategory)){
                $this->Category = new Category();
                $newCategory = $this->Category->sanitizeCategory($nameCategory);
                $this->Category->editCategory($idCategory, $nameCategory);
                $this->pages->render("Category/manageCategories");
            } else {
                $this->pages->render("Category/manageCategories", ["errorCategory" => true]);
            }
        }
    }

    public function getCategoryFromId($category_id){
        $this->Category = new Category();
        $category = $this->Category->getCategoryFromId($category_id);
        return $category[0]["name"];
    }

    public function showEntriesFromCategorie(){
        $category_id = $_GET['category_id'];
        $category_name = $_GET['category_name'];
        $entries = $this->Category->showEntriesFromCategorie($category_id);
        $this->pages->render("Category/showEntriesFromCategorie", ["entries" => $entries, "category_name" => $category_name]);
    }

    public function showLastEntries(){
        $entries = $this->Category->showLastEntries();
        $this->pages->render("Category/showLastEntries", ["entries" => $entries]);
    }
}