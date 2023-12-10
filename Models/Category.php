<?php

namespace Models;

use Repositories\CategoryRepository;

/**
 * Clase que representa la entidad de categoría.
 */
class Category {
    private $id;
    private $name;
    private CategoryRepository $CategoryRepository;

    /**
     * Constructor de la clase Category.
     */
    public function __construct() {
        $this->CategoryRepository = new CategoryRepository();
    }

    /**
     * Getter para el ID.
     *
     * @return mixed ID de la categoría.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Setter para el ID.
     *
     * @param mixed $id Nuevo ID de la categoría.
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * Getter para el nombre.
     *
     * @return mixed Nombre de la categoría.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Setter para el nombre.
     *
     * @param mixed $name Nuevo nombre de la categoría.
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * Obtiene todas las categorías.
     *
     * @return array|null Arreglo de categorías o null si no hay categorías.
     */
    public function getAll(): ?array {
        return $this->CategoryRepository->getAll();
    }

    /**
     * Guarda una nueva categoría.
     *
     * @param mixed $newCategory Nueva categoría a guardar.
     */
    public function saveCategory($newCategory): void {
        $this->CategoryRepository->saveCategory($newCategory);
    }

    /**
     * Elimina una categoría por su ID.
     *
     * @param mixed $idCategory ID de la categoría a eliminar.
     */
    public function deleteCategory($idCategory): void {
        $this->CategoryRepository->deleteCategory($idCategory);
    }

    /**
     * Edita una categoría por su ID.
     *
     * @param mixed $idCategory   ID de la categoría a editar.
     * @param mixed $nameCategory Nuevo nombre para la categoría.
     */
    public function editCategory($idCategory, $nameCategory): void {
        $this->CategoryRepository->editCategory($idCategory, $nameCategory);
    }

    /**
     * Valida una nueva categoría.
     *
     * @param mixed $newCategory Nueva categoría a validar.
     * @return bool True si la categoría es válida, false en caso contrario.
     */
    public function validCategory($newCategory): bool {
        // No vacío y es una cadena de texto
        if (empty($newCategory) || !is_string($newCategory)) {
            return false;
        }

        $trimmedCategory = trim($newCategory);

        // Longitud válida
        $minLength = 3;
        $maxLength = 20;
        if (strlen($trimmedCategory) < $minLength || strlen($trimmedCategory) > $maxLength) {
            return false; 
        }

        // Caracteres válidos
        if (preg_match('/[\'";]/', $trimmedCategory)) {
            return false;
        }

        // La categoría ya existe
        $array = $this->getAll();
        foreach ($array as $item) {
            if ($item["name"] === $newCategory) {
                return false;
            }
        }

        return true;  // Categoría válida
    }

    /**
     * Sanitiza el nombre de una categoría.
     *
     * @param mixed $newCategory Nombre de la categoría a sanitizar.
     * @return string Nombre de la categoría sanitizado.
     */
    public function sanitizeCategory($newCategory): string {
        $sanitizedCategory = htmlspecialchars($newCategory, ENT_QUOTES, 'UTF-8');
        $sanitizedCategory = filter_var($newCategory, FILTER_SANITIZE_SPECIAL_CHARS);

        return $sanitizedCategory;
    }

    /**
     * Obtiene una categoría por su ID.
     *
     * @param mixed $category_id ID de la categoría.
     * @return mixed|null Datos de la categoría o null si no se encuentra.
     */
    public function getCategoryFromId($category_id) {
        return $this->CategoryRepository->getCategoryFromId($category_id);
    }

    /**
     * Muestra las entradas de una categoría.
     *
     * @param mixed $category_id ID de la categoría.
     * @return mixed|null Arreglo de entradas de la categoría o null si no hay entradas.
     */
    public function showEntriesFromCategorie($category_id) {
        return $this->CategoryRepository->showEntriesFromCategorie($category_id);
    }

    /**
     * Muestra las últimas entradas de todas las categorías.
     *
     * @return mixed|null Arreglo de las últimas entradas o null si no hay entradas.
     */
    public function showLastEntries() {
        return $this->CategoryRepository->showLastEntries();
    }
}
