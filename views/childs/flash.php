<?php
if (isset($_SESSION['flash_message'])) {

   $flash = json_decode($_SESSION['flash_message']);
   unset($_SESSION['flash_message']);
?>

   <div class="flash-message">
      <div class="alert p-2 alert-<?php echo $flash->type ?> mb-0 alert-dismissible fade show" role="alert">
         <div class="container">
            <?php echo $flash->body ?>
         </div>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
   </div>
<?php } ?>