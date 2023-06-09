<?php

use FileManager;

require_once __DIR__ ."/../database/Database.class.php";
session_start();
class QuizDatabase
{

    private $db_client = null;

    public function __construct(){
        $this->db_client = Database::getInstance()->getConnection();
    }

    public function CreateQuiz($title, $category, $is_public, $thumbnail){
        $stmt = $this->db_client->prepare('INSERT INTO quizzes (title, category, is_public, created_at, thumbnail) VALUES (:title, :category, :is_public, :created_at, :thumbnail)');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':is_public', $is_public, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $stmt->execute();
        $quiz = $this->getQuizByTitle($title);
        return $quiz;
    }

    public function getQuizByTitle($title){
        $stmt = $this->db_client->prepare('SELECT * FROM quizzes WHERE title = :title');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        $quiz = $stmt->fetch(PDO::FETCH_OBJ);
        return $quiz;
    }

    public function getQuizById($id){

        $stmt = $this->db_client->prepare('SELECT quizzes.*, users.display_name FROM quizzes INNER JOIN quizzes_owners ON quizzes.id = quizzes_owners.quiz_id INNER JOIN users ON quizzes_owners.user_id = users.id WHERE quizzes.id = :id');
        //$stmt = $this->connect()->prepare('SELECT * FROM quizzes WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $quiz = $stmt->fetch(PDO::FETCH_OBJ);

        return $quiz;
    }


    public function getQuizByUser($user_id){
        $stmt = $this->db_client->prepare('SELECT * FROM quizzes WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $quiz = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $quiz;
    }


    public function getQuizzesByDate(){

        $stmt = $this->db_client->prepare('SELECT id FROM quizzes WHERE is_public = true ORDER BY created_at DESC LIMIT 3');
        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $quizzes;

    }

    public function getQuizzes($offset = 0, $limit = 9, $options = []){

        if(isset($options['search'])){
            $title = '%'.$options['search'].'%';
            $stmt =$this->db_client->prepare('SELECT * FROM quizzes WHERE is_public = true AND title LIKE :title ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $quizzes = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $quizzes;
        }
        $stmt = $this->db_client->prepare('SELECT * FROM quizzes WHERE is_public = true ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $quizzes;
    }

    public function getQuizzesRandom(){
        $stmt = $this->db_client->prepare('SELECT id FROM quizzes WHERE is_public = true ORDER BY RANDOM() LIMIT 3');
        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $quizzes;
    }


}


?>