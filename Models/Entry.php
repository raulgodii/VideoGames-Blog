<?php

namespace Models;

use Repositories\EntryRepository;

/**
 * Clase que representa la entidad de entrada (Entry).
 */
class Entry {
    private EntryRepository $EntryRepository;

    /**
     * Constructor de la clase Entry.
     */
    public function __construct() {
        $this->EntryRepository = new EntryRepository();
    }

    /**
     * Obtiene todas las entradas.
     *
     * @return array|null Arreglo de entradas o null si no hay entradas.
     */
    public function getAll(): ?array {
        return $this->EntryRepository->getAll();
    }

    /**
     * Guarda una nueva entrada.
     *
     * @param array $newEntry Nueva entrada a guardar.
     */
    public function saveEntry(array $newEntry): void {
        $this->EntryRepository->saveEntry($newEntry);
    }

    /**
     * Elimina una entrada por su ID.
     *
     * @param mixed $idEntry ID de la entrada a eliminar.
     */
    public function deleteEntry($idEntry): void {
        $this->EntryRepository->deleteEntry($idEntry);
    }

    /**
     * Actualiza una entrada.
     *
     * @param array $updateEntry Datos actualizados de la entrada.
     */
    public function updateEntry(array $updateEntry): void {
        $this->EntryRepository->updateEntry($updateEntry);
    }

    /**
     * Valida una nueva entrada.
     *
     * @param array $newEntry Datos de la nueva entrada a validar.
     * @return bool True si la entrada es válida, false en caso contrario.
     */
    public function validateEntry(array $newEntry): bool {
        // Validar título
        if (!isset($newEntry['title']) || !is_string($newEntry['title'])) {
            return false;
        }

        $trimmedTitle = trim($newEntry['title']);

        // Longitud válida para el título
        $minTitleLength = 3;
        $maxTitleLength = 100;
        if (strlen($trimmedTitle) < $minTitleLength || strlen($trimmedTitle) > $maxTitleLength) {
            return false; 
        }

        // Caracteres válidos para el título
        if (preg_match('/[\'";]/', $trimmedTitle)) {
            return false;
        }

        // Validar descripción
        if (!isset($newEntry['description']) || !is_string($newEntry['description'])) {
            return false;
        }

        $trimmedDescription = trim($newEntry['description']);

        // Longitud válida para la descripción
        $minDescriptionLength = 5;
        $maxDescriptionLength = 500; 
        if (strlen($trimmedDescription) < $minDescriptionLength || strlen($trimmedDescription) > $maxDescriptionLength) {
            return false; 
        }

        // Caracteres válidos para la descripción
        if (preg_match('/[\'";]/', $trimmedDescription)) {
            return false;
        }

        // Validar category_id
        if (!isset($newEntry['category_id']) || !is_numeric($newEntry['category_id'])) {
            return false;
        }

        return true;  // Todos los campos son válidos
    }

    /**
     * Sanitiza los datos de una entrada.
     *
     * @param array $newEntry Datos de la entrada a sanitizar.
     * @return array Datos de la entrada sanitizados.
     */
    public function sanitizeEntry(array $newEntry): array {
        $sanitizedEntry = [];

        foreach ($newEntry as $key => $value) {
            // Sanitiza cada campo utilizando htmlspecialchars
            $sanitizedEntry[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        return $sanitizedEntry;
    }
}
