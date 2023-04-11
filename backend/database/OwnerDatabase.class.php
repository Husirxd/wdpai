<?php 
require_once "Database.class.php";
class OwnerDatabase extends Database{
    public function addOwnership($quiz_id, $user_id, $is_creator){
        $stmt = $this->connect()->prepare('INSERT INTO quizzes_owners (quiz_id, user_id, is_creator) VALUES (:quiz_id, :user_id, :is_creator)');
        $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':is_creator', $is_creator, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public function getQuizzAutorByQuizId($quiz_id){
        $stmt = $this->connect()->prepare('SELECT user_id FROM quizzes_owners WHERE quiz_id = :quiz_id');
        $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_STR);
        $stmt->execute();
        $autor = $stmt->fetch(PDO::FETCH_OBJ);
        return $autor;
    }
}
?>