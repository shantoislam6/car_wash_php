<?php view_include("inc/header", $data) ?>

<section class="content-section">

   <div class="container py-5">
      <div class="credintial-form  p-5">
         <h4 class="text-center"><?= !empty($data['super_admin']) ? $data['super_admin'] : 'Register as customer' ?></h4>
         <br>
         <div class="row justify-content-center">
            <div class="col-md-7">
               <form method="POST" action="/signup" class="signup" enctype="application/x-www-form-urlencoded">
                  <div class="row mt-2">
                     <div class="col-md-6 ">
                        <label class="labels">First Name</label>
                        <input type="text" name="first_name" value="<?= isset($data['form_data']['first_name']) ? $data['form_data']['first_name'] : '' ?>" class="form-control <?= isset($data['errors']['first_name']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['first_name']) ? $data['errors']['first_name'] : '' ?></span>
                        </div>
                     </div>
                     <div class="col-md-6 form-group">
                        <label class="labels">Last Name</label>
                        <input type="text" class="form-control <?= isset($data['errors']['last_name']) ? 'is-invalid' : '' ?>" name="last_name" value="<?= isset($data['form_data']['last_name']) ? $data['form_data']['last_name'] : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['last_name']) ? $data['errors']['last_name'] : '' ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">

                     <div class="col-md-12 form-group mb-4">
                        <label class="labels">Email</label>
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

                     <div class="col-md-12 form-group mb-4">
                        <label class="labels">Mobile Number</label>
                        <input type="text" name="mobile_number" value="<?= isset($data['form_data']['mobile_number']) ? $data['form_data']['mobile_number'] : '' ?>" class="form-control <?= isset($data['errors']['mobile_number']) ? 'is-invalid' : '' ?>" placeholder="Example : 01712-345678">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['mobile_number']) ? $data['errors']['mobile_number'] : '' ?></span>
                        </div>
                     </div>

                     <p> <?= isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'female' ? 'checked' : '' ?></p>

                     <div class="col-md-12 form-group mb-4">
                        <label class="labels">Choose gender</label>
                        <div class="custom-radio-group">
                           <div class="custom-control custom-radio">
                              <input type="radio" id="gender_male" name="gender" value="male" class="custom-control-input" <?= isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'male' ? 'checked' : (isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'female' ? '' : 'checked') ?>>
                              <label class="custom-control-label" for="gender_male">Male</label>
                           </div>
                           <div class="custom-control  custom-radio">
                              <input type="radio" id="gender_female" value="female" name="gender" class="custom-control-input" <?= isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'female' ? 'checked' : '' ?>>
                              <label class="custom-control-label" for="gender_female">Female</label>
                           </div>
                        </div>
                     </div>


                     <div class="col-md-12 form-group mb-4">
                        <label class="labels">Address Line 1</label>
                        <input type="text" name="address_line_1" value="<?= isset($data['form_data']['address_line_1']) ? $data['form_data']['address_line_1'] : '' ?>" class="form-control <?= isset($data['errors']['address_line_1']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['address_line_1']) ? $data['errors']['address_line_1'] : '' ?></span>
                        </div>
                     </div>

                     <div class="col-md-12 form-group mb-4">
                        <label class="labels">Address Line 2 <span class="text-secondary">(optional)</span></label>
                        <input type="text" name="address_line_2" value="<?= isset($data['form_data']['address_line_2']) ? $data['form_data']['address_line_2'] : '' ?>" class="form-control <?= isset($data['errors']['address_line_2']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['address_line_2']) ? $data['errors']['address_line_2'] : '' ?></span>
                        </div>
                     </div>
                     <div class="col-md-12 mb-4">
                        <label class="labels">Postcode</label>
                        <input type="number" name="postcode" value="<?= isset($data['form_data']['postcode']) ? $data['form_data']['postcode'] : '' ?>" class="form-control <?= isset($data['errors']['postcode']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['postcode']) ? $data['errors']['postcode'] : '' ?></span>
                        </div>
                     </div>
                     <div class="col-md-12 mb-4">
                        <label class="labels">Current location</label>
                        <input type="text" name="current_location" value="<?= isset($data['form_data']['current_location']) ? $data['form_data']['current_location'] : '' ?>" class="form-control <?= isset($data['errors']['current_location']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['current_location']) ? $data['errors']['current_location'] : '' ?></span>
                        </div>
                     </div>
                     <div class="col-md-12 mb-4">
                        <label class="labels">State/Region</label>
                        <input type="text" name="state" value="<?= isset($data['form_data']['state']) ? $data['form_data']['state'] : '' ?>" class="form-control <?= isset($data['errors']['state']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['state']) ? $data['errors']['state'] : '' ?></span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">

                     <label>Password</label>

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
                  <div class="form-group">
                     <label>Repeat your password</label>
                     <div class="input-group">

                        <input type="password" name="re_password" value="<?= isset($data['form_data']['re_password']) ? $data['form_data']['re_password'] : '' ?>" class="form-control <?= isset($data['errors']['re_password']) ? 'is-invalid' : '' ?>" id="repass">
                        <div class="input-group-append show_hide_password">
                           <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>

                        <div class="invalid-feedback">
                           <span><?= isset($data['errors']['re_password']) ? $data['errors']['re_password'] : '' ?></span>
                        </div>
                     </div>
                  </div>

                  <?php if (empty($data['super_admin'])) : ?>
                     <div class="form-group p-0 form-check">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                           <input type="checkbox" name="agree_on" class="custom-control-input b4-form-in <?= isset($data['errors']['agree_on']) ? 'is-invalid' : '' ?>" id="agree_on">
                           <label class="custom-control-label " for="agree_on">I agree all statements in <a href="" data-toggle="modal" data-target="#exampleModal">Terms of service</a></label>
                           <div class="invalid-feedback">
                              <span><?= isset($data['errors']['agree_on']) ? $data['errors']['agree_on'] : '' ?></span>
                           </div>
                        </div>
                     </div>
                  <?php endif ?>

                  <button type="submit" class="btn btn-dark"><?= empty($data['super_admin']) ? 'Signup' : 'Register as Super Admin' ?></button>
               </form>
               
               <?php if (empty($data['super_admin'])) : ?>
                  <p class="mt-2 ">Have already an account? <a href="/signin"> Sign In</a></p>
               <?php endif ?>

            </div>

         </div>
      </div>
   </div>

   <?php view_include('modals/termsModal', $data) ?>


</section>

<?php view_include("inc/footer", $data) ?>