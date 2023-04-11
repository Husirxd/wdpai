<?php 


class Database{
    private $host = 'srv2.kuboit.pl';
    private $username = "adamczykus";
    private $password = '@W5SYwTHWj$Xc&W#v3zP';
    private $database = "adamczykus";
    private $connection_string = 'postgres://adamczykus:@W5SYwTHWj$Xc&W#v3zP@srv2.kuboit.pl:32768';
    private $connection;

    public function __construct()
    {
        
    }

    public function connect()
    {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}