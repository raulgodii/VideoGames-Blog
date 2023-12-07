<?php
namespace Controllers;
use Models\User;
use Lib\Pages;
use Utils\Utils;
use Repositories\UserRepository;

class UserController{
    private Pages $pages;
    private UserRepository $userRepository;

    public function __construct(){
        $this->pages = new Pages();
        $this->userRepository = new userRepository();
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['data']){
                $userReg = $_POST['data'];

                if(User::validSanitizeUser($userReg)){
                    $userReg['password'] = password_hash($userReg['password'], PASSWORD_BCRYPT, ['cost'=>4]);
                
                    $user = User::fromArray($userReg);
    
                    $save = $this->userRepository->registerUser($user);
                    if($save){
                        $_SESSION['register'] = "complete";
                    } else{
                        $_SESSION['register'] = "failed";
                    }
                } else{
                    $_SESSION['register'] = "failed";
                }
            }else {
                $_SESSION['register'] = "failed";
            }
        } 

        if(isset($userReg)){
            $this->pages->render('User/Register', ['user' => $userReg]);
        } else {
            $this->pages->render('User/Register');
        }
        
    }

    public function login(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($_POST['data']){
                
                $login = $_POST['data'];

                $userLog = User::fromArray($login);

                $identity = $this->userRepository->login($userLog);

                if($identity && is_object($identity)){
                    $_SESSION['login'] = $identity;
                } else {
                    $this->userRepository->close();
                    $this->pages->render("User/Login", ["errorLogin" => true, "email"=>$userLog->getEmail()]);
                }
                
                $this->userRepository->close();
            }
            else {
                $this->pages->render("User/Login", ["errorLogin" => true]);
            }
        } 

        $this->pages->render('User/Login');
    }

    public function logout(){
        Utils::deleteSession('login');

        header("Location:".BASE_URL);
    }

    public function getUserFromId($user_id){
        $this->userRepository = new UserRepository();
        return $this->userRepository->getUserFromId($user_id);
    }

    public function manageProfile(){
        $this->pages->render("User/ManageProfile");
    }

    public function editProfile(){
        $this->pages->render("User/ManageProfile", ["editProfile" => true]);
    }

    public function updateUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($_POST['updateUser']){
                
                $updateUser = $_POST['updateUser'];

                if(User::validSanitizeUser($updateUser)){
                    $update = $this->userRepository->updateUser($updateUser);
                    if($update){
                        $userLog = User::fromArray($updateUser);
                        
                        $this->userRepository = new UserRepository();

                        $identity = $this->userRepository->updateLogin($userLog);

                        if($identity && is_object($identity)){
                            $_SESSION['login'] = $identity;
                        } else {
                            $this->userRepository->close();
                            $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                        }
                    } else{
                        $this->userRepository->close();
                        
                        $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                    }
                } else{
                    $this->userRepository->close();
                    $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
                }
                
                $this->userRepository->close();
            }
            else {
                $this->pages->render("User/ManageProfile", ["errorUpdateUser" => true]);
            }
        } 
        $this->pages->render("User/ManageProfile");
    }
}