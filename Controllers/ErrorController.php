<?php

namespace Controllers;

/**
 * Controlador para manejar errores en la aplicación.
 */
class ErrorController {
    /**
     * Muestra el error 404 cuando la página no existe.
     */
    public static function show_error404(): void {
        echo "<h1>ERROR 404: La página que estás buscando no existe.</h1>";
    }
}
?>
