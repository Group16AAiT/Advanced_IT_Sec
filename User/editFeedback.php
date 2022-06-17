<?php

    include 'header.php';
    include '../Manager/TokenGenerate.php';
    include '../Manager/config.php';
    
    $id = $_GET['id'];
    $q="SELECT * FROM feedbacks WHERE user_name=?";
    $s=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($s,$q);
    mysqli_stmt_bind_param($s, "s",$_SESSION["USER_NAME"]);
    mysqli_stmt_execute($s);
    $feedbacks= mysqli_stmt_get_result($s);
    $found = false;
    while($feedback=mysqli_fetch_assoc($feedbacks)){  
        if($id == $feedback['id']){
            $found = true;
        }
    }

    if(!$found){
        echo "unauthorized access";
        exit;
    }








    $query="SELECT * FROM feedbacks WHERE id=?";

    $stmt = mysqli_stmt_init($conn);
   

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    } 



$username = $row['user_name'];
$email =$row['email'];
$comment = $row['comment'];
$filename = $row['file_name'];


?>
<form action="../Manager/editFeedback.php" method="post" id="feedbackForm" enctype="multipart/form-data">
Name: <input type="text" name="name" value = <?php echo $username?>><br/>
Email: <input type="email" name="email" value = <?php echo $email?>><br/>
Comment: <textarea name="comment"><?php echo $comment?></textarea><br/>
File: <input type="file" accept=".pdf" name="PDFfile"><br/>
<?php $ff = "../Manager/view.php?file=".urlencode ($filename); ?>
old file: <a href=<?php echo $ff?> > <?php echo $filename?></a>

<input type="hidden" name="id" value="<?php echo $id?>"><br>
<input type="hidden" name="token" value="<?=newToken()?>"><br>
<div class="g-recaptcha" data-sitekey=<?=CAPTCHA_SECRET_SITE?>></div> 
<button type="submit" name="updateFeedback">Submit Comment</button>

</body>
</html>
</body>
</html>