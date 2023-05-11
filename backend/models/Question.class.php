<?php

require_once __DIR__."/../database/QuestionDatabase.class.php";
require_once __DIR__."/../controllers/FileController.class.php";

class Question{

    protected $id;
    protected $quiz_id;
    public  $question;
    protected $answers;
    protected $correct_answer;
    public $image_url;

    public function __construct(){

        //set question properties


    }

    public function loadData($question){
        $this->id = $question->id;
        $this->quiz_id = $question->quiz_id;
        $this->question = $question->question;
        $this->answers = $question->answers;
        $this->points = $question->points;
        $this->correct_answer = $question->correct_answer;
        $this->image_url = $question->image_url;
    }

    public function getId(): int 
    {
        return $this->id;
    }
    public function getAnswers(){
        $this->answers = json_decode($this->answers);
        return $this->answers;
    }
    public function getPoints(){
        return $this->points;
    }
    public function getCorrectAnswer(){
        return $this->correct_answer;
    }

    public function getImageUrl(){
        return "/backend/".$this->image_url;
    }

    public function createQuestion ($question, $quiz_id, $user_id){ 
        if($question["file"]){
            $image_url = $this->createImageFile($question["file"], $user_id);
        }else{
            $image_url = null;
        }
        $questionDatabase = new QuestionDatabase();
        
        if(is_array($question["answer"])){
        $question["answer"] = json_encode($question["answer"]);
        }

        $questionDatabase->addQuestion($quiz_id, $question["question"], $question["answer"], $question["points"], $question["correct"], $image_url, "single");
        return $question;
    }

    public function validateAnswer($answer){
        $answer = explode(",", $answer);
        $correct_answer = $this->correct_answer;
        return count ($answer) - 1 == 1 && in_array($correct_answer, $answer);
    }

    public function createImageFile($file, $user_id){
        $fileManager = FileManager::getInstance();
        $image_url = $fileManager->uploadFile($file, $user_id);
        return $image_url;
    }

}

?>