<?php
session_start();
include_once "validation.php";
require '../db/conecation.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
$errors=[];
foreach($validates as $validate_name => $validate_value)
    {
        $value = filter_input(INPUT_POST,$validate_name,$validate_value['filter'],$validate_value['myOptions']);
        if(empty($_POST[$validate_name]))
        {
            $errors[] = "$validate_name Field Is Required";
        }elseif(!$value)
        {
            $errors[] = $validate_value['error'];
}}
if($errors){
    $_SESSION['errors']=$errors;
    header("location:../register.php");
    exit();
}
$name=$_POST['name'];
$phone=$_POST['phone'];
$password=$_POST['password'];

$password_hash=password_hash($password,PASSWORD_DEFAULT);
$email=$_POST['email'];
$image=$_FILES['image'];
$img_name=$image['name'];
$tempname=$image['tmp_name'];
   if (!empty($img_name)) {
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $imagephoto = time() . "." . $ext;
    move_uploaded_file($tempname, "../assets/images/" . $imagephoto);
} else {
    $imagephoto = "default.jpg"; 
}

$quary="INSERT INTO users(name,phone,password,email,image )
VALUES('$name','$phone','$password_hash','$email','$imagephoto')";
$result=mysqli_query($conc,$quary);
if($result){

    $_SESSION['success register']='register success';
    header("location:../login.php");
}else{
     header("location:../register.php");
}
}

else{
    header("location:../register.php");
}