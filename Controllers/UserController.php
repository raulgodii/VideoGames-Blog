<?php
namespace Controllers;
use Models\User;
use Lib\Pages;

class UsuarioController{
    private Pages $pages;

    public function __construct(){
        $this->pages = new Pages();
    }

    public function registro(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['data']){
                $registrado = $_POST['data'];

                // Podemos validar aqui si los metodos validar y sanitizar son estaticos

                $registrado['password'] = password_hash($registrado['password'], PASSWORD_BCRYPT, ['cost'=>4]);

                $usuario = User::fromArray($registrado);

                // Validar
                // $errores = $usuario->validar()
                // if(empty($errores)){
                    //$atributos = $usuario->sanititizar();
                //}

                // Sanear

                $save = $usuario->save();
                if($save){
                    $_SESSION['register'] = "complete";
                } else{
                    $_SESSION['register'] = "failed";
                }
            }
        } else {
            $_SESSION['register'] = "failed";
        }

        $this->pages->render('Usuario/registro');
    }
}