
<?php 
session_start();
require_once 'inc/header.php' ;
require_once 'db/conecation.php' ;

$numpost="SELECT COUNT(*) AS totel from posts";
$res2=mysqli_query($conc,$numpost);
$countpost=mysqli_fetch_assoc($res2)['totel'];
if(isset($_GET['page'])){
  $page=$_GET['page'];
}else{
  $page=1;
}
$limit=3;
$offset=($page-1)*$limit;
$numberofpages=ceil($countpost/$limit);
if($page<1){
  header("location:index.php?page=1");
  exit();
}elseif($page>$numberofpages){
  header("location:index.php?page=$numberofpages");
  exit();
}
$quary="SELECT * from posts limit $limit OFFSET $offset";
$res=mysqli_query($conc,$quary);
$posts=mysqli_fetch_all($res,MYSQLI_ASSOC);
?>



    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
  <?php
 


 if(isset($_SESSION['sucess login'])){
          ?> <div class="alert alert-success"><p> <?php   echo $_SESSION['sucess login'] ;?>  </p></div><?php
        unset($_SESSION['sucess login']);
    }
 if(isset($_SESSION['sucessadd'])){
          ?> <div class="alert alert-success"><p> <?php   echo $_SESSION['sucessadd'] ;?>  </p></div><?php
        unset($_SESSION['sucessadd']);
    }
 if(isset(     $_SESSION['SUCCDELETE'])){
          ?> <div class="alert alert-success"><p> <?php   echo $_SESSION['SUCCDELETE'] ;?>  </p></div><?php
        unset($_SESSION['SUCCDELETE']);
    }
 if(isset(     $_SESSION['post sucessupdate'])){
          ?> <div class="alert alert-success"><p> <?php   echo $_SESSION['post sucessupdate'] ;?>  </p></div><?php
        unset($_SESSION['post sucessupdate']);
    }

  ?>
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
  <?php  foreach($posts as $post){?>
          <div class="col-md-4">  
            <div class="product-item">
             <?php echo $post['image'];?>
              <a href="#"><img src="assets/images/postImage/<?=$post['image'];?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?= $post['title'] ;?></h4></a>
                <h6><?= "     ". $post['created_at'] ;?></h6>
                <p><?= $post['body'] ;?></p>
                <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (36)</span> -->
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?= $post['id'];?>" class="btn btn-info "> view</a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
 
        </div>
      </div>
               <nav aria-label="Page navigation example" class="d-flex justify-content-center">
  <ul class="pagination">
    <li class="page-item <?php if($page==1) echo "disabled"?>"><a class="page-link" href="index.php?page=<?= $page-1?>">Previous</a></li>
    <?php for($i=1;$i<=$numberofpages;$i++) {?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"> <?= $i ?></a></li>
    <?php } ?>
    <li class="page-item page-item <?php if($page==$numberofpages) echo "disabled"?> "><a class="page-link" href="index.php?page=<?= $page+1?>">Next</a></li>
  </ul>
</nav>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
