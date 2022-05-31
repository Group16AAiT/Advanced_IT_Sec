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
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/common.css">
   <link rel="stylesheet" href="css/sign-up.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="">Review</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="sign-up.php">Signup</a></li>    
                <li><a href="logout.php">logout</a></li>  
            </ul>
            
        </nav>
        </header>