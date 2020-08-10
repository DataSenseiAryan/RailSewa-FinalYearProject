<?php

require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', '<your-key>');
define('CONSUMER_SECRET', '<your-secret-key>');
define('ACCESS_TOKEN', '<your-token>');
define('ACCESS_TOKEN_SECRET', '<your-secret-token>');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$content = $connection->get("account/verify_credentials");
$qtweet = $_REQUEST['reply'];
$tweetid = $_REQUEST['tweet_id'];
$connection->post('statuses/update', array('status' => $qtweet, 'in_reply_to_status_id' => $tweetid,'auto_populate_reply_metadata'=>'true'));
var_dump($connection->getLastHttpCode());
?>