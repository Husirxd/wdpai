<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    
?>
<body>
    <div class="results">
        <div class="results__title">
            <?php echo $quiz->getTitle() ?>
        </div>
        <div class="results__score">
            <?php echo $score . " points" ?>
            / <?php echo $max_score ?>
        </div>
    </div>
</body>
</html>