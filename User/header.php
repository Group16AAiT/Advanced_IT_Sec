<?php
session_start();
ini_set("display_errors",1);
if(!isset($_SESSION["USER_NAME"])){
    header("Location:login.php");
}
else{
    if($_SESSION["ROLE"] == 2){
        header("Location:admin.php");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="review.php">View Review</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="sign-up.php">Signup</a></li>    
                <li><a href="logout.php">logout</a></li>  
            </ul>
            
        </nav>
        </header>