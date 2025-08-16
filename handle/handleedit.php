<?php
session_start();
require "../db/conecation.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
$title=$_POST['title'];
$body=$_POST['body'];
$id=$_GET['id'];
$quary2="SELECT * FROM posts where id='$id'";
$res2=mysqli_query($conc,$quary2);
$olddata=mysqli_fetch_assoc($res2);
$oldimage=$olddata['image'];
if (!empty($_FILES['image']['name'])) {
    
$image=$_FILES['image'];
$imgname=$image['name'];
$tmpname=$image['tmp_name'];
$exc=pathinfo($imgname, PATHINFO_EXTENSION );
$newname=time() . "." .$exc;
move_uploaded_file($tmpname,"../assets/images/postImage/".$newname);
}else{
    $newname=$oldimage;
}
if(!empty($title)&&!empty($body)){
   $quary=" UPDATE posts SET title='$title' , body='$body', image='$newname' where id ='$id'";
   $res=mysqli_query($conc,$quary);
   if($res){
    $_SESSION['post sucessupdate']="the post update successfuly";
    header("location: ../index.php");
    exit();
   }else{
     header("location:../editpost.php");
      exit();
   }

}else{
     header("location:../editpost.php");
      exit();
exit();
}
}else{
    header("location:../editpost.php");
     exit();

}