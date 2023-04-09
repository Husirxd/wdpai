<?php

function createTile($quiz){

    ?>
    
    <div class="quiz-tile">
    <div class="quiz-tile__header">
        <div class="quiz-tile__date">
        <p><?php echo date("d m Y", strtotime($quiz->created_at)) ?></p>
       
        </div>
        <div class="quiz-tile__category">
            <p><?php echo $quiz->category?></p>
        </div>
    </div>

    <div class="quiz-tile__image">
        <img src="<?php echo $quiz->getThumbnail() ?>">
    </div>

    <div class="quiz-tile__body">
        <div class="quiz-tile__body__description">
            <p><?php echo $quiz->description ?></p>
        </div>

    </div>
    <div class="quiz-tile__footer">
        <div class="quiz-tile__title">
            <h3><?php echo $quiz->title ?></h3>
        </div>
        <div class="quiz-tile__solve">
            <a class="button" href="/quiz?quiz=<?php echo $quiz->getId()?>">Solve Quiz</a>
        </div>
    </div>
    
    </div>
    <?php
}

?>