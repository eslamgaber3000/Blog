<?php
if (isset($_POST['submit'])) {
    require_once("../inc/connectionDB.php");

    // catch data  // validation data


    // name
    $name = trim(htmlspecialchars($_POST['name']));

    // email
    $email = trim(htmlspecialchars($_POST['email']));
    // password

    $password = trim(htmlspecialchars($_POST['password']));
    // phone
    $phone = trim(htmlspecialchars($_POST['phone']));


    // validation 

    $errors = [];

    // name
    if (empty($name)) {
        $errors[] = "name is required";
    } elseif (is_numeric($name)) {
        $errors[] = "name should be string";

    }
    // email ( required,email ,unique)
    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "enter valid email";
    }

    $query = "SELECT email From users ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) >= 1) {
        $userEmails = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }


    // unique email
// echo $email;
// echo "<br>";

    foreach ($userEmails as $emails) {

        if (in_array($email, $emails)) {
            $errors[] = "email already exists";
        }
    }




    // password
    if (empty($password)) {
        $errors[] = "password is required";
    }

    //phone
    if (empty($phone)) {
        $errors[] = "phone is required";
    } 

    // hashing password
    $hashing_password = password_hash($password , PASSWORD_DEFAULT);

    // unset($errors);
    print_r($errors);
    // exit;
    if (empty($errors)) {

        $query = "INSERT INTO `users`(`name`,`email`,`password`,`phone`)values ('$name','$email', '$hashing_password','$phone')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = 'successful registration';
            // echo " successful registration";
            header("location:login.php");
        } else {
            $_SESSION['error'] = ['error while insert'];

        }


    } else {
        $_SESSION['error'] = $errors;
        header("location:Register.php");
    }


} else {
    header("location:Register.php");
}


?>