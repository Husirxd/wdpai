<?php


require_once __DIR__ ."/../database/QuizDatabase.class.php";
require_once __DIR__."/../../frontend/partials/quiz-tile.php";
require_once __DIR__."/../models/Quiz.class.php";
class ArchiveAjax{
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

    public function handleRequest($data){   
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
}
//check if request is ajax

$archiveAjax = ArchiveAjax::getInstance();

$data = json_decode(file_get_contents('php://input'), true);

$responseData = [];
$responseData['data'] = $archiveAjax -> handleRequest($data);
echo json_encode($responseData);


?>