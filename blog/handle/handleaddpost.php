<?php
session_start();
require "../db/conecation.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $error=[];
$title=$_POST['title'];
$body=$_POST['body'];
$image=$_FILES['image'];
$image_name=$image['name'];
$tmpname=$image['tmp_name'];
$img_error=$image['error'];
$user_id = $_SESSION['id'];

 $exc= pathinfo($image_name,PATHINFO_EXTENSION);
$newname=time().".".$exc;
if(empty($title)){
$error[]="you should enter title";
}
if(empty($body)){
$error[]="you should enter body";
}

if(empty($image)){
    $error[]="you should enter image";
}elseif($img_error>0){
      $error[]="you image is broken";
}elseif(!in_array($exc, ['jpg', 'gif', 'png', 'tiff', 'pdf','avif'] )){
 $error[]="you image is should jpg or gif or png or tiff or avif or pdf";
}
if (!empty($error)) {
    $_SESSION['error'] = $error;
    header("Location: ../addpost.php");
    exit();
}
    $title = mysqli_real_escape_string($conc, $title);
    $body = mysqli_real_escape_string($conc, $body);

move_uploaded_file($tmpname,"../assets/images/postImage/".$newname);
$quary ="INSERT INTO posts (title,image,body,user_id)
values('$title','$newname','$body','$user_id')";
$res=mysqli_query($conc,$quary);
if($res){
    $_SESSION['sucessadd']="the post add successfuly";
    header("location:../index.php");
    exit();
}else{
    header("location:../addpost.php");
    exit();

}
}else{
    header("location:../addpost.php");
}