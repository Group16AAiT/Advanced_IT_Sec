<?php
session_start();
include_once 'config.php';
include 'TokenGenerate.php';
include 'error.php';
ini_set("display_errors",1);
if(isset($_SESSION["USER_NAME"])){
    if($_SESSION["ROLE"] == 2){
        header("Location:../User/admin.php", true, 303);
        die();
    }
    else if($_SESSION["ROLE"] == 1){
        header("Location:../User/index.php", true, 303);
        die();
    }
}
if (isset($_POST['user_login'])) {
    $email = htmlspecialchars(($_POST['userEmail']));
    $password = htmlspecialchars(($_POST['userPassword']));

    if (empty($username)) {
        $userNameError =  "Username is required";
    }
    if (empty($password)) {
        $passwordError =  "Password is required";
    }
    if (isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])) {


        // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";

        $query = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            $generalError =  "Something Went wrong";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userFound = false;
            while ($row = mysqli_fetch_assoc($result)) {
                if (!password_verify($password, $row['password'])) {
                    echo "here";
                    $_SESSION['USER_NAME'] = $row['user_name'];
                    $_SESSION['ROLE'] = $row["role"];
                    $userFound = true;
                    if ($row['ban'] == true) {               
                        $generalError =  "Your account has been banned";
                    } else {

                        header("Location:../User/index.php", true, 303);
                        die();
                    }
                }
                else{
                    echo "Not here ".password_verify('12345678','$2y$10$m9Rgv54pFkkPg03E1ZKNAeIcyQIzeNQZ6lYWOVTnnea');
                }
            }
            if (!$userFound) {
                $generalError =  "Incorrect email or password";
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        $captchaError = "Incorrect captcha";
    }
}

// if (isset($_POST['admin_login'])) {
//       header("Location:../User/login.php",true,303);
//       die();
// } else {
//     if (isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])) {
//         include_once 'config.php';
//         $email = $_POST['adminEmail'];
//         $password = $_POST['adminPassword'];

//         // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";

//         $query = "SELECT * FROM users WHERE email=? AND password=? ";
//         $stmt = mysqli_stmt_init($conn);

//         if (!mysqli_stmt_prepare($stmt, $query)) {
//             header("Location:../User/login.php",true,303);
//             die();
//         } else {
//             mysqli_stmt_bind_param($stmt, "ss", $email, $password);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);
//             while ($row = mysqli_fetch_assoc($result)) {;
//                 $_SESSION['USER_NAME'] = $row['user_name'];
//                 $_SESSION['ROLE'] = $row["role"];
//                  header("Location:../User/index.php",true,303);
//                  die();
//             }
//         }
//         mysqli_stmt_close($stmt);
//     } else {
//         header("Location:../User/admin_login.php",true,303);
//         die();
//     }
// }
