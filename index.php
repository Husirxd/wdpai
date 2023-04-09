<?php

require 'Routing.class.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('create', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::get('quiz', 'DefaultController');
Router::get('archive', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('results', 'DefaultController');
Router::run($path);