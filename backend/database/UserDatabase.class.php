<?php 

require_once 'Database.class.php';
session_start();
class UserDatabase{

    private $db_client = null;

    public function __construct(){
        $this->db_client = Database::getInstance()->getConnection();
    }

    public function LoginUser($email, $password){
        $stmt =$this->db_client->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //check if password is correct
        if($user != false && password_verify($password, $user['password']) == true){
            return $user['id'];
        }
        if($user == false){
            return null;
        }
    }

    public function RegisterUser($name, $email, $password, $display_name){

        //check if user email or login are in database
        $stmt =$this->db_client->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user != false){
            return null;
            echo "user exist";
        }

        
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        //create user in database table users
        $stmt =$this->db_client->prepare('INSERT INTO users (name, email, password, display_name) VALUES (:name, :email, :password, :display_name)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':display_name', $display_name, PDO::PARAM_STR);
        $stmt->execute();

        $user = $this->getUserByEmail($email);

        return $user->id;
    }

    public function getUserByEmail($email){
        $stmt =$this->db_client->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function getUserById($id){
        $stmt =$this->db_client->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

}

?>