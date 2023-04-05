<?php
session_start();
//check if user is logged in
if(isset($_SESSION["user"])){
    $user = new User($_SESSION['user']);
    echo "Hello " . $user->getDisplayName();
}
else{
    echo "Hello There!";
}

//display all quizzes younger than 1 week
$quizDatabase = new QuizDatabase();
$quizzes = $quizDatabase->getQuizzesByDate();
foreach($quizzes as $quiz){
    echo $quiz->title;
    echo $quiz->category;
    echo $quiz->created_at;
}


?>