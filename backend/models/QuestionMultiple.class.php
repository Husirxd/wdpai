<?php

require_once __DIR__."/../database/QuestionDatabase.class.php";
require_once __DIR__."/Question.class.php";

class QuestionMultiple extends Question{

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
        $question["answer"] = rtrim($question["answer"], ',');
        $questionDatabase->addQuestion($quiz_id, $question["question"], $question["answer"], $question["points"], $question["correct"], $image_url, "multiple");
        return $question;
    }

    public function validateAnswer($answer){
        $answer = explode(",", $answer);
        $correct_answer = explode(",", $this->correct_answer);
        return count($answer) == count($correct_answer) && empty(array_diff($answer, $correct_answer));
    }

}



?>