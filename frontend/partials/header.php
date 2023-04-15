<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/frontend/assets/styles/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
<header class="header">
        <div class="header__logo">
            <a href="/">KOGOOT</a>
        </div>
        <div class="header__menu">
            <ul>
                <li><a href="/archive/">Quizzes</a></li>
                <?php 
                $user_id = $_SESSION['user'];
                if($user_id){
                
                    echo '<li><a href="/logout">Logout</a></li>';
                }else{
                    echo '<li><a href="/login">Login</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="header__button">
            <a href="/create" class="button-gradient">Add Quiz</a>
        </div>
        <div class="header__hamburger">
            <img src="/frontend/assets/images/menu-icon.svg" width="20">
        </div>
</header>
<div class="mobile-menu">
    <ul>
        <li><a href="/archive/">Quizzes</a></li>
        <?php if($user_id)
            {
                echo '<li><a href="/logout">Logout</a></li>';
            }else{
                echo '<li><a href="/login">Login</a></li>';
            }
        ?>
    </ul>
    <div>
            <a href="/create" class="button button-gradient">Add Quiz</a>
    </div>
</div>