<?php
include 'config.php';
require_once 'config2.php';
include 'TokenGenerate.php';
include 'error.php';
require_once 'session.php';
class DatabaseClass
{
    public function userLogin($email,$password)
    {
        include 'config.php';
        $sessionClass = new sessionClass();
        $sessionClass->authenticationwithoutRedirectCheck();
        $query = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            return  "Something Went wrong";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userFound = false;
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    $sessionClass->setUser( $row['user_name'],$row["role"]);
                  
                    $userFound = true;
                    if ($row['ban'] == true) {               
                        return  "Your account has been banned";
                    } else {

                        header("Location:".BASE_URL."User/index.php", true, 303);
                        exit();
                    }
                }
            }
            if (!$userFound) {
                return  "Incorrect email or password";
            }
        }
        mysqli_stmt_close($stmt);
        return "";
    }
    public function checkUser($userName)
    {
        include 'config.php';
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
                return "User Name already Exists";
            }
            
        }
        mysqli_stmt_close($stmt);
        return "";

    }
    public function checkEmail($email){
        include 'config.php';
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

                return  "Email already Exists";
            }
        }
        mysqli_stmt_close($stmt);
        return "";
    }
    public function registerUser($userName,$email,$password)
    {
        include 'config.php';
        $query = "INSERT INTO users(user_name,email,password) VALUES (?,?,?);";
        $newPassword = password_hash($password,  PASSWORD_DEFAULT);
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "sss", $userName, $email,  $newPassword );
        mysqli_stmt_execute($stmt);
        $_SESSION['USER_NAME'] = $userName;
        header("Location:".BASE_URL."User/login.php", true, 303);
        exit();
    }

}
