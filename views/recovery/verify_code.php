<?php view_include("inc/header", $data) ?>

<section class="content-section">
   <div class="container p-3 py-5">
      <div class="jumbotron border bg-white">
         <div class="col-12">
            <p class="lead">Check Your Email <b><?= $_SESSION['recovery_password_email'] ?></b></p>
            <small class="text-secondary">We send a verification code to your email! </small><br>
            <hr class="my-2">
            <form action="/recovery/password" method="POST" >

               <input type="text" hidden style="display:none" name="email" value="<?= $_SESSION['recovery_password_email'] ?>" id="email_new">

               <p class="lead">If you din't get verification code to your email then click<button type="submit" name="change_email_request" value="submit_email" class="btn btn-link profile-button" type="button"><b>Send again</b></button> </p>

            </form>
         </div>

         <form class="col-md-6" method="POST" action="/recovery/verify_code" enctype="application/x-www-form-urlencoded ">
            <div class="form-group">

               <input type="text" placeholder="Verification Code" class="form-control <?= isset($data['errors']['verification_code']) ? 'is-invalid' : '' ?>" name="verification_code" id="verification_code" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['verification_code']) ? $data['form_data']['verification_code'] : '' ?>">
               <small class="text-secondary">For each new verification code has the time limit of <?= $_ENV['VERIFICATION_CODE_TIME_LIMIT'] == 1 ? '60 seconds' : $_ENV['VERIFICATION_CODE_TIME_LIMIT'].'minutes'?> !!</small>
               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['verification_code']) ? $data['errors']['verification_code'] : '' ?></span>
               </div>

            </div>
            <div class="btn-group mb-3">
               <button value="submit_verify_request" name="verify_recovery_password_email" type="submit" class="btn btn-dark" href="" role="button">Verify</button>
            </div>
            <br>
         </form>

      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>