<?php
session_start();
include_once 'config.php';
include 'tokenGenerate.php';

if(isset($_POST['submitFeedback'])){
    if(isset($_POST['submitFeedback']) && checkToken($_POST['token']) && isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])){
        $name=htmlspecialchars($_POST['name']);
        $email=htmlspecialchars($_POST['email']);
        $comment=htmlspecialchars($_POST['comment']);
        $fileName = basename($_FILES['PDFfile']['name']);

        if($_FILES['PDFfile']['type'] != "application/pdf" || mime_content_type($_FILES['PDFfile']['tmp_name'])!= "application/pdf") {
            echo "Only PDFs are allowed!";
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
        
        $query="INSERT INTO feedbacks(user_name,email,comment,file_name) VALUES (?,?,?,?);";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$comment,$fileName);
        mysqli_stmt_execute($stmt);
        header("Location:../User/review.php"); 
    }
    else{
       // header("Location:../sign-up.php?status=unsuccessful"); 
       header("Location:../User/feedback.php"); 
    }
}else{
    header("Location:../User/feedback.php"); 
}
?>