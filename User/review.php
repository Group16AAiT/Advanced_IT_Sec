<?php
include_once '../Manager/config.php';
$query="SELECT * FROM feedbacks";
$stmt=mysqli_stmt_init($conn);
$feedbacks=mysqli_fetch_all(mysqli_query($conn,$query),MYSQLI_ASSOC);
?>

<?php
    include 'header.php';
?>
<h3>Your Reviews</h3>

<div>
    <?php
        foreach($feedbacks as $feedback){    ?>
        <a href="editFeedback.php?id=<?php echo $feedback['id']; ?>"> 
        <div>
        <h5><?php echo $feedback['user_name'] ?></h5>
            <p><?php echo $feedback['comment'] ?></p>
        </div>
        <br>
        <br>
        </a>
           
    <?php    }
    
    ?>


</div>


</body>
</html>