<?php
    include 'header.php';
?>
    <form action="../Manager/submitFeedback.php" method="post" id="feedbackForm">
Name: <input type="text" name="name"><br>
Email: <input type="email" name="email"><br>
Comment: <textarea name="comment" >Enter comment here...</textarea><br/>
<input type="file" name="file"><br>
<button type="submit" name="submitFeedback">Submit Comment

    </form>
</body>
</html>