<?php 

require_once 'Database.class.php';
session_start();
class UserDatabase extends Database{

    public function LoginUser($email, $password){
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //check if password is correct
        if($user != false && password_verify($password, $user['password']) == true){
            return new User(
                $user['email'],
                $user['password'],
                $user['name'],
                $user['display_name']
            );
        }
        if($user == false){
            return null;
        }
    }

    public function RegisterUser($name, $email, $password, $display_name){

        //check if user email or login are in database
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user != false){
            return null;
            echo "user exist";
        }


        //hash password
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        //create user in database table users
        $stmt = $this->connect()->prepare('INSERT INTO users (name, email, password, display_name) VALUES (:name, :email, :password, :display_name)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':display_name', $display_name, PDO::PARAM_STR);
        $stmt->execute();
        echo "user created";
        return new User(
            $email,
            $password,
            $name,
            $display_name
        );
    }

}

?>