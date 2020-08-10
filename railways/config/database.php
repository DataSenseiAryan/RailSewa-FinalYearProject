<?php

    $servername = "database-1.ctrbpvenwkxn.us-east-2.rds.amazonaws.com/";
	$username = "ghost";
	$password = "rishitosh";
	$database = "twitter2";

	$con = new mysqli($servername, $username, $password,$database);
class Database{
  
    // specify your own database credentials
    private $host = "database-1.ctrbpvenwkxn.us-east-2.rds.amazonaws.com";
    //private $host = "localhost";
    private $db_name = "twitter2";
    private $username = "ghost";
    //private $password = "";
    private $password = "rishitosh";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}

?>
