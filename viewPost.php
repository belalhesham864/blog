<?php 
session_start();
require_once 'inc/header.php';
require_once 'db/conecation.php';
$id=$_GET['id'];
$quary=" SELECT * FROM posts where id='$id' ";
$res=mysqli_query($conc,$quary);
if(mysqli_num_rows($res)==0){
  header("location:index.php");
  exit();
}else{
  $post=mysqli_fetch_assoc($res);
}


?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php  if(isset( $_SESSION['errordelete'])){
    foreach( $_SESSION['errordelete'] as $error)
          ?> <div class="alert alert-danger"><p> <?php   echo $error;?>  </p></div><?php
        unset($_SESSION['errordelete']);
    } ?>
    
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Background</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/postImage/<?php echo $post['image'];?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?php echo $post['title'];?></h4>
              <p><?php echo $post['body'];?></p>
              
              <div class="d-flex justify-content-center">
                  <a href="editpost.php?id=<?= $post['id']?>" class="btn btn-success mr-3 "> edit post</a>
              
                  <a href="deletePost.php?id=<?= $post['id'] ?>" class="btn btn-danger "> delete post</a>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
