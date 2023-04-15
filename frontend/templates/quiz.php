<?php 

require_once "backend/database/QuizDatabase.class.php";
require_once "backend/models/Quiz.class.php";
if(isset($quiz)){
    $quiz = new Quiz($quiz);
}
if(isset($score)){
    echo $score . " points";
}

?>
<main id="solve-quiz">
    <section class="hero container">
    <img src="<?php echo $quiz->getThumbnail() ?>">
    <h1><?php echo $quiz->title ?></h1>

    </section>
    <section class="container">
     
    <form method="POST" class="quiz" action="results">
        <div class="questions">
        <?php foreach($quiz->questions as $key => $question): ?>
            <div class="question">
                <div class="question__text">
                    <h3><?php echo $question->question ?></h3>
                </div>
                <div class="qustion__image">
                    <img src="<?php echo $question->getImageUrl() ?>" alt="">
                </div>
                <div class="question__answers">
                    <?php foreach($question->getAnswers() as $index => $answer): ?>
                        <div data-id="<?php echo $index ?>" class="answer">
                            <?php echo $answer ?>
                        </div>
                    <?php endforeach ?>
                    <input type="hidden" value="" name="chosen_answer<?php echo $key ?>" class="chosen">
                </div>
            
            </div>
            <?php endforeach ?>
        </div>
        <input type="hidden" value="<?php echo $quiz->getId() ?>" name="quiz_id" >
        <button type="submit" class="button ">Submit Answers</button>
        </form>
    </section>
</main>