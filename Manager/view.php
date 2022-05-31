<?php


$filename =basename(realpath($_GET['file']));
$file = "C:/uploads/". $filename;

//$file = "adminLogin.php"; 
    
// Header Content Type
 //header("Content-type: application/pdf"); 
  
 //header("Content-Length: " . filesize($file)); 
  
// Send the file to the browser.
readfile($filename); 


?>