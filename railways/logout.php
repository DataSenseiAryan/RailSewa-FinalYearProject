<?php
session_start();
include_once('config/database.php');

$user_id1=$_SESSION['username'];
//$update_time="update users set last_login= NOW() WHERE username ='$user_id1'";
//$run=mysqli_query($con,$update_time);
session_destroy();

header('location: login.php')

?>