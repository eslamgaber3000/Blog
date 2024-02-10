<?php 
  require_once"connectionDB.php";


if(isset($_SESSION['error'])):
  foreach ($_SESSION['error'] as $key => $error) :
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php
    endforeach;
    unset($_SESSION['error']);
endif;

// print_r($_SESSION['error']);
?>