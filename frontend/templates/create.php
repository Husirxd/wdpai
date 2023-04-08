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

    <div class="container">
        <div class="create-container">
            <form `class="create" action="create"` method="POST" id="create-quiz" enctype="multipart/form-data">
                <input name="title" type="text" placeholder="title">
                <input name="category" type="text" placeholder="category">
                <input name="is_public" type="checkbox" placeholder="is_public">
                <input name="thumbnail" type="file" placeholder="thumbnail">
                
                //add questions
                <div class="questions">
                    <input type="hidden" id="question-count" name="question_count" value="1">
                    <div class="question question--template">
                        <input class="question" name="question-0" type="text" placeholder="question">
                        <label><input type="number" min="0" max="68" class="question__points" name="points-0"></label>
                        <input type="hidden" name="correct-0" class="question__correct" value="0">
                        <input type="file" class="question__image" name="image_url-0">
                        <div class="answers">
                            <div class="answer-container">
                                <input class="answer" name="answer-0[]" type="text" placeholder="answer">
                                <button  type="button" class="set-correct">Set Correct</button>
                            </div>
                            <div class="answer-container">
                                <input class="answer" name="answer-0[]" type="text" placeholder="answer">
                                <button  type="button" class="set-correct">Set Correct</button>
                            </div>
                        </div>
                        <button type="button" class="add-answer">ADD ANSWER</button>
                    </div>
                </div>
                <button class="add-question" type="button">ADD QUESTION</button>
                <button type="submit">CREATE</button>
            
            
            </form>
        </div>
    </div>
        <script src="/frontend/assets/scripts/script.js"></script>


