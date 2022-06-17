<?php
    include 'header.php';
    include '../Manager/TokenGenerate.php';
    
?>
    <form action="../Manager/submitFeedback.php" method="post" id="feedbackForm" enctype="multipart/form-data">
Name: <input type="text" name="name"><br/>
Email: <input type="email" name="email"><br/>
Comment: <textarea name="comment" >Enter comment here...</textarea><br/>
<input type="file" accept=".pdf" name="PDFfile"><br/>


<input type="hidden" name="token" value="<?=newToken()?>"><br>
<div class="g-recaptcha" data-sitekey="6Lcy4mggAAAAAMx_CKC_MlzqlENotW7fB3kTag0z"></div> 
<button type="submit" name="submitFeedback">Submit Comment</button>

</body>
</html>