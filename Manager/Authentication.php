<?php
require_once 'Database.php';
$sessionClass = new SessionClass();

$sessionClass->authenticationwithoutRedirectCheck();
$databaseClass = new DatabaseClass();

ini_set("display_errors", 1);
if (isset($_POST['user_login']) && checkToken($_POST['token'])) {
    if (isset($_POST['g-recaptcha-response'])) {

        $recaptcha = $_POST['g-recaptcha-response'];
        $secret_key = CAPTCHA_SECRET_KEY;
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
            . $secret_key . '&response=' . $recaptcha;
        $response = file_get_contents($url);

        // Response return by google is in
        // JSON format, so we have to parse
        // that json
        $response = json_decode($response);

        // Checking, if response is true or not
        if ($response->success == true) {
            $email = htmlspecialchars(($_POST['userEmail']));
            $password = htmlspecialchars(($_POST['userPassword']));

            if (empty($email)) {
                $emailError =  "Email is required";
            }
            if (empty($password)) {
                $passwordError =  "Password is required";
            }
            if ((empty($emailError) &&  empty($passwordError))) {


                // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";

                $generalError = $databaseClass->userLogin($email, $password);
            } else {
                $captchaError = "Something went Wrong";
            }
        }
    } else {
        $captchaError = "Something went Wrong";
    }
} else {
    header("Location:" . BASE_URL . "User/Error.php", true, 303);
    exit();
}
