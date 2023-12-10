<?php

namespace Repositories;

use Lib\DataBase;

/**
 * Repositorio para gestionar operaciones relacionadas con la tabla 'categories' en la base de datos.
 */
class CategoryRepository
{
    private DataBase $connection;

    /**
     * Constructor de la clase CategoryRepository.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        $this->connection = new DataBase();
    }

    /**
     * Obtiene todas las categorías de la base de datos.
     *
     * @return array|null Lista de categorías o null si no hay categorías.
     */
    public function getAll(): ?array
    {
        $this->connection->query("SELECT * FROM categories ORDER BY id ASC");

        $categories = $this->connection->extractAll();
        $this->connection->close();
        return $categories;
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     *
     * @param string $newCategory Nombre de la nueva categoría.
     */
    public function saveCategory(string $newCategory): void
    {
        $this->connection->query("INSERT INTO categories (name) VALUES (\"$newCategory\")");
        $this->connection->close();
    }

    /**
     * Elimina una categoría de la base de datos.
     *
     * @param int $idCategory ID de la categoría a eliminar.
     */
    public function deleteCategory(int $idCategory): void
    {
        // Assuming $idCategory is the ID of the category to be deleted
        // Elimina las entradas de la categoria
        $this->connection->query("DELETE FROM entries WHERE category_id = $idCategory");

        // Elimina la categoria
        $this->connection->query("DELETE FROM categories WHERE id = $idCategory");

        $this->connection->close();
    }

    /**
     * Edita una categoría en la base de datos.
     *
     * @param int    $idCategory   ID de la categoría a editar.
     * @param string $nameCategory Nuevo nombre de la categoría.
     */
    public function editCategory(int $idCategory, string $nameCategory): void
    {
        $this->connection->query("UPDATE categories SET name='$nameCategory' WHERE id=$idCategory");
        $this->connection->close();
    }

    /**
     * Obtiene el nombre de una categoría a partir de su ID.
     *
     * @param int $category_id ID de la categoría.
     * @return array|null Nombre de la categoría o null si no se encuentra.
     */
    public function getCategoryFromId(int $category_id): ?array
    {
        $this->connection->query("SELECT name FROM categories WHERE id=$category_id");
        $category = $this->connection->extractAll();
        $this->connection->close();
        return $category;
    }

    /**
     * Obtiene todas las entradas de una categoría.
     *
     * @param int $category_id ID de la categoría.
     * @return array Lista de entradas de la categoría.
     */
    public function showEntriesFromCategorie(int $category_id): array
    {
        $this->connection->query("SELECT * FROM entries WHERE category_id=$category_id ORDER BY id DESC");
        $entries = $this->connection->extractAll();
        $this->connection->close();
        return $entries;
    }

    /**
     * Obtiene las últimas 5 entradas de la base de datos.
     *
     * @return array Lista de las últimas 5 entradas.
     */
    public function showLastEntries(): array
    {
        $this->connection->query("SELECT * FROM entries ORDER BY id DESC LIMIT 5");
        $entries = $this->connection->extractAll();
        $this->connection->close();
        return $entries;
    }
}
