<?php require_once 'inc/header.php' ?>
<?php require_once 'inc/connectionDB.php' ;

if (isset($_SESSION['lang'])) {


  $lang = $_SESSION['lang'];
} else {

  $lang = 'en';
}




// check on if SESSION ISSET AND WITCH VALUE IT CONTAIN

if($lang=="ar"){
  require_once"inc/translateToArb.php";
}else{
  require_once"inc/translateToEng.php";

}
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
// pagination
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  // echo $page;
  $limit = 3;
  $offset = ( $page-1) * $limit;

  $query="SELECT COUNT(id) as NumberOfPosts FROM posts";
  $result=mysqli_query($conn,$query);

  if(mysqli_num_rows($result)==1){
    $NumberOfPosts=mysqli_fetch_assoc($result)['NumberOfPosts'];
  }
  // check on number witch user enter if number grater than number of pages  go to last page
  $numberOfPages=ceil($NumberOfPosts/$limit) ;


  if($page > $numberOfPages and $numberOfPages != 0){
    header("location:".$_SERVER['PHP_SELF']."?page=$numberOfPages");
  }
  elseif($page < 1 ){
    header("location:".$_SERVER['PHP_SELF']."?page=1");
    
  }
    // echo"<h1>  $numberOfPages   <h1>";

  // $NumberOfPosts=;
  // if($page > $numberOfPage ){

  // }


}

?>

<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <?php
          require_once "inc/success.php";
          require_once "inc/errors.php";
          ?>
          <h2><?=$translate['Latest Posts'] ?></h2>
          <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
        </div>
      </div>
      <!-- item1 -->

      <?php
      $query = "SELECT `id`, `title`, `body`, `created_at`, `user_id`, `image` FROM `posts` ORDER BY `id` LIMIT  $limit  OFFSET $offset      ";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0):

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($posts as $post):
          ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="<?= "assets/images/postImage/" . $post['image'] ?>" class="img-fluid" alt=""></a>
              <div class="down-content">
                <a href="#">
                  <h4>
                    <?= $post['title'] ?>
                  </h4>
                </a>
                <h6>
                  <?= $post['created_at'] ?>
                </h6>
                <p>
                  <?= $post['body'] ?>
                </p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <!-- <span>Reviews (24)</span>  -->
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id']; ?>" class="btn btn-info"><?=$translate['view'] ?></a>
                </div>

              </div>
            </div>
          </div>

        <?php endforeach;
      else:
        $message = "No posts yet";
      endif;
      ?>

    </div>
  </div>
</div>

<div class="container  d-flex justify-content-center">

<nav aria-label="Page navigation example">
  <ul class="pagination">

    <li class="page-item <?php if($page==1) echo "disabled" ?>">
      <a class="page-link" href="<?=$_SERVER['PHP_SELF']."?page=".($page-1)?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <li class="page-item disabled">  <a class="page-link" href="#"><?=  "$page  OF $numberOfPages"?></a>  </li>

    <li class="page-item <?php if($page==$numberOfPages) echo "disabled" ?>">
    <a class="page-link" href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>

  </ul>
</nav>
</div>




<?php require_once 'inc/footer.php' ?>