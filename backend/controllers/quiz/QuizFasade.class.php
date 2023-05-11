<?php

    require_once __DIR__ ."/../../database/QuizDatabase.class.php";
    require_once __DIR__ ."/../../database/QuestionDatabase.class.php";
    require_once __DIR__ ."/../question/QuestionFactory.class.php";
    session_start();
    class QuizFasade{
        public function createQuiz($post, $files){

            $quizDatabase = new QuizDatabase();
            $fileManager = FileManager::getInstance();
            $questionFactory = new QuestionFactory();
            $thumbnail_url = null;
            $thumbnail = $files["thumbnail"];
            $thumbnail_url =  $fileManager->uploadFile($thumbnail, $post["user_id"]);

            $quiz = $quizDatabase->CreateQuiz($post["title"], $post["category"],$post["is_public"] , $thumbnail_url);
            
            for($i = 0; $i < $post["question_count"]; $i++){
                $question["question"] = $post["question-".$i];
                $question["answer"] = $post["answer-".$i];
                $question["correct"] = $post["correct-".$i];
                $question["points"] = $post["points-".$i];
                $question["type"] = $this->checkType($post["answer-".$i]);
                $question["file"] = $files["image_url-".$i];
            
                $questions[] = $questionFactory->createQuestion($question, $quiz->id, $post["user_id"]);
            }

            if($quiz != null){
                $ownerDatabase = new OwnerDatabase();
                $owner = $ownerDatabase->addOwnership($quiz->id, $post["user_id"], 1);
                if($owner != null){
                    return $quiz;
                }
                else{
                    return null;
                }
            }
            else{
                return null;
            }
        }

        private function checkType($answer){
            if(is_array($answer)){
                $answer = json_encode($answer);
            }

            return strpos($answer, ',') !== false ?  "multiple" : "single";
        }
    }
?>