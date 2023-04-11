<?php

require_once 'AppController.class.php';
require_once __DIR__ .'/../models/User.class.php';
require_once __DIR__ ."/../database/UserDatabase.class.php";
require_once __DIR__ ."/../database/QuizDatabase.class.php";
require_once __DIR__ ."/../database/QuestionDatabase.class.php";
require_once __DIR__ ."/FileController.class.php";
require_once __DIR__ ."/../database/OwnerDatabase.class.php";


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
            $title = $_POST["title"];
            $category = $_POST["category"];
            $is_public = isset($_POST["is_public"]) ? 1 : 0;
            //get thumbnail file and save it to server folder /uploads/user_id
     
            $fileManager = FileManager::getInstance();
            $thumbnail_url = null;
            $thumbnail = $_FILES["thumbnail"];
            
            $thumbnail_url =  $fileManager->uploadFile($thumbnail, $_SESSION["user"]);

            $quizDatabase = new QuizDatabase();
            
            $quiz = $quizDatabase->CreateQuiz($title, $category, $is_public, $thumbnail_url);

            if($quiz){
                $quiz_id = $quiz->id;

                $ownershipDatabase = new OwnerDatabase();
                $ownershipDatabase->addOwnership($quiz_id,$_SESSION["user"], 1);

                $questionDatabase = new QuestionDatabase();

                $question_count = $_POST['question_count'];
                for($i = 0; $i < $question_count; $i++){
                    $question = $_POST['question-'.$i];
                    $answer = $_POST['answer-'.$i];
                    $correct = $_POST['correct-'.$i];
                    $points = $_POST['points-'.$i];
                    //if answer is array create json from it
                    if(is_array($answer)){
                        $answer = json_encode($answer);
                    }
                    if(isset($_FILES['image_url-'.$i])){
                        $question_image = $_FILES['image_url-'.$i];
                        $question_image =  $fileManager->uploadFile($question_image, $_SESSION["user"]);
                    }
                    else{
                        $question_image = null;
                    }
                    $questionDatabase->addQuestion($quiz_id, $question, $answer,$points , $correct, $question_image);
                }
            }

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