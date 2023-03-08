<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container py-5">
      <div class="credintial-form  p-5">
         <h4 class="text-center">Login as customer </h4>
         <br>
         <div class="row justify-content-center">
            <div class="col-md-5">
               <form method="POST" action="/signin" enctype="application/x-www-form-urlencoded">

                  <div class="form-group">
                     <label class="labels">Email address:</label>
                     <div class="input-group">
                        <input type="name" class="form-control <?= isset($data['errors']['email']) ? 'is-invalid' : '' ?>" name="email" value="<?= isset($data['form_data']['email']) ? $data['form_data']['email'] : '' ?>">
                        <div class="input-group-append">
                           <span>@</span>
                        </div>
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['email']) ? $data['errors']['email'] : '' ?></span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputPassword1">Password:</label>

                     <div class="input-group">
                        <input type="password" name="password" value="<?= isset($data['form_data']['password']) ? $data['form_data']['password'] : '' ?>" class="form-control <?= isset($data['errors']['password']) ? 'is-invalid' : '' ?>" id="pass">
                        <div class="input-group-append show_hide_password">
                           <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['password']) ? $data['errors']['password'] : '' ?></span>
                        </div>
                     </div>


                  </div>


                  <div class="form-group p-0 form-check">
                     <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" name="rember_me" class="custom-control-input b4-form-in" id="rember_me">
                        <label class="custom-control-label" for="rember_me">Remember me</label>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-dark">Sign In</button>
               </form>

               <div class="login-or-section mt-2">
                  <span class="mt-2">Don't Have an account? <a href="/signup"> Register</a></span>
                  <br>
                  <a href="/recovery/password"> Forgotten password?</a>
               </div>
               
            </div>
         </div>
      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>