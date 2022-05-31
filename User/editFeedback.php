<?php

    include 'header.php';
    include '../Manager/TokenGenerate.php';
    include '../Manager/config.php';
    
    $id = $_GET['id'];

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
$file = "C:\update/". $filename;


?>
<form action="../Manager/editFeedback.php" method="post" id="feedbackForm" enctype="multipart/form-data">
Name: <input type="text" name="name" value = <?php echo $username?>><br/>
Email: <input type="email" name="email" value = <?php echo $email?>><br/>
Comment: <textarea name="comment"><?php echo $comment?></textarea><br/>
File: <input type="file" accept=".pdf" name="PDFfile"><br/>
old file: <a href="../Manager/view.php?file=1. ChapterOne.pdf"<?php echo $filename?>><?php echo $filename?></a>

<div class="row">
    <div class="input-field col s12">
        <div class="input-group">
            <img src='../Manager/captcha.php' >
                                      
                <input required type="text"name="captcha">
                                      
        </div>
    </div>
</div>
<input type="hidden" name="id" value="<?php echo $id?>"><br>
<input type="hidden" name="token" value="<?=newToken()?>"><br>
<button type="submit" name="updateFeedback">Submit Comment</button>

</body>
</html>
</body>
</html>