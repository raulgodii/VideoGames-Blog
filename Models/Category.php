<?php
namespace Models;
use Repositories\CategoryRepository;

class Category {
    private $id;
    private $name;
    private CategoryRepository $CategoryRepository;
    public function __construct(){
        $this->CategoryRepository = new CategoryRepository();
    }

    // Getter para el ID
    public function getId() {
        return $this->id;
    }

    // Setter para el ID
    public function setId($id) {
        $this->id = $id;
    }

    // Getter para el nombre
    public function getName() {
        return $this->name;
    }

    // Setter para el nombre
    public function setName($name) {
        $this->name = $name;
    }

    public function getAll(): ?array{
        return  $this->CategoryRepository->getAll();
    }
    
    public function saveCategory($newCategory):void{
        $this->CategoryRepository->saveCategory($newCategory);
    }

    public function deleteCategory($idCategory){
        $this->CategoryRepository->deleteCategory($idCategory);
    }

    public function editCategory($idCategory, $nameCategory){
        $this->CategoryRepository->editCategory($idCategory, $nameCategory);
    }

    public function validCategory($newCategory){
        // No empty and Is a string
        if (empty($newCategory) || !is_string($newCategory)) {
            return false;
        }

        $trimmedCategory = trim($newCategory);

        // Valid Length
        $minLength = 3;
        $maxLength = 20;
        if (strlen($trimmedCategory) < $minLength || strlen($trimmedCategory) > $maxLength) {
            return false; 
        }

        // Valid Characters
        if (preg_match('/[\'";]/', $trimmedCategory)) {
            return false;
        }

        // Category already exists
        $array = $this->getAll();
        foreach ($array as $item) {
            if ($item["name"] === $newCategory) {
                return false;
            }
        }

        return true;  // Valid Category
    }

    public function sanitizeCategory($newCategory){
        $sanitizedCategory = htmlspecialchars($newCategory, ENT_QUOTES, 'UTF-8');
        $sanitizedCategory = filter_var($newCategory, FILTER_SANITIZE_SPECIAL_CHARS);

        return $sanitizedCategory;
    }

    public function getCategoryFromId($category_id){
        return  $this->CategoryRepository->getCategoryFromId($category_id);
    }

    public function showEntriesFromCategorie($category_id){
        return $this->CategoryRepository->showEntriesFromCategorie($category_id);
    }

    public function showLastEntries(){
        return $this->CategoryRepository->showLastEntries();
    }
}
