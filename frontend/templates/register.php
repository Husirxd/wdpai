<!DOCTYPE html>


<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>

<?php

?>

<body>
    <?php include_once(__DIR__."/../components/header.php"); ?>
    <div class="container">
        <div class="register-container">
            <form class="register" action="register" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input type="text" name="login" placeholder="login">
                <input name="email" type="email" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="display_name" type="text" placeholder="display name">
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>