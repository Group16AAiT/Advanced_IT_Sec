<?php
include_once 'config.php';
$temp  = "C:/uploads/".$_GET['file'];
$filename = "C:/uploads/". basename(realpath($temp));

// $query = "SELECT * FROM feedbacks ";
// $stmt = mysqli_stmt_init($conn);
// if (!mysqli_stmt_prepare($stmt, $query)) {
//     $generalError =  "Something Went wrong";
// } else {
//    // mysqli_stmt_bind_param($stmt, "s", $_SESSION['USER_NAME']);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     $row = mysqli_fetch_assoc($result);
//     if($row != null){

//         echo $row['file_name'];
//         echo "jjjjjj";
//     }
//     if($row != null && strcmp($row['file_name'],basename(realpath($temp))) == 0){
//         readfile($filename);
//     }

// }

//$file = "adminLogin.php"; 
    
// Header Content Type
 //header("Content-type: application/pdf"); 
 readfile($filename);
 //header("Content-Length: " . filesize($file)); 
  
// Send the file to the browser.


?>