<?php
session_start();
//check if user is logged in
if(!isset($_SESSION["user"])){
    header("Location: /login");
}


//display messages
if(isset($messages)){
    foreach($messages as $message) {
        echo $message;
    }
}
?>
<main class="page">
    <div class="container container--sm">
        <div class="create-container">
            <form class="create" action="create" method="POST" id="create-quiz" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION["user"] ?>">
                <div class="wide"><input name="title" type="text" placeholder="title"></div>
                <div class="quiz-data">
                    <div class="quiz-info">
                        <input name="category" type="text" placeholder="category">
                        <label class="checkbox-label"><input name="is_public" type="checkbox" placeholder="is_public">Show this quizz on the page</label>
                    </div>
                    <div class="quiz-thumbnail">
                        <img src="/frontend/assets/images/placeholder.png" alt="preview" class="thumbnail-preview">
                        <input name="thumbnail" id="thumbnail" type="file" placeholder="thumbnail">
                    </div>
                </div>
                

                <div class="questions">
                    <h2>Questions</h2>
                    <input type="hidden" id="question-count" name="question_count" value="1">
                    <div class="question question--template">
                        <input type="hidden" name="type-0" value="single">
                        <input type="hidden" name="correct-0" class="question__correct" value="">
                        <div class="question__top">
                            <input class="question__question" name="question-0"  type="text" placeholder="question">
                            <input type="number" min="0" max="68" placeholder="Set Points" value="1" class="question__points" name="points-0">
                        </div>
                        <div class="question-thumbnail">
                            <img src="/frontend/assets/images/placeholder.png" alt="preview" class="thumbnail-preview">
                            <input type="file" class="question__image" name="image_url-0">
                        </div>
                        <div class="answers">
                            <div class="answer-container">
                                <input class="answer" name="answer-0[]" type="text" placeholder="answer">
                                <button  type="button" class="set-correct">Set Correct</button>
                            </div>
                            <div class="answer-container">
                                <input class="answer" name="answer-0[]" type="text" placeholder="answer">
                                <button  type="button" class="set-correct">Set Correct</button>
                                <span class="remove-answer">×</span>
                            </div>
                        </div>
                        <button  type="button" class="add-answer button button--dark">ADD ANSWER</button>
                    </div>
                </div>
                <div class="flex add-q-container"><button class="add-question button button--dark" type="button">ADD QUESTION</button></div>
                <div class="flex flex--center"><button class="button" type="submit">CREATE</button></div>
            </form>
        </div>
    </div>
</main>