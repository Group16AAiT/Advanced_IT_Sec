<?php

include_once 'config.php';
include_once 'config2.php';
include 'tokenGenerate.php';
include 'error.php';

    if (isset($_POST['updateFeedback']) && checkToken($_POST['token'])) {
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
                $checker = true;
                $name = $_POST['name'];
                $email = $_POST['email'];
                $comment = $_POST['comment'];
                $id = $_POST['id'];
                $fileName = basename($_FILES['PDFfile']['name']);


                $query = "SELECT * FROM users WHERE user_name=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    $generalError =  "Something Went wrong";
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['USER_NAME']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
                    if(strcmp($row['email'],$email)!=0){
                        $emailError ="problem2";
                        $checker = false;
                    }

                }
                if(strcmp($name, $_SESSION['USER_NAME'])!=0 ){
                    $userNameError ="problem";
                    $checker = false;
                }


                $filepath = $_FILES['PDFfile']['tmp_name'];
                $fileSize = filesize($filepath);
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($fileinfo, $filepath);


                if ($_FILES['PDFfile']['type'] != "application/pdf" || mime_content_type($_FILES['PDFfile']['tmp_name']) != "application/pdf" || $filetype !=  "application/pdf" ) {
                    $fileError ="problem3";
                    $checker = false;
                }



                $uploaddir = 'C:\uploads/';

                $uploadfile = $uploaddir . basename($_FILES['PDFfile']['name']);

                if($checker){

                    
                    if (move_uploaded_file($_FILES['PDFfile']['tmp_name'], $uploadfile)) {
                        echo "PDF succesfully uploaded.";
                    } else {
                        echo "PDF uploading failed.";
                        exit;
                    }

                    $query = "UPDATE feedbacks SET user_name=?,email=?,comment=?,file_name=? WHERE id=?;";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $query);
                    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $comment, $fileName, $id);
                    mysqli_stmt_execute($stmt);
                    header("Location:../User/review.php");

                    }

            }
            else{
                echo "captcha error";
            }
        } else {
            echo "captcha error 1";
            // header("Location:../sign-up.php?status=unsuccessful"); 
            //header("Location:../User/feedback.php"); 
        }
    } else {
        // header("Location:" . BASE_URL . "User/Error.php", true, 303);
        // exit();
    }
