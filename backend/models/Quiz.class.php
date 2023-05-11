<?php 
require_once __DIR__."/Question.class.php";
require_once __DIR__."/../database/QuizDatabase.class.php";
require_once __DIR__."/../database/QuestionDatabase.class.php";
class Quiz {
    private $id;
    private $user_id;

    public $title;
    public $category;
    public $thumbnail;
    public $questions;
    public $created_at;
    public $author;

    protected $quizDatabase;
    protected $questionDatabase;

    public function __construct($quiz_id){

        $quizDatabase = new QuizDatabase();
        $quiz = $quizDatabase->getQuizById($quiz_id);

        $this->id = $quiz->id;
        $this->title = $quiz->title;
        $this->category = $quiz->category;
        $this->created_at = $quiz->created_at;
        $this->user_id = $quiz->user_id;
        $this->thumbnail = $quiz->thumbnail;
        $this->author = $quiz->display_name;

        $this->questions = null;
        $questionsDatabase = new QuestionDatabase();
        $questions = $questionsDatabase->getQuestionsByQuizId($quiz->id);

        foreach($questions as $question){
            $this->questions[] = new Question();
            $this->questions[count($this->questions)-1]->loadData($question);
        }

    }

    public function getResults($post){
        $questionsDatabase = new QuestionDatabase();
        $questions = $questionsDatabase->getQuestionsByQuizId($this->id);
        $score = 0;
        $max_score = 0;

        foreach($questions as $key => $question){
            $max_score += $question->points;
            $isCorrect = false;

            if($question->type == "multiple"){
                $questionObject = new QuestionMultiple();
                $questionObject->loadData($question);
                $isCorrect = $questionObject->validateAnswer($post["chosen_answer".$key]);
            }else{
                $questionObject = new Question();
                $questionObject->loadData($question);
                $isCorrect = $questionObject->validateAnswer($post["chosen_answer".$key]);
            }
            if($isCorrect){
                $score += $questionObject->getPoints();
            }
        }
        return array("score" => $score, "max_score" => $max_score);
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

    public function getThumbnail(): string 
    {
        return "/backend/".$this->thumbnail;
    }

}

?>