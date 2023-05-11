<?php

require_once 'AppController.class.php';
require_once __DIR__ .'/../models/User.class.php';
require_once __DIR__ ."/../database/UserDatabase.class.php";
require_once __DIR__ ."/../database/QuizDatabase.class.php";
require_once __DIR__ ."/../database/QuestionDatabase.class.php";
require_once __DIR__ ."/FileController.class.php";
require_once __DIR__ ."/../database/OwnerDatabase.class.php";
require_once __DIR__ ."/quiz/QuizFasade.class.php";
session_start();

class SecurityController extends AppController {

    public function login()
    {   

        if (!$this->isPost()) {
            return $this->render('login');
        }

        if(isset($_POST["login_email"])){
            $email = $_POST["login_email"];
            $password = $_POST["login_password"];
            $userDatabase = new userDatabase();
            $user = $userDatabase->LoginUser($email, $password);
            
            if($user != null){
                $_SESSION["user"] = $user;
                header("Location: /");
            }
            else{
                $messages[] = "Wrong email or password";
                return $this->render('login', ['messages' => $messages]);
            }
        }
        else{
            $messages[] = "Fill all fields";
            return $this->render('login', ['messages' => $messages]);
        }
    }

    public function register(){
    
        if (!$this->isPost()) {
            return $this->render('register');
        }
        if(isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["display_name"])){
            $name = $_POST["login"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $display_name = $_POST["display_name"];
            $userDatabase = new userDatabase();
            $user = $userDatabase->RegisterUser($name, $email, $password, $display_name);
            
            if($user != null){
                $_SESSION["user"] = $user;
                header("Location: / ");
            }
            else{
                $messages[] = "Something went wrong";
                return $this->render('register', ['messages' => $messages]);
            }
        }
        else{
            $messages[] = "Fill all fields";
            return $this->render('register', ['messages' => $messages]);
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
    }

    public function create(){

        if(!$this->isPost()){
            return $this->render('create');
        }
        if(isset($_POST["title"]) && isset($_POST["category"])){
            
            $quizCreator = new QuizFasade();
            $quiz = $quizCreator->createQuiz($_POST, $_FILES);
            
            if($quiz != null){
                $_SESSION["quiz"] = $quiz;
                header("Location: /");
            }
            else{
                $messages[] = " Something went wrong";
                return $this->render('create', ['messages' => $messages]);
            }
        }
        else{
            $messages[] = "Fill all fields";
            return $this->render('create', ['messages' => $messages]);
        }
    }

}