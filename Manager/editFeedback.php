<?php
session_start();
include_once 'config.php';
include_once 'config2.php';
include 'tokenGenerate.php';


if (isset($_POST['updateFeedback'])) {
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

                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $comment = htmlspecialchars($_POST['comment']);
                $id = htmlspecialchars($_POST['id']);
                $fileName = basename($_FILES['PDFfile']['name']);

                $filepath = $_FILES['PDFfile']['tmp_name'];
                $fileSize = filesize($filepath);
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($fileinfo, $filepath);


                if ($_FILES['PDFfile']['type'] != "application/pdf") {
                    echo "Only PDFs are allowed 1!";
                    exit;
                }
                if (mime_content_type($_FILES['PDFfile']['tmp_name']) != "application/pdf") {
                    echo "Only PDFs are allowed 2!";
                    exit;
                }

                if ($filetype !=  "application/pdf") {
                    echo "the file type is " . $filetype;
                    exit;
                }

                $uploaddir = 'C:\uploads/';

                $uploadfile = $uploaddir . basename($_FILES['PDFfile']['name']);

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
            else{
                echo "captcha error";
            }
        } else {
            echo "captcha error 1";
            // header("Location:../sign-up.php?status=unsuccessful"); 
            //header("Location:../User/feedback.php"); 
        }
    } else {
        header("Location:" . BASE_URL . "User/Error.php", true, 303);
        exit();
    }
} else {
    header("Location:" . BASE_URL . "User/feedback.php", true, 303);
    exit();
}
