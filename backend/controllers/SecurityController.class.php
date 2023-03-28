<?php

require_once 'AppController.class.php';
require_once __DIR__ .'/../models/User.class.php';
require_once __DIR__ ."/../database/UserDatabase.class.php";

session_start();
class SecurityController extends AppController {

    public function login()
    {   

        if (!$this->isPost()) {
            return $this->render('login');
        }

        if(isset($_POST["email"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $userDatabase = new userDatabase();
            $user = $userDatabase->LoginUser($email, $password);
            //start user session
            if($user != null){
                
                $_SESSION["user"] = $user;
                header("Location: /");

            }
            else{
                $messages[] = "Wrong email or password";
                return $this->render('login', ['messages' => $messages]);
            }
        }   
    }

    public function register()
    {
    
        if (!$this->isPost()) {
            return $this->render('register');
        }
      
        if(isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["display_name"])){
            echo "register";
            $name = $_POST["login"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $display_name = $_POST["display_name"];
            $userDatabase = new userDatabase();
            $user = $userDatabase->RegisterUser($name, $email, $password, $display_name);
   
            if($user != null){
                $_SESSION["user"] = $user;
                header("Location: /");
            }
            else{
                $messages[] = "User with this email already exists";
                return $this->render('register', ['messages' => $messages]);
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
    }


}