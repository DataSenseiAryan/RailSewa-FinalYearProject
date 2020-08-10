<?php
class Tweets{
  
    // database connection and table name
    private $conn;
    private $table_name = "tweets";
  
    // object properties
    public $id;
    public $tweet;
    public $username;
    public $pnr;
    public $prediction;
    public $tweet_id;
    public $response_status;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function read(){
  
    // select all query
    $query = "select * from tweets order by id desc;";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
}
?>