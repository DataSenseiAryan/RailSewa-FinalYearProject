<?php
 session_start();
 include_once('config/database.php');

// $database = new Database();
// $con = $database->getConnection();

//echo "<script>window.open('index.php','_self')</script>";
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    // dd($password);

    $query = "SELECT * FROM users WHERE username='".$username."' AND password ='".$password."' LIMIT 1 ";
    $res = mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($res) == 1)
    {
        $row =mysqli_fetch_assoc($res);
        //var_dump($row);
        // $_SESSION['id'] = $row['id'];
        $_SESSION['username'] =$row['username'];
        
        echo "<script>window.open('index.php','_self')</script>";
    }
    else{
        echo "<script>alert('Incorect Credentials !!!!')</script>";
        echo "<script>window.open('login.php','_self')</script>";
    }
}


?>