<?php
require_once "../inc/connectionDB.php";

if(!isset($_SESSION['user_id'])){

    header("location:../superAdmin/login.php");
  }else{


    if (isset($_GET['id'])) {

        $id = $_GET['id'];
    
    
        //get image name from db to unlinkIt when deleting it from data base
        $imgQuery = "SELECT `image` from `posts` WHERE `id`=$id";
        $resultOfImg = mysqli_query($conn, $imgQuery);
        if (mysqli_num_rows($resultOfImg) == 1) {
            $image = mysqli_fetch_assoc($resultOfImg)['image'];
    
            if (!empty($image)) {
                unlink("../assets/images/postImage/$image");
            }
        }
    
        //  echo $id;
        $query = "DELETE FROM `posts` WHERE   `id`=$id";
        $result = mysqli_query($conn, $query);
        if ($result) {
    
            $_SESSION['success'] = 'post deleted successfully';
    
            header("location:../index.php?page=1");
        } else {
            $_SESSION['error'] = 'error while deleting post';
            header("location:../viewPost.php?id=$id");
        }
    
    } else {
        header("location:../index.php"); 
    }
    
  }


?>