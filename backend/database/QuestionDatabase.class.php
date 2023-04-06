<?php 

require_once(__DIR__.'/../database/Database.class.php');

class QuestionDatabase extends Database{

    public function getQuestionById($id){
        $stmt = $this->connect()->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $question = $stmt->fetch(PDO::FETCH_OBJ);
        return $question;
    }

    public function getQuestionsByQuizId($id){
        $stmt = $this->connect()->prepare('SELECT * FROM questions WHERE quiz_id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $questions;
    }

    public function addQuestion($quiz_id, $question_text, $answer, $points, $correct_answer){
        $stmt = $this->connect()->prepare('INSERT INTO questions (quiz_id, question, answers, points, correct_answer) VALUES (:quiz_id, :question, :answers, :points, :correct_answer)');
        $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_STR);
        $stmt->bindParam(':question', $question_text, PDO::PARAM_STR);
        $stmt->bindParam(':answers', $answer, PDO::PARAM_STR);
        $stmt->bindParam(':points', $points, PDO::PARAM_STR);
        $stmt->bindParam(':correct_answer', $correct_answer, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;

    }

}

?>