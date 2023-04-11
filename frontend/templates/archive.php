<?php 
require_once __DIR__.'/../partials/quiz-tile.php';
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzes();

?>
<main>
    <section class="archive container" id="archive-quiz">
        <div class="filters">
            <div>
            <input type="text" placeholder="Search..." id="search">
            </div>
        </div>
        <div class="quizzes" id="quizzes">
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