<?php

namespace Controllers;

/**
 * Controlador frontal que maneja las peticiones y dirige el flujo de la aplicación.
 */
class FrontController {
    /**
     * Función principal del controlador frontal que gestiona las peticiones.
     */
    public static function main(): void {
        // Verifica si se proporciona un controlador en la URL, de lo contrario usa el controlador por defecto.
        if (isset($_GET['controller'])) {
            $nombre_controlador = "Controllers\\" . $_GET["controller"] . "Controller";
        } else {
            $nombre_controlador = 'Controllers\\' . CONTROLLER_DEFAULT;
        }

        // Comprueba si la clase del controlador existe.
        if (class_exists($nombre_controlador)) {
            $controlador = new $nombre_controlador();

            // Verifica si se proporciona una acción en la URL y si la acción existe en el controlador.
            if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action();
            }
            // Si no se proporciona ni un controlador ni una acción, utiliza la acción por defecto.
            elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
                $action_default = ACTION_DEFAULT;
                $controlador->$action_default();
            }
            // Si no se encuentra la acción en el controlador, muestra un error 404.
            else {
                echo ErrorController::show_error404();
            }
        }
        // Si no se encuentra la clase del controlador, muestra un error 404.
        else {
            echo ErrorController::show_error404();
        }
    }
}
?>
