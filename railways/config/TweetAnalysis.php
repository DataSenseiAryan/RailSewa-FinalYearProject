<?php

include_once 'database.php';
include_once '../api/tweets.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
   } 

   $sql1 = "SELECT COUNT(*) As medical 
            FROM tweets WHERE prediction=1 AND tweet 
            LIKE '%Doctor%' 
            OR LIKE'%Health%' 
            OR LIKE '%Pain%'
            OR LIKE '%Blood%'; ";
   $medical = $con->query($sql1);
?>