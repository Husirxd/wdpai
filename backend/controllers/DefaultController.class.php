<?php

require_once 'AppController.class.php';
require_once "backend/models/Quiz.class.php";
require_once "backend/database/QuizDatabase.class.php";
class DefaultController extends AppController {

    public function index(){
        $this->render('index', ['title' => 'Kogoot - Home']);
    }

    public function quiz(){
        if(!$this->isPost()){
            $this->render('quiz', ['quiz' =>$_GET["quiz"]]);
            exit;
        }
    }

    public function archive(){
        $this->render('archive', ['title' => 'Kogoot - All Quizzes']);
    }

    public function results(){
        if(isset($_POST['quiz_id'])){
            $quizDatabase = new QuizDatabase();
            var_dump($_POST['quiz_id']);
            $quiz = new Quiz($_POST['quiz_id']);
            $questionsDatabase = new QuestionDatabase();
            $questions = $questionsDatabase->getQuestionsByQuizId($quiz->getId());
            $score = 0;
            $max_score = 0;
            foreach($questions as $key => $question){
                $max_score += $question->points;
                if($question->correct_answer == $_POST['chosen_answer'].$key){
                    $score += $question->points;
                }
            }
            $this->render('results', ['quiz' => $quiz, 'score' => $score, 'max_score' => $max_score, $title => 'Results']);
        }else{
            header("Location: /");
        }
    }
}