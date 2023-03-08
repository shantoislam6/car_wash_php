<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container p-4 rounded bg-white mt-5 mb-5">

      <a type="button" href="/recovery/password" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>

      <div class="row justify-content-center">
         <div class="col-md-5 ">
            <div class="p-3 py-7">
               <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="text-right">Set a new password</h4>
               </div>
               <form action="/recovery/set_new_password" method="POST" >
                  <div class="row">

                     <div class="form-group col-md-12 ">
                        <label for="exampleInputPassword1">New password</label>

                        <div class="input-group">
                           <input type="password" id="new_password" name="new_password" value="<?= isset($data['form_data']['new_password']) ? $data['form_data']['new_password'] : '' ?>" class="form-control <?= isset($data['errors']['new_password']) ? 'is-invalid' : '' ?>" id="pass">
                           <div class="input-group-append show_hide_password">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                           </div>
                           <div id="validationServer03Feedback" class="invalid-feedback">
                              <span><?= isset($data['errors']['new_password']) ? $data['errors']['new_password'] : '' ?></span>
                           </div>
                        </div>


                     </div>

                     <div class="form-group col-md-12 ">
                        <label for="exampleInputPassword1">Repeat new password</label>

                        <div class="input-group">
                           <input type="password" id="re_new_password" name="re_new_password" value="<?= isset($data['form_data']['re_new_password']) ? $data['form_data']['re_new_password'] : '' ?>" class="form-control <?= isset($data['errors']['re_new_password']) ? 'is-invalid' : '' ?>" id="pass">
                           <div class="input-group-append show_hide_password">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                           </div>
                           <div id="validationServer03Feedback" class="invalid-feedback">
                              <span><?= isset($data['errors']['re_new_password']) ? $data['errors']['re_new_password'] : '' ?></span>
                           </div>
                        </div>


                     </div>

                  </div>

                  <div class="mt-2 text-center">
                     <button type="submit" value="submit" class="btn btn-dark profile-button" type="button">Set new password</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</section>


<?php view_include("inc/footer", $data) ?>