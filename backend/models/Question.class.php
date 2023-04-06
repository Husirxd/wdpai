<?php

class Question{

    private $id;
    private $quiz_id;
    public $question;
    private $answers;
    private $points;
    private $correct_answer;

    public function __construct($question){

        //set question properties
        $this->id = $question->id;
        $this->quiz_id = $question->quiz_id;
        $this->question = $question->question;
        $this->answers = $question->answers;
        $this->points = $question->points;
        $this->correct_answer = $question->correct_answer;

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
}

?>