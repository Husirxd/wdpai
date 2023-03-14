<?php

require 'Routing.class.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('create-form', 'DefaultController');
Router::post('login', 'SecurityController');

Router::run($path);