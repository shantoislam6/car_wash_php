<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container rounded bg-white p-4 mt-5 mb-5">


      <div class="row justify-content-center align-items-center">

         <div class="col-md-5 p-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
               <div class="avater-container">
                  <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                     <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                  </span>
               </div>

               <span class="font-weight-bold"> <?= $data['user']['role'] == 3 ? '<span class="text-danger">★ Owner ★</span>' : ($data['user']['role'] == 2 ? '<span class="text-info">☆ Admin ☆</span>' : '<span class="text-secondary">♡ Customer ♡</span>')  ?></span>

               <span class="font-weight-bold"><?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span>

               <span class="text-black-50"><?= $data['user']['email'] ?></span>

               <span class="mt-2"><?= $data['user']['bio'] ?></span>


               <div class="mt-3 border-bottom profile-social col-12">
                  <div class="row justify-content-center">
                     <ul style="gap:10px" class="social-links col-6 d-flex justify-content-center list-inline p-b-10">

                        <?php
                        $social_link = json_decode($data['user']['social_links'], true);

                        if (!empty($social_link['facebook_username'])) {
                           $facebook_u_l = 'https://facebook.com/' . $social_link['facebook_username'] . '/';
                        ?>
                           <li>
                              <a data-placement="top" title="<?= $facebook_u_l ?>" href="<?= $facebook_u_l ?>" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                           </li>

                        <?php } ?>


                        <?php if (!empty($social_link['twitter_username'])) {
                           $twitter_u_l = 'https://twitter.com/' . $social_link['twitter_username'] . '/';
                        ?>
                           <li>
                              <a data-placement="top" title="<?= $twitter_u_l ?>" href="<?= $twitter_u_l ?>" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                           </li>

                        <?php }

                        if (!empty($social_link['linkedin_username'])) {
                           $linkedin_u_l = 'https://linkedin.com/in/' . $social_link['linkedin_username'] . '/';
                        ?>

                           <li>
                              <a data-placement="top" title="<?= $linkedin_u_l ?>" href="<?= $linkedin_u_l ?>" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                           </li>

                        <?php }

                        if (!empty($social_link['user_website'])) {
                           $website_u_l = $social_link['user_website'];
                        ?>

                           <li>
                              <a data-placement="top" title="<?= $website_u_l ?>" href="<?= $website_u_l ?>" data-original-title="Message"><i class="fa fa-globe fa-lg"></i></a>
                           </li>

                        <?php } ?>
                     </ul>
                  </div>
               </div>



               <div class="profle-data mt-3">
                  <div class="row">
                     <div class="col-md-12 mt-2">
                        <small class="text-small text-muted">Booked</small>
                        <h6>947</h6>

                     </div>
                     <div class="col-md-12 mt-2">
                        <small class="text-small text-muted">Completed</small>

                        <h6>583</h6>
                     </div>
                     <div class="col-md-12 mt-2">
                        <small class="text-small text-muted">Pending</small>

                        <h6>48</h6>
                     </div>
                  </div>
               </div>

            </div>


         </div>
         <div class="col-md-5 p-3">
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
                  <?php if($_SESSION['user_id'] == $data['user']['id']){?>
                     <div class="col-md-12 mt-4">
                        <a href="/user/edit_profile">Settings</a><br>
                     </div>

                  <?php }?>

                  <?php if(is_admin()){?>
                     <div class="mt-5 col-12 btn-group-sm d-flex justify-content-end">
                      <a href="/customers/delete_customer/<?= $data['user']['id'] ?>" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-close"></i> Delete
                      </a>
                    </div>
                     <?php }?>
               </div>
            </div>

         </div>
      </div>
   </div>
</section>


<?php view_include("inc/footer", $data) ?>