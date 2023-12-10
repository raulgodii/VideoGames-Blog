<?php
namespace Controllers;

use Models\Entry;
use Lib\Pages;

/**
 * Controlador para la gestión de entradas en el blog de videojuegos.
 */
class EntryController {
    private Pages $pages;
    private Entry $Entry;

    /**
     * Constructor de la clase EntryController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->Entry = new Entry();
    }

    /**
     * Muestra la página de gestión de entradas.
     */
    public function manageEntries(): void {
        $this->pages->render("Entry/manageEntries");
    }

    /**
     * Obtiene todas las entradas.
     *
     * @return array|null Arreglo de entradas o null si no hay entradas.
     */
    public function getAll(): ?array {
        return $this->Entry->getAll();
    }

    /**
     * Guarda una nueva entrada.
     */
    public function saveEntry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newEntry = $_POST['newEntry'];

            if ($this->Entry->validateEntry($newEntry)) {
                $this->Entry = new Entry();
                $newEntry = $this->Entry->sanitizeEntry($newEntry);
                $this->Entry->saveEntry($newEntry);
                $this->pages->render("Entry/manageEntries");
            } else {
                $this->pages->render("Entry/manageEntries", ["errorEntry" => true]);
            }
        } else {
            $this->pages->render("Entry/manageEntries");
        }
    }

    /**
     * Elimina una entrada.
     */
    public function deleteEntry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEntry = $_POST['idEntry'];
            $this->Entry->deleteEntry($idEntry);
            $this->pages->render("Entry/manageEntries");
        }
    }

    /**
     * Muestra la página de edición de entradas.
     */
    public function editEntry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editEntry = $_POST['editEntry'];
            $this->pages->render("Entry/addEntry", ["editEntry" => $editEntry]);
        }
    }

    /**
     * Actualiza una entrada existente.
     */
    public function updateEntry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateEntry = $_POST['updateEntry'];

            if ($this->Entry->validateEntry($updateEntry)) {
                $this->Entry = new Entry();
                $newEntry = $this->Entry->sanitizeEntry($updateEntry);
                $this->Entry->updateEntry($newEntry);
                $this->pages->render("Entry/manageEntries");
            } else {
                $this->pages->render("Entry/manageEntries", ["errorEntry" => true]);
            }
        }
    }

    /**
     * Muestra la página para agregar una nueva entrada.
     */
    public function addEntry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->pages->render("Entry/addEntry");
        }
    }
}
