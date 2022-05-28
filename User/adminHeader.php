<?php
session_start();
ini_set("display_errors",1);
if(!isset($_SESSION["USER_NAME"])){
    header("Location:login.php");
    die();
}
else{
    if($_SESSION["ROLE"] == 1){
        header("Location:index.php");
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
                <li><a href="">Users</a></li>
                <li><a href="userFeedback.php">User Feedbacks</a></li>
                <li><a href="logout.php">Logout</a></li>    
            </ul>
            
        </nav>
        </header>