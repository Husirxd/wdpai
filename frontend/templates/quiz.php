<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Solve Quiz</title>
</head>
<?php 

require_once "backend/database/QuizDatabase.class.php";
require_once "backend/models/Quiz.class.php";
if(isset($quiz)){

    $quiz = new Quiz($quiz);
    echo $quiz->getTitle();
}
if(isset($score)){
    echo $score . " points";
}

?>
<body id="solve-quiz">
    <form method="POST" class="quiz" action="results">

        <div class="questions">
        <?php foreach($quiz->questions as $key => $question): ?>
            <div class="question">
            
                <div class="question-text">
                    <?php echo $question->question ?>
                </div>
                <div class="question-answers">
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
    <script src="/frontend/assets/scripts/script.js"></script>
</body>