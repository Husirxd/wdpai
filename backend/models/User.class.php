<?php

class User {
    private $email;
    private $password;
    private $name;
    private $display_name;

    public function __construct($user_id){
        //create UserDatabase object
        $userDatabase = new UserDatabase();
        //get user from database
        $user = $userDatabase->getUserById($user_id);

        //set user properties
        $this->email = $user->email;
        $this->password = $user->password;
        $this->name = $user->name;
        $this->display_name = $user->display_name;
        
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDisplayName()
    {
        return $this->display_name;
    }



}