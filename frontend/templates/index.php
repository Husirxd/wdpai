<?php
session_start();
//check if user is logged in

require_once __DIR__.'/../partials/quiz-tile.php';

//display all quizzes younger than 1 week
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzesByDate();

?>

<main class="home">
    <section class="hero">
    </section>
    <section class="quizzes container">
        <h2>Najlepsze.</h2>
        <div class="quizzes__grid">

    </div>
    <section class="recent container">
        <h2>Ostatnio dodane.</h2>
        <div class="quizzes__grid">
            <?php
            foreach($quizzesRecent as $quiz){
                $quizObj = new Quiz($quiz->id);
                echo createTile($quizObj);
            }
            ?>
        </div>
    </section>

</main>