<?php
if (isset($_GET['id']) && isset($_POST['submit'])) {
    require_once("../inc/connectionDB.php");
    $id = $_GET['id'];

    // catch data 
    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));


    $errors = [];

    $image = $_FILES['image'];

    if (!empty($image['name'])) {

        $imageName = strtolower($image['name']);
        $tmpName = $image['tmp_name'];
        // print_r($tmpName);
        $imageError = $image['error'];
        $imageSize = round($image['size'] / (1024 * 1024));
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $imageNewName = uniqid() . ".$imageExtension";
    } else {

        /*
        what if user didn't choose image  ? 
        1-select image from data base (old image)
        make $imageNewName=$oldName
        */

        $query = "SELECT `image` from `posts` WHERE `id`=$id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $oldImage = mysqli_fetch_assoc($result)['image'];
            $imageNewName = $oldImage;
            // header("location:test.php");
        }
        
        
    }
    

    // 2-validation on title
    if (empty($title)) {
        $errors[] = 'title is required';
    } elseif (is_numeric($title)) {
        $errors[] = 'title should be string';

    }

    // 2-validation on body 
    if (empty($body)) {
        $errors[] = 'body is required';
    } elseif (is_numeric($body)) {
        $errors[] = 'body should be string';

    }
    // 2-validation on image (size ,extension ,errors)

  

    if(isset($image)&& $image['name']){
    
        $extensions=['png','jpg','gif','jpeg'];
       
        
        if($imageSize > 1){
            $errors[]='image size exceeded limit size ';
        }
        elseif(!in_array($imageExtension,$extensions)){
            $errors[]='this image type is not allowed';
        }
    }



    if (empty($errors)) {

        $query = "UPDATE `posts`  SET `title`='$title',`body`='$body',`image`='$imageNewName'    WHERE `id`=$id;";
        $result = mysqli_query($conn, $query);
        if ($result) {

            $_SESSION['success'] = 'post updated successfully';


            if (isset($image) && isset($image['name']) ) {

                move_uploaded_file($tmpName, "../assets/images/postImage/" . $imageNewName);
            }
            header("location:../viewPost.php?id=$id");
        } else {
            $_SESSION['error'] = ['error while edit this post'];
        }

    } else {
        $_SESSION['error'] = $errors;
        header("location:../editPost.php?id=$id");
    }



} else {

    header("location:../index.php");
 }


?>