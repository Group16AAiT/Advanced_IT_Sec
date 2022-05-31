<?php
    include 'header.php';
    include '../Manager/TokenGenerate.php';
    
?>
    <form action="../Manager/submitFeedback.php" method="post" id="feedbackForm" enctype="multipart/form-data">
Name: <input type="text" name="name"><br/>
Email: <input type="email" name="email"><br/>
Comment: <textarea name="comment" >Enter comment here...</textarea><br/>
<input type="file" accept=".pdf" name="PDFfile"><br/>

<div class="row">
    <div class="input-field col s12">
        <div class="input-group">
            <img src='../Manager/captcha.php' >
                                      
                <input required type="text"name="captcha">
                                      
        </div>
    </div>
</div>
<input type="hidden" name="token" value="<?=newToken()?>"><br>
<button type="submit" name="submitFeedback">Submit Comment</button>

</body>
</html>