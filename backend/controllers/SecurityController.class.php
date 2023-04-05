<?php

require_once 'AppController.class.php';
require_once __DIR__ .'/../models/User.class.php';
require_once __DIR__ ."/../database/UserDatabase.class.php";
require_once __DIR__ ."/../database/QuizDatabase.class.php";
require_once __DIR__ ."/../database/QuestionDatabase.class.php";


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
        if(isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["is_public"])){
            $title = $_POST["title"];
            $category = $_POST["category"];
            $is_public = $_POST["is_public"];
            //get thumbnail file and save it to server folder /uploads/user_id
            
            if(!file_exists(__DIR__ ."/../uploads/user".$_SESSION["user"])){
                mkdir(__DIR__ ."/../uploads/user".$_SESSION["user"], 0777, true);
            }
            $thumbnail_url = null;
            $thumbnail = $_FILES["thumbnail"];
            if($thumbnail["name"]){
                $thumbnail_name = $thumbnail["name"];
                $thumbnail_tmp_name = $thumbnail["tmp_name"];
                $thumbnail_size = $thumbnail["size"];
                $thumbnail_error = $thumbnail["error"];
                $thumbnail_type = $thumbnail["type"];
                $thumbnail_ext = explode('.', $thumbnail_name);
                $thumbnail_actual_ext = strtolower(end($thumbnail_ext));
                $allowed = array('jpg', 'jpeg', 'png');
                if(in_array($thumbnail_actual_ext, $allowed)){
                    if($thumbnail_error === 0){
                        if($thumbnail_size < 100000){
                            $thumbnail_name_new = uniqid('', true).".".$thumbnail_actual_ext;
                            $thumbnail_destination = __DIR__ ."/../uploads/user".$_SESSION["user"]."/".$thumbnail_name_new;
                            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination);
                        }
                        else{
                            $messages[] = "Your file is too big";
                            return $this->render('create', ['messages' => $messages]);
                        }
                    }
                    else{
                        $messages[] = "There was an error uploading your file";
                        return $this->render('create', ['messages' => $messages]);
                    }
                }
                else{
                    $messages[] = "You cannot upload files of this type";
                    return $this->render('create', ['messages' => $messages]);
                }
                $thumbnail_url = "uploads/user".$_SESSION["user"]."/".$thumbnail_name_new;
            }


            $quizDatabase = new QuizDatabase();
            $quiz = $quizDatabase->CreateQuiz($title, $category, $is_public,$thumbnail_url);

            if($quiz){
                $quiz_id = $quiz->id;
                $questionDatabase = new QuestionDatabase();

                $question_count = $_POST['question_count'];
                for($i = 0; $i < $question_count; $i++){
                    $question = $_POST['question-'.$i];
                    $answer = $_POST['answer-'.$i];
                    //if answer is array create json from it
                    if(is_array($answer)){
                        $answer = json_encode($answer);
                    }
                    $questionDatabase->addQuestion($quiz_id, $question, $answer,1 ,1);
                    
                }
            }

            if($quiz != null){
                $_SESSION["quiz"] = $quiz;
                header("Location: /");
            }
            else{
                $messages[] = "Quiz with this title already exists";
                return $this->render('create', ['messages' => $messages]);
            }
        }
        else{
            $messages[] = "Fill all fields";
            return $this->render('create', ['messages' => $messages]);
        }
    }

}