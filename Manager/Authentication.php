<?php
include 'TokenGenerate.php';
if(!isset($_POST['user_login']) ){
    header("Location:../User/login.php");
}else{
    if(isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])){
        include_once 'config.php';
        $email=$_POST['userEmail'];
        $password=$_POST['userPassword'];
        
        // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";
    
        $query="SELECT * FROM users WHERE email='$email' AND password='$password' ";
        $stmt=mysqli_stmt_init($conn);
        $user=mysqli_num_rows(mysqli_query($conn,$query));
        if($user>=1){
            if(!mysqli_stmt_prepare($stmt,$query)){
                header("Location:../User/login.php");
                die();
            }else{
        
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                while($row=mysqli_fetch_assoc($result)){;
                    $_SESSION['USER_NAME']=$row['user_name'];
                    $_SESSION['ROLE']=$row["role"];
                    header("Location:../User/index.php");
                    die();
                }
    
            }
        }else{
        //  echo $user;
            header("Location:../User/login.php");
            die();
        }
    }
}

if(!isset($_POST['admin_login']) ){
    header("Location:../User/login.php");
}else{
    if(isset($_POST['captcha']) && checkCaptcha($_POST['captcha'])){
        include_once 'config.php';
        $email=$_POST['adminEmail'];
        $password=$_POST['adminPassword'];
        
        // $query="SELECT * FROM users WHERE email=".$email."AND passoword=".$password."";
    
        $query="SELECT * FROM users WHERE email='$email' AND password='$password' ";
        $stmt=mysqli_stmt_init($conn);
        $user=mysqli_num_rows(mysqli_query($conn,$query));
        if($user>=1){
            if(!mysqli_stmt_prepare($stmt,$query)){
                // header("Location:../User/login.php");
                // die();
            }else{
        
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                while($row=mysqli_fetch_assoc($result)){;
                    $_SESSION['USER_NAME']=$row['user_name'];
                    $_SESSION['ROLE']=$row["role"];
                    header("Location:../User/admin.php");
                    die();
                }
    
            }
        }else{
            echo "something went wrong";
        //  echo $user;
            // header("Location:../User/login.php");
            // die();
        }
    }
}

