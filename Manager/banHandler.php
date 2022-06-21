<?php
session_start();
require_once 'config.php';
require_once 'TokenGenerate.php';

if (isset($_POST['ban'])  && checkToken($_POST['token'])) {
    echo $_POST['user_id'];
    $id=htmlspecialchars($_POST['user_id']);
    $query="UPDATE users SET ban=true WHERE id=?;";

    $stmt=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header("Location:../User/ban.php"); 
    die();
} else {
    echo "nothing";
    // header("Location:../sign-up.php?status=unsuccessful"); 
    //    header("Location:../User/feedback.php"); 
}

if (isset($_POST['unban'])  && checkToken($_POST['token'])) {
    echo $_POST['user_id'];
    $id=htmlspecialchars($_POST['user_id']);
    $query="UPDATE users SET ban=false WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header("Location:../User/ban.php"); 
    die();
} else {
    echo "nothing";
    // header("Location:../sign-up.php?status=unsuccessful"); 
    //    header("Location:../User/feedback.php"); 
}