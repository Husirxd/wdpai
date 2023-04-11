<?php 
require_once __DIR__.'/../partials/quiz-tile.php';
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzes();

?>
<main>
    <section class="archive container" id="archive-quiz">
        <h1>All Quizzes!</h1>
        <div class="filters">
            <div>
            <input type="text" placeholder="Search..." id="search">
            </div>
        </div>
        <div class="quizzes" id="quizzes" data-anim="fadeUpGrid" data-anim-step="80">
            <?php
                foreach($quizzesRecent as $quiz){
                    $quizObj = new Quiz($quiz->id);
                    echo createTile($quizObj);
                }
            ?>
        </div>
        <div class="flex flex--center"><button class="button load-more">Load More</div>
    </section>
</main>