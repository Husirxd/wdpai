<?php 

require_once(__DIR__.'/../database/Database.class.php');

class QuestionDatabase{

    private $db_client = null;

    public function __construct(){
        $this->db_client = Database::getInstance()->getConnection();
    }

    public function getQuestionById($id){
        $stmt =$this->db_client->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $question = $stmt->fetch(PDO::FETCH_OBJ);
        return $question;
    }

    public function getQuestionsByQuizId($id){
        $stmt =$this->db_client->prepare('SELECT * FROM questions WHERE quiz_id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $questions;
    }

    public function addQuestion($quiz_id, $question_text, $answer, $points, $correct_answer, $image_url){

        $stmt =$this->db_client->prepare('INSERT INTO questions (quiz_id, question, answers, points, correct_answer, image_url) VALUES (:quiz_id, :question, :answers, :points, :correct_answer, :image_url)');
        $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_STR);
        $stmt->bindParam(':question', $question_text, PDO::PARAM_STR);
        $stmt->bindParam(':answers', $answer, PDO::PARAM_STR);
        $stmt->bindParam(':points', $points, PDO::PARAM_STR);
        $stmt->bindParam(':correct_answer', $correct_answer, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;

    }

}

?>