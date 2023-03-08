<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container py-5">
      <div class="credintial-form  p-5">
         <h4 class="text-center">Recover Your Password </h4>
         <br>
         <div class="row justify-content-center">
            <div class="col-md-5">
               <form method="POST" action="/recovery/password">

                  <div class="form-group">
                     <label class="labels">Email address:</label>
                     <div class="input-group">
                        <input type="name" class="form-control <?= isset($data['errors']['email']) ? 'is-invalid' : '' ?>" name="email" value="<?= isset($data['form_data']['email']) ? $data['form_data']['email'] : '' ?>">
                        <div class="input-group-append">
                           <span>@</span>
                        </div>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span><?= isset($data['errors']['email']) ? $data['errors']['email'] : '' ?></span>
                        </div>
                     </div>
                  </div>


                  <div class="text-center">
                     <button type="submit" class="btn btn-dark">Send Code</button>
                  </div>
               </form>
               <div class="login-or-section mt-3">
                  <span class="mt-2 text-secondary">Don't Have an account? <a href="/signup"> Register</a></span>
                  <br>
               </div>
            </div>
         </div>
      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>