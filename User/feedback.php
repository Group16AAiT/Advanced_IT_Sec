<?php
    include 'header.php';
    include '../Manager/TokenGenerate.php';
    
?>


<div class="container">



<div class="card ">
    <div class="col s12 m6 offset-m3">

    <form action="../Manager/submitFeedback.php" method="post" id="feedbackForm" enctype="multipart/form-data">
        <div class="row">
        <div class="input-field col s4">
            <input placeholder="Placeholder" id="first_name" type="text" class="validate" name="name">
            <label for="first_name">First Name</label>
            </div>
        </div>

        <div class="row">
        <div class="input-field col s4">
            <input placeholder="Placeholder" id="email"type="email" name="email" class="validate">
            <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
        <div class="input-field col s4">
          <textarea id="textarea1" class="materialize-textarea" name="comment"></textarea>
          <label for="textarea1">Textarea</label>
        
        </div>
        </div>

        <div class="row">
        <div class="input-field col s4">
            <div class="file-field input-field">
        <div class="btn">
            <span>File</span>
            <input type="file" accept=".pdf" name="PDFfile">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
        </div>
        </div>
        
        </div>



<input type="hidden" name="token" value="<?=newToken()?>"><br>
<div class="g-recaptcha" data-sitekey=<?=CAPTCHA_SECRET_SITE?>></div> 
<button type="submit" name="submitFeedback">Submit Comment</button>
</div>

    
  </div>


  </div>

   
</body>
</html>