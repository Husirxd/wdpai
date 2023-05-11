<?php

require_once 'AppController.class.php';
require_once "backend/models/Quiz.class.php";
require_once "backend/database/QuizDatabase.class.php";
require_once "backend/ajax/ArchiveAjax.class.php";
require_once "backend/ajax/NewsletterAjax.class.php";
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

    public function ajax_archive(){
        if($this->isPost()){

            $archiveAjax = ArchiveAjax::getInstance();
            $data = json_decode(file_get_contents('php://input'), true);
            $responseData = [];
            $responseData['data'] = $archiveAjax -> handleRequest($data);
            echo json_encode($responseData);

        }
    }

    public function ajax_newsletter(){
        //create instance of NewsletterAjax
        $newsletterAjax = NewsletterAjax::getInstance();

        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = [];
        $responseData['data'] = $newsletterAjax -> handle_request($data);
        echo json_encode($responseData);

    }

    public function results(){
        if(isset($_POST['quiz_id'])){
            $quizDatabase = new QuizDatabase();
            $quiz = new Quiz($_POST['quiz_id']);
            $results = $quiz->getResults($_POST);
            $this->render('results', ['quiz' => $quiz, 'score' => $results['score'], 'max_score' => $results['max_score'], $title => 'Results']);
        }else{
            header("Location: /");
        }
    }
}