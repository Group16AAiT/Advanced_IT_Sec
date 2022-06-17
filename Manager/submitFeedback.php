<?php
session_start();
include_once 'config.php';
include 'tokenGenerate.php';

if (isset($_POST['submitFeedback'])  && isset($_POST['g-recaptcha-response']) && checkToken($_POST['token'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = "6Lcy4mggAAAAAEAM3VWkkyFw6JIIbzKLjpYCZGNX";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
        . $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);

    // Response return by google is in
    // JSON format, so we have to parse
    // that json
    $response = json_decode($response);

    // Checking, if response is true or not
    if ($response->success == true) {
        echo '<script>alert("Google reCAPTACHA verified")</script>';
    } else {
        header("Location:../User/Error.php");
        exit;
    }
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);
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

    $query = "INSERT INTO feedbacks(user_name,email,comment,file_name) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $comment, $fileName);
    mysqli_stmt_execute($stmt);
    header("Location:../User/review.php");
} else {
    header("Location:../User/Error.php");
}
