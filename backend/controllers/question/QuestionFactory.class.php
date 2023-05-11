<?php 

require_once __DIR__ ."/../../models/Question.class.php";
require_once __DIR__ ."/../../models/QuestionMultiple.class.php";

class QuestionFactory{

    public function createQuestion($question, $quiz_id, $user_id){
        switch($question["type"]){
            case "single":
                $single = new Question();
                return $single->createQuestion($question, $quiz_id, $user_id);
            case "multiple":
                $multiple = new QuestionMultiple();
                return $multiple->createQuestion($question, $quiz_id, $user_id);
            default:
                return null;
        }
    }
}
?>
