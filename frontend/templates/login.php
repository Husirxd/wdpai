<!DOCTYPE html>
<?php
session_start();

if($_SESSION['user'] != null){
    header("Location: /");
}
?>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>

<?php

?>

<body>
    <?php include_once(__DIR__."/../components/header.php"); ?>
    <div class="container">
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input name="login_email" type="text" placeholder="email@email.com">
                <input name="login_password" type="password" placeholder="password">
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>