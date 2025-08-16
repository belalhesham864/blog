<?PHP
session_start();
require "db/conecation.php";
if($_SERVER['REQUEST_METHOD']=='GET'){
$id=$_GET['id'];
$quary="DELETE from posts where id='$id'";
$res=mysqli_query($conc,$quary);
if($res){
    $_SESSION['SUCCDELETE']="the post delete successfuly";
    header("location:index.php");
    exit();
}
else{
    $error[]=" error in delete";
header("location:viewpost.php");
    
}
}
else{
    $error[]=" error in delete";
header("location:viewpost.php");
  
}
if(!empty($error)){
    $_SESSION['errordelete']=$error;
    header("location:viewpost.php");
}