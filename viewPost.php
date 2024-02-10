<?php require_once 'inc/header.php' ?>
<?php 
require_once('inc/connectionDB.php');


if (isset($_SESSION['lang'])) {


  $lang = $_SESSION['lang'];
} else {

  $lang = 'en';
}



// check on the value of $lang

if ($lang == "en") {

  require_once "inc/translateToEng.php";

} else {
  require_once "inc/translateToArb.php";
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

    
<?php 

$id=$_GET['id'];
if(!isset($id)):
  header("location:index.php");
endif;
$query="SELECT * FROM `posts` where id=$id";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1){
$post=mysqli_fetch_assoc($result);
// print_r($post);

}else {
  $massage='id is not correct';
}


// show error came from delete post
require_once("inc/errors.php");
require_once("inc/success.php");
?>


    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2> <?=$translate['Our Background'] ?> </h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="<?="assets/images/postImage/".$post['image']?>" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?=$translate['Who we are'] ?>  </h4>
              <p><?= $post['title']?></p>
              <p><?= $post['body']?></p>
              <p><?= $post['created_at']?></p>
              <?php 
              // check on user_id if it found ok show tow buttons els hide them 
              if(isset($_SESSION['user_id'])):
                ?>
                <div class="d-flex justify-content-center">
                <a href="editPost.php?id=<?= $post['id']?>" class="btn btn-success mr-3 "><?=$translate['edit post'] ?></a>
            
                <a href="handel/deletePost.php?id=<?= $post['id']?>"onclick="alert('are you sure to delete this post !')" class="btn btn-danger "> <?=$translate['delete post'] ?></a>
            </div>
               <?php 
               endif;
              ?>
              

            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
