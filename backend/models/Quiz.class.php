<?php 
require_once "backend/models/Question.class.php";
class Quiz {
    private $id;
    private $created_at;
    private $user_id;

    public $title;
    public $category;
    public $thumbnail;
    public $questions;


    public function __construct($quiz_id){

        //create QuizDatabase object
        $quizDatabase = new QuizDatabase();
        //get quiz from database
        $quiz = $quizDatabase->getQuizById($quiz_id);

        //set quiz properties
        $this->id = $quiz->id;
        $this->title = $quiz->title;
        $this->category = $quiz->category;
        $this->created_at = $quiz->created_at;
        $this->user_id = $quiz->user_id;
        $this->thumbnail = $quiz->thumbnail;

        $this->questions = null;
        $questionsDatabase = new QuestionDatabase();
        $questions = $questionsDatabase->getQuestionsByQuizId($quiz->id);
        foreach($questions as $question){
            $this->questions[] = new Question($question);
        }
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    public function getCategory(): string 
    {
        return $this->category;
    }

    public function getCreatedAt(): string 
    {
        return $this->created_at;
    }

    public function getUserId(): int 
    {
        return $this->user_id;
    }

}

?>