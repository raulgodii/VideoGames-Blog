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
}
