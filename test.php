<?php
require_once("inc/connectionDB.php");

print_r($_SESSION['user_id']);


$hashed=password_hash(123,PASSWORD_DEFAULT);
// echo $hashed;
// exit();
// $hash = '$2y$10$hhWPtWPw4o0hxj1IxLKtNejgEzXtEAaOCOxYGR';

// if (password_verify('123',$hashed)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }
?>