<?php
include_once 'config.php';
include 'tokenGenerate.php';

session_start();

if(isset($_POST['updateFeedback'])){
    if(isset($_POST['updateFeedback']) && checkToken($_POST['token']) && isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])){
        $name=htmlspecialchars($_POST['name']);
        $email=htmlspecialchars($_POST['email']);
        $comment=htmlspecialchars($_POST['comment']);
        $id=htmlspecialchars($_POST['id']);
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
        
        $query="UPDATE feedbacks SET user_name=?,email=?,comment=?,file_name=? WHERE id=?;";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"ssssi",$name,$email,$comment,$fileName, $id);
        mysqli_stmt_execute($stmt);
        header("Location:../User/review.php"); 
    }
    else{
        echo "Failed 1";
       // header("Location:../sign-up.php?status=unsuccessful"); 
       //header("Location:../User/feedback.php"); 
    }
}else{
    echo "Failed 2";
   // header("Location:../User/feedback.php"); 
}
?>