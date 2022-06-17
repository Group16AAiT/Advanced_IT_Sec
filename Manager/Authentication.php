<?php
require_once 'Database.php';

$databaseClass = new DatabaseClass();


ini_set("display_errors",1);
if (isset($_POST['user_login'])) {
    $email = htmlspecialchars(($_POST['userEmail']));
    $password = htmlspecialchars(($_POST['userPassword']));

    if (empty($email)) {
        $emailError =  "Email is required";
    }
    if (empty($password)) {
        $passwordError =  "Password is required";
    }
    if ( (empty($emailError) &&  empty($passwordError) )) {


        // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";

        $generalError = $databaseClass->userLogin($email,$password);
    }
}

