<?php 
require_once"../inc/connectionDB.php"; // call connection file


// 1-catch data from inputs (title,body ,image)
if(isset($_POST['submit'])){

    
$title=trim(htmlspecialchars($_POST['title']));
$body=trim(htmlspecialchars($_POST['body']));

$errors=[];

$image=$_FILES['image'];

if(isset($image)&& $image['name']){

    $imageName=strtolower($image['name']);
    $tmpName=$image['tmp_name'];
    
    $imageError=$image['error'];
    $imageSize=round($image['size']/(1024*1024));
    $imageExtension=strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $imageNewName=uniqid().".$imageExtension";
//     print_r($image);
// exit();
}



$user_id=$_SESSION['user_id'];



// 2-validation on title
if(empty($title)){
$errors[]='title is required';
}elseif(is_numeric($title)){
    $errors[]='title should be string';

}

// 2-validation on body 
if(empty($body)){
$errors[]='body is required';
}elseif(is_numeric($body)){
    $errors[]='body should be string';

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


// check on array of errors if it empty add data to database  
// else that put this errors into session and show it in addNewPost page;
 if(empty($errors)){

    $query="INSERT INTO `posts`(`title`, `body`, `user_id`, `image`) VALUES ('$title','$body',$user_id,'$imageNewName')";
    $result=mysqli_query($conn,$query);

    if($result){
        $_SESSION['success']='post added successfully';
        
        if(isset($image)&& $image['name']){

            move_uploaded_file($tmpName,"../assets/images/postImage/".$imageNewName);
        }
        header('location:../index.php?page=1');
    }else{
        $_SESSION['error']=['error while adding post'];
        header("location:../addNewPost.php");
    }

 }else{
   $_SESSION['error']=$errors;
   header('location:../addPost.php') ;
 }



}else{
    header('location:../index.php');
}


//  for image extension(jpg,jpeg,png,gif) , size should short than 1 MB and check for errors
//errors and  in the place of form
// while insert successfully show it in index 





?>