<?php 
require_once"connectionDB.php";
// echo "welcome in change language page"

if(isset($_GET['lang'])){

    $lang=$_GET['lang'];
    // echo $lang;

// now i want to check if click on arabic or english

if($lang=='ar'){
    $_SESSION['lang']='ar';
    
    

}else{

    $_SESSION['lang']='en';
    
}

header("location:".$_SERVER['HTTP_REFERER']."");





}else {
//    print_r($_SERVER);

$_SESSION['error']=['this language not supported in our website now '];
header("location:".$_SERVER['HTTP_REFERER']."");
}

?>