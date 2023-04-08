<?php 
require_once __DIR__.'/../partials/quiz-tile.php';
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzes();

?>
<section class="archive container">
    <div class="filters">
    </div>
    <div class="quizzes" id="quizzes">
        <?php
            foreach($quizzesRecent as $quiz){
                $quizObj = new Quiz($quiz->id);
                echo createTile($quizObj);
            }
        ?>
    </div>
</section>