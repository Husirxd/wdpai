<?php

require_once 'AppController.class.php';

class DefaultController extends AppController {

    public function index(){
        $this->render('index');
    }

    public function login()
    {
        $this->render('login');
    }

    public function create()
    {
        $this->render('create');
    }
}