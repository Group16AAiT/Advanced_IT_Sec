<?php

session_start();

if(isset($_SESSION["USER_NAME"])){
    unset($_SESSION["USER_NAME"]);
}
if(isset($_SESSION["ROLE"])){
    unset($_SESSION["ROLE"]);
}
session_destroy();
header("Location: login.php");
die();
