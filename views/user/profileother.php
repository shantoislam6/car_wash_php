<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container rounded bg-white p-4 mt-5 mb-5">


      <div class="row justify-content-center align-items-center">
         <div class="col-md-12 ">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
               <div class="avater-container">
                  <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                     <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                  </span>
               </div>

               <span class="font-weight-bold"> <?= $data['user']['role'] == 3 ? '<span class="text-danger">★ Owner ★</span>' : ($data['user']['role'] == 2 ? '<span class="text-info">☆ Admin ☆</span>' : '<span class="text-secondary">♡ Customer ♡</span>')  ?></span>

               <span class="font-weight-bold"><?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span>

           
               <span></span>
               <span class="mt-2 w-50"><?= $data['user']['bio'] ?></span>



               <div class="mt-3 profile-social col-12">
                  <div class="row justify-content-center">
                     <ul style="gap:15px" class="social-links col-6 d-flex justify-content-center list-inline p-b-10">
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

               
              <?php if($data['user']['role'] != 3):?>
              <div class="profle-data">
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
              <?php endif?>



            </div>

         </div>
         
      </div>
   </div>
</section>


<?php view_include("inc/footer", $data) ?>