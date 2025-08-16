<?php
session_start();
require '../db/conecation.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $errors=[];
  $email=$_POST['email'];
  $password=$_POST['password'];

if(!empty($email)&&!empty($password)){
 $quary="SELECT * FROM users where email='$email'";
 $res=mysqli_query($conc,$quary);
 if(mysqli_num_rows($res)==1){
    $user=mysqli_fetch_assoc($res);
    $oldpassword=$user['password'];
    $new_id=$user['id'];
    $new_name=$user['name'];
    $_SESSION['user_email'] = $user['email'];
    $verify=password_verify($password,$oldpassword);
    if($verify){
        $_SESSION['id']=$new_id;
        $_SESSION['sucess login']="welcome"." " . $new_name;
        header("location:../index.php");
        exit();
    }else{
        $_SESSION['error']="wonring password";
         header("location:../login.php");
         exit();
    }
 }else{
       $_SESSION['error']="worning email";
         header("location:../login.php");
         exit();
 }
}else{
       $_SESSION['error']="worning login";
         header("location:../login.php");
         exit();
}

}else{
    header("location:../login.php");
}