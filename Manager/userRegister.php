<?php
include_once 'config.php';
include 'TokenGenerate.php';
include 'error.php';

if (isset($_POST['Registeruser'])) {

    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmpassword']);
    $captcha =  htmlspecialchars($_POST['captcha']);
    if (isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])) {


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
            $query = "SELECT * FROM users WHERE user_name=? ";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                $generalError =  "Something Went wrong";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $userName);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $userFound = false;
                while ($row = mysqli_fetch_assoc($result)) {;
                    $userFound = true;
                    break;
                }
                if ($userFound) {
                    $userNameError =  "User Name already Exists";
                }
            }


            $query = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $query)) {
                $generalError =  "Something Went wrong";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $emailFound = false;
                while ($row = mysqli_fetch_assoc($result)) {;
                    $emailFound = true;
                    break;
                }
                if ($emailFound) {
                    $emailError =  "Email already Exists";
                }
            }
            mysqli_stmt_close($stmt);
        }

        if (empty($userNameError) && empty($emailError) && empty($captchaError) && empty($passwordError) && empty($confirmPasswordError)) {
            $query = "INSERT INTO users(user_name,email,password) VALUES (?,?,?);";
            $newPassword = password_hash($password,  PASSWORD_DEFAULT);
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);
            mysqli_stmt_bind_param($stmt, "sss", $userName, $email,  $newPassword );
            mysqli_stmt_execute($stmt);
            $_SESSION['USER_NAME'] = $userName;
            header("Location:../User/login.php", true, 303);
        }
        else{
            $generalError =  "Something Went wrong";
        }
    } else {
        $captchaError = "Incorrect captcha";
    }
}
