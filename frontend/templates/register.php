    <div class="container">
        <div class="register-container login-container">
            <h1 class="heading text-blue"><span>Hi! </span>Nice to meet you.</h1>
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
                <div class="flex flex--center"><button class="button" type="submit">LOGIN</button></div>
                <p class="info">Do I know you from somewhere? <a href="/login/">Yea! Let me login real' quick.</a></p>
            </form>
        </div>
    </div>
