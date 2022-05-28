<?php
include_once 'config.php';
session_start();

if(isset($_POST['Registeruser'])){
    $userName=$_POST['userName'];
    $email=$_POST['email'];
    $password=$_POST['password'];



    
    $query="INSERT INTO users(user_name,email,password) VALUES (?,?,?);";
    $stmt=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$query);
    mysqli_stmt_bind_param($stmt,"sss",$userName,$email,$password);
    mysqli_stmt_execute($stmt);
    $_SESSION['USER_NAME']=$userName;
    header("Location:../User/login.php");

}else{
    header("Location:../sign-up.php?status=unsuccessful"); 
}
?>