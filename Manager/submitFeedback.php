<?php
include_once 'config.php';
include 'tokenGenerate.php';

session_start();

if(isset($_POST['submitFeedback'])){
    if(isset($_POST['submitFeedback']) && checkToken($_POST['token']) && isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])){
        $name=htmlspecialchars($_POST['name']);
        $email=htmlspecialchars($_POST['email']);
        $comment=htmlspecialchars($_POST['comment']);
        
        $query="INSERT INTO feedbacks(user_name,email,comment) VALUES (?,?,?);";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"sss",$name,$email,$comment);
        mysqli_stmt_execute($stmt);
        header("Location:../User/review.php"); 
    }
    else{
       // header("Location:../sign-up.php?status=unsuccessful"); 
       header("Location:../User/feedback.php"); 
    }

}else{
    header("Location:../User/feedback.php"); 
}
?>