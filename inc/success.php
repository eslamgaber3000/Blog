<?php 
  require_once"connectionDB.php";


if(isset($_SESSION['success'])):

    ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success'] ?>
        </div>
    <?php
   
    unset($_SESSION['success']);
endif;

// print_r($_SESSION['error']);
?>