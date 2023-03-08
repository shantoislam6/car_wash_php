<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container rounded mt-5 mb-5">
      <div class="row justify-content-center">
         <div class="bg-white p-4 border col-sm-6 mt-5">
            <h5 class="text-secondary">Admin Verify</h5>
            <form action="" method="POST">
               <div class="form-group ">

                  <small class="form-text text-muted mb-1">
                     Enter your admin secrete
                  </small>
                  <div class="input-group">
                     <input type="password" class="form-control <?= isset($data['errors']['admin_secrete']) ? 'is-invalid' : '' ?>" name="admin_secrete" id="admin_secrete" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['admin_secrete']) ? $data['form_data']['admin_secrete'] : '' ?>">
                     <div class="input-group-append show_hide_password">
                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                     </div>
                     <div id="validationServer03Feedback" class="invalid-feedback">
                        <span><?= isset($data['errors']['admin_secrete']) ? $data['errors']['admin_secrete'] : '' ?></span>
                     </div>
                  </div>
               </div>
               <button class="btn btn-dark">Verify</button>
            </form>
         </div>
      </div>
   </div>
</section>


<?php view_include("inc/footer", $data) ?>