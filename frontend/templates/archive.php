<?php 
require_once __DIR__.'/../partials/quiz-tile.php';
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzes();

?>
<main>
    <section class="archive container">
        <div class="filters">
        </div>
        <div class="quizzes" id="quizzes" data-anim="fadeUpGrid" data-anim-step="80">
            <?php
                foreach($quizzesRecent as $quiz){
                    $quizObj = new Quiz($quiz->id);
                    echo createTile($quizObj);
                }
            ?>
        </div>
    </section>
</main>