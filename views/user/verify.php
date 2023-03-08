<?php view_include("inc/header", $data) ?>

<section class="content-section">
   <div class="container p-3 py-5">
      <div class="jumbotron border bg-white">
         <div class="col-12">
            <h4 class="display-4"><b><?= $data['user']['first_name'] . ' ' . $data['user']['last_name'] ?>!! Verify Your Email!!</h4>
            <p class="lead">Check Your Email <b><?= $data['user']['email'] ?></b></p>
            <small class="text-secondary">We send a verification code to your email! </small><br>
            <hr class="my-2">
            <p class="lead">If you din't get verification code to your email then click <a href="/user/verify/?send_tk=send"><b>Send again</b></a> </p>


         </div>

         <form class="col-md-6" method="POST" action="/user/verify" enctype="application/x-www-form-urlencoded">
            <div class="form-group">

               <input type="text" placeholder="Verification Code" class="form-control <?= isset($data['errors']['verification_code']) ? 'is-invalid' : '' ?>" name="verification_code" id="verification_code" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['verification_code']) ? $data['form_data']['verification_code'] : '' ?>">
               
               <small class="text-secondary">For each new verification code has the time limit of <?= $_ENV['VERIFICATION_CODE_TIME_LIMIT'] == 1 ? '60 seconds' : $_ENV['VERIFICATION_CODE_TIME_LIMIT'] . 'minutes' ?> !!</small> 
               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['verification_code']) ? $data['errors']['verification_code'] : '' ?></span>
               </div>

            </div>
            <button type="submit" class="btn btn-dark" href="" role="button">Verify</button>
         </form>

      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>