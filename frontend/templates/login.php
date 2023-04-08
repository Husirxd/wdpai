<?php
session_start();
if($_SESSION['user'] != null){
    header("Location: /");
}
?>
<main>
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
                <h1 class="heading text-blue">Hello Again <span>Handsome</span></h1>
                <input name="login_email" type="text" placeholder="email@email.com">
                <input name="login_password" type="password" placeholder="password">
                <div class="flex flex--center"><button class="button" type="submit">LOGIN</button></div>
                <p class="info">Oops. I mistook you for someone else  <a href="/register/">No problem, i'll create account!</a></p>
            </form>
        </div>
    </div>
</main>