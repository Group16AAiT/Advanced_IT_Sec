<?php

$temp  = "C:/uploads/".$_GET['file'];
$filename = "C:/uploads/". basename(realpath($temp));

//$file = "adminLogin.php"; 
    
// Header Content Type
 //header("Content-type: application/pdf"); 
  
 //header("Content-Length: " . filesize($file)); 
  
// Send the file to the browser.
readfile($filename); 


?>