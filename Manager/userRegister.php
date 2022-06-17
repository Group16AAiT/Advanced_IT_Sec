<?php
require_once 'Database.php';
$sessionClass = new SessionClass();

$sessionClass->authenticationwithoutRedirectCheck();
$databaseClass = new DatabaseClass();
ini_set("display_errors",1);



if (isset($_POST['Registeruser'])) {

    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmpassword']);


        if (empty($userName)) {
            $userNameError = "Username is required";
        }
        if (empty($captcha)) {
            $captchaError = "Captcha is eempty";
        }
        if (empty($email)) {
            $emailError = "Email is required";
        }
        if (empty($password)) {
            $passwordError =  "Password is required";
        } else if (strlen($password) < 8) {
            $passwordError =  "Password must be atleast 8 characters long";
        }
        if ($password != $confirmPassword) {
            $confirmPasswordError = "Password doesn't match";
        }
        if (empty($userNameError) && empty($emailError)) {
             $userNameError = $databaseClass->checkUser($userName);
             $emailError = $databaseClass->checkEmail($email);
        }
    
        if (empty($userNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError)) {
           $databaseClass->registerUser($userName,$email,$password);
        }

}
