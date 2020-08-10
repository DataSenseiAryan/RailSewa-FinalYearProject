<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once 'tweets.php';

// instantiate database and tweet object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$tweets = new Tweets($db);

// query for tweets
$stmt = $tweets->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // tweets array
    $tweets_arr=array();
    $tweets_arr["records"]=array();
  
    // retrieve our table contents
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $tweet_item=array(
            "id" => $id,
            "tweet" => $tweet,
            "username" => $username,
            "pnr" => $pnr,
            "prediction" => $prediction,
            "tweet_id" => $tweet_id
        );
  
        array_push($tweets_arr["records"], $tweet_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($tweets_arr);
}



?>