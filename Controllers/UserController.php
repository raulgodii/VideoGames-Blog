<?php

namespace Controllers;

use Models\User;
use Lib\Pages;
use Utils\Utils;
use Repositories\UserRepository;

/**
 * Controlador para gestionar las operaciones relacionadas con los usuarios.
 */
class UserController {
    private Pages $pages;
    private UserRepository $userRepository;

    /**
     * Constructor de la clase UserController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->userRepository = new UserRepository();
    }

    /**
     * Registra un nuevo usuario.
     */
    public function register(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $userReg = $_POST['data'];

                // Validación y sanitización del usuario.
                if (User::validSanitizeUser($userReg)) {
                    $userReg['password'] = password_hash($userReg['password'], PASSWORD_BCRYPT, ['cost' => 4]);

                    $user = User::fromArray($userReg);

                    // Registro del usuario en la base de datos.
                    $save = $this->userRepository->registerUser($user);

                    if ($save) {
                        $_SESSION['register'] = "complete";
                    } else {
                        $_SESSION['register'] = "failed";
                    }
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        }

        // Renderiza la vista de registro.
        if (isset($userReg)) {
            $this->pages->render('User/Register', ['user' => $userReg]);
        } else {
            $this->pages->render('User/Register');
        }
    }

    /**
     * Realiza el proceso de inicio de sesión.
     */
    public function login(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $login = $_POST['data'];

                $userLog = User::fromArray($login);

                // Intento de inicio de sesión.
                $identity = $this->userRepository->login($userLog);

                if ($identity && is_object($identity)) {
                    $_SESSION['login'] = $identity;
                } else {
                    $this->userRepository->close();
                    $this->pages->render("User/Login", ["errorLogin" => true, "email" => $userLog->getEmail()]);
                }

                $this->userRepository->close();
            } else {
                $this->pages->render("User/Login", ["errorLogin" => true]);
            }
        }

        // Renderiza la vista de inicio de sesión.
        $this->pages->render('User/Login');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(): void {
        Utils::deleteSession('login');

        header("Location:" . BASE_URL);
    }

    /**
     * Obtiene un usuario a partir de su ID.
     *
     * @param int $user_id ID del usuario.
     * @return array|null Arreglo con la información del usuario o null si no se encuentra.
     */
    public function getUserFromId(int $user_id): ?array {
        $this->userRepository = new UserRepository();
        return $this->userRepository->getUserFromId($user_id);
    }

    /**
     * Muestra la página de gestión de perfil de usuario.
     */
    public function manageProfile(): void {
        $this->pages->render("User/ManageProfile");
    }

    /**
     * Muestra la página de edición de perfil de usuario.
     */
    public function editProfile(): void {
        $this->pages->render("User/ManageProfile", ["editProfile" => true]);
    }

    /**
     * Actualiza la información del usuario.
     */
    public function updateUser(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['updateUser']) {
                $updateUser = $_POST['updateUser'];

                // Validación y sanitización de la información del usuario.
                if (User::validSanitizeUser($updateUser)) {
                    $update = $this->userRepository->updateUser($updateUser);

                    if ($update) {
                        $userLog = User::fromArray($updateUser);

                        $this->userRepository = new UserRepository();

                        // Actualiza la sesión del usuario.
                        $identity = $this->userRepository->updateLogin($userLog);

                        if ($identity && is_object($identity)) {
                            $_SESSION['login'] = $identity;
                        } else {
                            $this->userRepository->close();
                            $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                        }
                    } else {
                        $this->userRepository->close();
                        $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                    }
                } else {
                    $this->userRepository->close();
                    $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                }

                $this->userRepository->close();
            } else {
                $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
            }
        }

        // Renderiza la vista de gestión de perfil de usuario.
        $this->pages->render("User/ManageProfile");
    }
}
