<?php require_once 'inc/header.php' ; 
require_once("inc/connectionDB.php");



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
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5"> <?= $translate['Edit Post'] ?> </h3>
  </div>


  <?php 
  
  // edit specific post  i need id to select data from data base with it.
  if (isset($_GET['id'])) {
    
    $id=$_GET['id'];
    $query="SELECT `title`, `body`, `image`  FROM  `posts` WHERE  id = $id";
    $result=mysqli_query($conn,$query);
    
      if(mysqli_num_rows($result)==1){

$post=mysqli_fetch_assoc($result);

        }
    


  }
  
  ?>
<?php 
// show error of edit page
require_once"inc/errors.php";

?>
    <form method="POST" action="handel/editPost.php?id=<?=$id?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label"> <?= $translate['Title'] ?> </label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $post['title']?>">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">  <?= $translate['Body'] ?> </label>
            <textarea class="form-control" id="body" name="body" rows="5" ><?= $post['body']?></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label"><?= $translate['image'] ?>   </label>
            <input type="file" class="form-control-file" id="image" name="image" >
        </div>
         <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="" width="100px" srcset=""> 
        <button type="submit" class="btn btn-primary" name="submit">  <?= $translate['submit'] ?></button>
    </form>
</div>


<?php require_once 'inc/footer.php' ?>