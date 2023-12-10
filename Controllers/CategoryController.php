<?php
namespace Controllers;

use Models\Category;
use Lib\Pages;

/**
 * Controlador para la gestión de categorías en el blog de videojuegos.
 */
class CategoryController {
    private Pages $pages;
    private Category $Category;

    /**
     * Constructor de la clase CategoryController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->Category = new Category();
    }

    /**
     * Muestra la página de gestión de categorías.
     */
    public function manageCategories(): void {
        $this->pages->render("Category/manageCategories");
    }

    /**
     * Obtiene todas las categorías.
     *
     * @return array|null Arreglo de categorías o null si no hay categorías.
     */
    public function getAll(): ?array {
        return $this->Category->getAll();
    }

    /**
     * Guarda una nueva categoría.
     */
    public function saveCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newCategory = $_POST['newCategory'];

            if ($this->Category->validCategory($newCategory)) {
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

    /**
     * Elimina una categoría.
     */
    public function deleteCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $this->Category->deleteCategory($idCategory);
            $this->pages->render("Category/manageCategories");
        }
    }

    /**
     * Muestra la página de edición de categorías.
     */
    public function editCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $this->pages->render("Category/manageCategories", ["idCategoryEdit" => $idCategory]);
        }
    }

    /**
     * Edita una categoría existente.
     */
    public function editedCategory(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCategory = $_POST['idCategory'];
            $nameCategory = $_POST['nameCategory'];

            if ($this->Category->validCategory($nameCategory)) {
                $this->Category = new Category();
                $newCategory = $this->Category->sanitizeCategory($nameCategory);
                $this->Category->editCategory($idCategory, $nameCategory);
                $this->pages->render("Category/manageCategories");
            } else {
                $this->pages->render("Category/manageCategories", ["errorCategory" => true]);
            }
        }
    }

    /**
     * Obtiene el nombre de la categoría a partir de su ID.
     *
     * @param int $category_id ID de la categoría.
     * @return string Nombre de la categoría.
     */
    public function getCategoryFromId(int $category_id): string {
        $this->Category = new Category();
        $category = $this->Category->getCategoryFromId($category_id);
        return $category[0]["name"];
    }

    /**
     * Muestra las entradas asociadas a una categoría.
     */
    public function showEntriesFromCategorie(): void {
        $category_id = $_GET['category_id'];
        $category_name = $_GET['category_name'];
        $entries = $this->Category->showEntriesFromCategorie($category_id);
        $this->pages->render("Category/showEntriesFromCategorie", ["entries" => $entries, "category_name" => $category_name]);
    }

    /**
     * Muestra las últimas entradas en el blog.
     */
    public function showLastEntries(): void {
        $entries = $this->Category->showLastEntries();
        $this->pages->render("Category/showLastEntries", ["entries" => $entries]);
    }
}