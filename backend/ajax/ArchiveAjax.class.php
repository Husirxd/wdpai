<?php


require_once __DIR__ ."/../database/QuizDatabase.class.php";
require_once __DIR__."/../../frontend/partials/quiz-tile.php";
require_once __DIR__."/../models/Quiz.class.php";
require_once __DIR__."/IAjax.interface.php";
class ArchiveAjax implements IAjax{
    public function __construct()
    {
    }
    private static $instance = null;
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new ArchiveAjax();
        }
        return self::$instance;
    }

    public function handle_request($data){   
        switch($data['action']){
            case "loadMore":
                return $this->getArchive($data);
            default:
                return false;
        }
    }

    public function getArchive($data){
        $quizDatabase = new QuizDatabase();

        $options['search'] = $data['search'];
        if($data['search'] == "") $options = null;    
        $quizzes = $quizDatabase->getQuizzes($data['offset'], 9, $options);
        $html = null;
        ob_start();
        foreach($quizzes as $quiz){
            $quizObj = new Quiz($quiz->id);
            echo createTile($quizObj);
        }
        $html = ob_get_clean();
        return $html;
    }
}?>