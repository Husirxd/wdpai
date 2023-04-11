<?php
session_start();
//check if user is logged in

require_once __DIR__.'/../partials/quiz-tile.php';

//display all quizzes younger than 1 week
$quizDatabase = new QuizDatabase();
$quizzesRecent = $quizDatabase->getQuizzesByDate();
$quizzesRandom = $quizDatabase->getQuizzesRandom();

?>

<main class="home">
    <section class="hero">
        <div class="hero__image">
            <img src="/frontend/assets/images/chubbs/chubbs-hello.svg">
        </div>
        <div class="hero__text">
            <h1 ">Kogoot</h1>
            <ul>
                <li>Explore</li>
                <li>Create</li>
                <li>Resolve</li>
            </ul>

        </div>
    </section>
    <section class="quizzes container">
        <h2>Added recently.</h2>
        <div data-anim="fadeUpGrid" data-anim-step="80" class="quizzes__grid">
            <?php
            foreach($quizzesRecent as $quiz){
                $quizObj = new Quiz($quiz->id);
                echo createTile($quizObj);
            }
            ?>
        </div>
        <div class="flex flex--center"><a href="/archive" class="button">See all</a></div>
    </section>
    <section class="create-quiz container">
        <div class="image" data-anim="fadeIn">
            <img src="/frontend/assets/images/chubbs/tutel.png">
        </div>
        <div class="create-quiz__text flex flex--center">
            <h2>Create your own quiz.</h2>
            <a href="/create/" class="button-gradient">Create</a>
        </div>
        </section>
    <section class="quizzes container">
        <h2>Recommended.</h2>
        <div class="quizzes__grid" data-anim="fadeUpGrid" data-anim-step="80">
        <?php
            foreach($quizzesRandom as $quiz){
                $quizObj = new Quiz($quiz->id);
                echo createTile($quizObj);
            }
        ?>
        </div>
    </section>
    <section class="about-us container">
        <div class="image">
            <img src="/frontend/assets/images/chubbs/chubbs-read.svg">
        </div>
        <h2>About us.</h2>
        <p>Moim zdaniem to nie ma tak, że dobrze albo że nie dobrze. Gdybym miał powiedzieć, co cenię w życiu najbardziej, powiedziałbym, że ludzi.</p>
        <p>Ludzi, którzy podali mi pomocną dłoń, kiedy sobie nie radziłem, kiedy byłem sam. I co ciekawe, to właśnie przypadkowe spotkania wpływają na nasze życie. Chodzi o to, że kiedy wyznaje się pewne wartości, nawet pozornie uniwersalne, bywa, że nie znajduje się zrozumienia, które by tak rzec, które pomaga się nam rozwijać. Ja miałem szczęście, by tak rzec, ponieważ je znalazłem. I dziękuję życiu. Dziękuję mu, życie to śpiew, życie to taniec, życie to miłość. Wielu ludzi pyta mnie o to samo, ale jak ty to robisz?, skąd czerpiesz tę radość?</p>
        <p>A ja odpowiadam, że to proste, to umiłowanie życia, to właśnie ono sprawia, że dzisiaj na przykład buduję maszyny, a jutro... kto wie, dlaczego by nie, oddam się pracy społecznej i będę ot, choćby sadzić... znaczy... marchew.</p>
    </section>
</main>
