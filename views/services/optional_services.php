<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container rounded mt-5 mb-5">
      <div class="bg-white p-4 ">
         <h5 class="text-secondary">Add optional service</h5>

         <form action="/services/optional_services/" class="mt-4" method="POST">

            <div class="form-group">
               <label for="title">Service title</label>
               <input type="text" class="form-control <?= isset($data['errors']['title']) ? 'is-invalid' : '' ?>" name="title" id="title" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['title']) ? $data['form_data']['title'] : '' ?>">

               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['title']) ? $data['errors']['title'] : '' ?></span>
               </div>

            </div>


            <div class="form-group">
               <label for="description">Description</label>
               <input type="text" class="form-control <?= isset($data['errors']['description']) ? 'is-invalid' : '' ?>" name="description" id="description" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['description']) ? $data['form_data']['description'] : '' ?>">

               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['description']) ? $data['errors']['description'] : '' ?></span>
               </div>
            </div>


            <div class="form-group">
               <label for="price">Price<small class="muted">(Price in cents)</small></label>
               <input type="text" class="form-control <?= isset($data['errors']['price']) ? 'is-invalid' : '' ?>" name="price" id="price" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['price']) ? $data['form_data']['price'] : '' ?>">

               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['price']) ? $data['errors']['price'] : '' ?></span>
               </div>
            </div>


            <button class="btn btn-dark"> Add <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
         </form>
      </div>

      <div class="mt-4 bg-white">

         <div class="p-4">
            <h5 class="text-secondary ">Optional services
            </h5>
            <small class="form-text text-muted">You can delete and optional services.</small>
         </div>

         <ul class="list-group list-group-flush ">



            <?php if (count($data['optional_services']) == 0) :
            ?>
               <li class="list-group-item bg-light text-secondary d-flex align-items-center justify-content-center">
                  <h4 class="text-secondary py-5">Empty</h4>
               </li>
            <?php else :
            ?>


               <li class="list-group-item bg-light text-secondary d-flex align-items-center justify-content-between">
                  <span><b>Title </b></span>
                  <span> <b>Price </b></span>
                  <span> <b>Created At</b></span>
                  <span><b>Delete</b></span>
               </li>


               <?php foreach ($data['optional_services'] as $optional_service) :
               ?>
                  <li class="list-group-item d-flex bg-light align-items-center  justify-content-between">
                     <span><?= $optional_service['title'] ?></span>
                     <span>$ <?= $optional_service['price'] / 1000 ?></span>

                     <span> <small style="font-size:11px; color:#b9b9b9"><?= time_elapsed_string($optional_service['created_at']) ?></small></span>
                     <span><form action="/services/optional_services/" method="POST">
                        <button name="optional_service_delete_id" value="<?= $optional_service['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
                     </form></span>
                  </li>
               <?php endforeach
               ?>

            <?php endif
            ?>

         </ul>
      </div>



   </div>
</section>


<?php view_include("inc/footer", $data) ?>