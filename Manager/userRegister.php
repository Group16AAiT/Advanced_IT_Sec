<?php
require_once 'Validation.php';
$sessionClass = new SessionClass();

$sessionClass->authenticationwithoutRedirectCheck();
$databaseClass= new DatabaseClass();
$validateClass = new ValidationClass();
ini_set("display_errors",1);



if (isset($_POST['Registeruser'])) {

    $userName = ($_POST['userName']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $confirmPassword = ($_POST['confirmpassword']);


    $userNameError = $validateClass -> UserNameSignupCheck($userName);
    $emailError =$validateClass -> emailSignupCheck($email);
    $passwordError = $validateClass -> passwordSignupCheck($password);
    $confirmPasswordError = $validateClass -> cPasswordSignupCheck($password,$confirmPassword);
    //$captchaError = $validateClass ->captchaCheck($captcha); 
    if (empty($userNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError)) {
        $databaseClass->registerUser($userName,$email,$password);
    }

}
