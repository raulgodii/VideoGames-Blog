<?php

namespace Repositories;

use Lib\DataBase;

/**
 * Repositorio para gestionar operaciones relacionadas con la tabla 'entries' en la base de datos.
 */
class EntryRepository
{
    private DataBase $connection;

    /**
     * Constructor de la clase EntryRepository.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        $this->connection = new DataBase();
    }

    /**
     * Obtiene todas las entradas de la base de datos.
     *
     * @return array|null Lista de entradas o null si no hay entradas.
     */
    public function getAll(): ?array
    {
        $this->connection->query("SELECT * FROM entries ORDER BY id ASC");

        $entries = $this->connection->extractAll();
        $this->connection->close();
        return $entries;
    }

    /**
     * Guarda una nueva entrada en la base de datos.
     *
     * @param array $newEntry Datos de la nueva entrada.
     */
    public function saveEntry(array $newEntry): void
    {
        $userId = $_SESSION['login']->id;
        $categoryId = $newEntry["category_id"];
        $title = $newEntry["title"];
        $description = $newEntry["description"];

        $this->connection->query("INSERT INTO entries (user_id, category_id, title, description, date) VALUES ($userId, $categoryId, \"$title\", \"$description\", CURRENT_DATE())");
        $this->connection->close();
    }

    /**
     * Elimina una entrada de la base de datos.
     *
     * @param int $idEntry ID de la entrada a eliminar.
     */
    public function deleteEntry(int $idEntry): void
    {
        $this->connection->query("DELETE FROM entries WHERE id = $idEntry");
        $this->connection->close();
    }

    /**
     * Actualiza una entrada en la base de datos.
     *
     * @param array $updateEntry Datos actualizados de la entrada.
     */
    public function updateEntry(array $updateEntry): void
    {
        $userId = $_SESSION['login']->id;
        $title = $updateEntry["title"];
        $categoryId = $updateEntry["category_id"];
        $description = $updateEntry["description"];
        $entryId = $updateEntry["id"];

        $this->connection->query("UPDATE entries SET user_id=$userId, title=\"$title\", category_id=$categoryId, description=\"$description\", date=CURRENT_DATE() WHERE id=$entryId");
        $this->connection->close();
    }
}
