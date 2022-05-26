<?php
session_start();
if(!isset($_POST['login'])){
    header("Location:index.php");
}else{
    include_once 'config.php';
    $email=$_POST['userEmail'];
    $password=$_POST['userPassword'];
   
    // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";
   
    $query="SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $mine=mysqli_stmt_init($conn);
    $user=mysqli_num_rows(mysqli_query($conn,$query));
    if($user>=1){
    if(!mysqli_stmt_prepare($mine,$query)){
        header("Location:../User/index.php");
    }else{
    
    mysqli_stmt_execute($mine);
    $result=mysqli_stmt_get_result($mine);
    while($row=mysqli_fetch_assoc($result)){
        $Fname = $row['first_name'];
        $Lname = $row['last_name'];
        $role=$row["role"];
        if($role==2){
            $_SESSION['USER_EMAIL']=$email;
            $_SESSION['Fname']=$Fname;
            $_SESSION['Lname']=$Lname;

     //echo $_SESSION['USER_EMAIL'];
        }else{
            $_SESSION['USER_EMAIL']=$email;
            $_SESSION['Fname']=$Fname;
            $_SESSION['Lname']=$Lname;
            header("Location:../User/homepage.php");
        }
    }
  
}
    }else{
      //  echo $user;
        header("Location:../User/index.php");
    }
}
