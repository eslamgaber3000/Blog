<?php
 // connection to database
require_once "../inc/connectionDB.php";


if (isset($_POST['submit'])) {


    // 1-catch data   and validation 

    // email
    $email = trim(htmlspecialchars($_POST['email']));

    // password
    $password= trim(htmlspecialchars($_POST['password']));


    //  validation on email ( required ,email )
    $errors = [];

    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "enter valid email";
    }

    //  validate password (unique)
    if (empty($password)) {
        $errors[] = "password is required";
    }





    //  if there are no error go to index else take me to login sheet and show errors

    if(empty($errors)){
// check if this user is Authenticated or not (Search on emil in db ) if i found check on password verified go to index else (password or email not correct)

    $query=" SELECT * FROM `users` WHERE `email` = '$email' ";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){

        $user=mysqli_fetch_assoc($result);
        //oldPassword

        $oldPassword=$user['password'];
        $name=$user['name'];
        $user_id=$user['id'];
        
        //  echo ($hashedPassword);
        // exit();

        if (password_verify($password, $oldPassword)){
        $_SESSION['success']="welcome $name";
        $_SESSION['user_name']=$name;
        $_SESSION['user_id']=$user_id;
        // $_SESSION['user_login']=true;
        header("location:../index.php?page=1");
      }else{
        $_SESSION['error']=["email or password is not correct"];
        header("location:login.php");
      }
       

    }else{
        $errors[]="there are no users yet go sign up and tray again";
        header("location:login.php");

    }


    }else{
        $_SESSION['error']=$errors;
        header("location:login.php");
        // echo "there are errors in your data";
    }
} else {
    header("location:login.php");
}



?>