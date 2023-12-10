<?php

namespace Lib;

/**
 * Clase para renderizar páginas y manejar parámetros en las vistas.
 */
class Pages {
    /**
     * Renderiza una página con parámetros opcionales.
     *
     * @param string $pageName Nombre de la plantilla (archivo) a renderizar.
     * @param array|null $params Arreglo asociativo de variables para pasar a la vista.
     */
    public function render(string $pageName, ?array $params = null): void {
        /*
         * $pageName es el nombre de nuestra plantilla. El nombre del fichero que se pretende mostrar (sin la extensión).
         * Por ejemplo, "baraja".
         * $params es un array asociativo que contiene las variables que se desean pasar a la vista.
         * Para crear las variables, recorremos la lista y usamos el índice como nombre de variable usando la propiedad
         * variable de PHP ($$name = $value).
         */

        // Verifica si hay parámetros y los asigna como variables locales.
        if ($params !== null) {
            extract($params);
        }

        // Incluye los archivos de encabezado, contenido y pie de página.
        require_once "Views/layout/header.php";
        require_once "Views/$pageName.php"; // incluimos la página indicada
        require_once "Views/layout/footer.php";
    }
}
