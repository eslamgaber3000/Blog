<?php 
require_once 'inc/header.php' ;
require_once 'inc/connectionDB.php' ;

if(!isset($_SESSION['user_id'])){

  header("location:superAdmin/login.php");
}


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

    
<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5"><?= $translate['Add New Post'] ?></h3>
  </div>

  <?php 
  require_once"inc/errors.php";


?>
  <form method="POST" action="handel/addNewPost.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label"><?= $translate['Title'] ?>   </label>
        <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"> <?= $translate['Body'] ?> </label>
        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label"> <?= $translate['image'] ?>  </label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <button type="submit" class="btn btn-primary" name="submit">  <?= $translate['submit'] ?> </button>
  </form>


</div>

    <?php require_once 'inc/footer.php' ?>
