<?php

require_once 'AppController.class.php';
require_once "backend/database/QuizDatabase.class.php";
class DefaultController extends AppController {

    public function index(){
        $this->render('index');
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
            if($thumbnail){
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