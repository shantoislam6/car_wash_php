<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container p-4 rounded bg-white mt-5 mb-5">

      <a type="button" href="/user/profile" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>

      <div class="row justify-content-center align-items-center">

         <div class="col-md-5 p-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
               <div class="avater-container">
                  <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                     <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                  </span>
               </div>
               <a href="/user/change_avater">Change Avatar</a>
               <br>
               <span class="mt-2"><?= $data['user']['bio'] ?></span>
               <a href="/user/set_bio">Set bio</a>
               <br>
               <span class="text-black-50"><?= $data['user']['email'] ?></span>

               <a href="/user/change_email">Change Email</a>
               <a href="/user/change_password">Change Password</a>
               <a href="/user/add_social">Add Social links</a>
               <br>
              <?php if(!is_admin()):?>
                <a class="text-danger" href="/user/close_account">Close Account</a>
               <?php endif?>

            </div>
         </div>

         <div class="col-md-5 p-3 ">
            <div class="p-3 py-7">
               <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="text-right">Your Details</h4>
               </div>

               <div class="row ">
                  <div class="col-md-12 mb-2">
                     <span class="spans"><span class="text-secondary font-weight-bold">Name:</span> <?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans"><span class="text-secondary font-weight-bold">Gender:</span> <?= ucwords($data['user']['gender']) ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans"><span class="text-secondary font-weight-bold">Mobile Number:</span> <?= $data['user']['mobile_number'] ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans"><span class="text-secondary font-weight-bold">Address:</span> <?= $data['user']['address_line_1'] ?> <?= $data['user']['address_line_2'] ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans mb-2"><span class="text-secondary font-weight-bold">Postcode:</span> <?= $data['user']['postcode'] ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans mb-2"><span class="text-secondary font-weight-bold">Current location:</span> <?= $data['user']['current_location'] ?></span>
                  </div>
                  <div class="col-md-12 mb-2">
                     <span class="spans"><span class="text-secondary font-weight-bold">State/Region:</span> <?= $data['user']['state'] ?></span>
                  </div>
                  <div class="col-md-12 mt-4">
                     <a href="/user/edit_details">Edit Your Details</a><br>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>