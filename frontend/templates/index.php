<?php
session_start();
//check if user is logged in
if(isset($_SESSION["user"])){
    echo "hello ". $_SESSION["user"]->getDisplayName();
    
}
else{
    echo "Hello There!";
}


?>