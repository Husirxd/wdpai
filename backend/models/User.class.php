<?php

class User {
    private $email;
    private $password;
    private $name;
    private $display_name;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $display_name
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->display_name = $display_name;
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