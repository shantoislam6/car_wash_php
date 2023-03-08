<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container rounded mt-5 mb-5">
      <div class="bg-white p-4 ">
         <h5 class="text-secondary">Add Car Type</h5>

         <form action="/services/car_types/" method="POST">
            <div class="form-group">

               <small class="form-text text-muted mb-1">
                  Remember, Each car type must be a unique name!
               </small>
               <input type="text" class="form-control <?= isset($data['errors']['car_type']) ? 'is-invalid' : '' ?>" name="car_type" id="car_type" aria-describedby="emailHelpId" value="<?= isset($data['form_data']['car_type']) ? $data['form_data']['car_type'] : '' ?>">

               <div id="validationServer03Feedback" class="invalid-feedback">
                  <span><?= isset($data['errors']['car_type']) ? $data['errors']['car_type'] : '' ?></span>
               </div>

            </div>
            <button class="btn btn-dark"> Add <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
         </form>
      </div>

      <div class="mt-4 bg-white">

         <div class="p-4">
            <h5 class="text-secondary ">Car Type List
            </h5>
            <small class="form-text text-muted">You can delete car types.</small>
         </div>

         <ul class="list-group list-group-flush ">



            <?php if (count($data['car_types']) == 0) : ?>
               <li class="list-group-item bg-light text-secondary d-flex align-items-center justify-content-center">
                  <h4 class="text-secondary py-5">Empty</h4>
               </li>
            <?php else : ?>


               <li class="list-group-item bg-light text-secondary d-flex align-items-center justify-content-between">
                  <span><b>Car Type </b></span>
                  <span><b>Created At</b></span>
                  <span><b>Delete </b></span>
               </li>


               <?php foreach ($data['car_types'] as $car_type) : ?>
                  <li class="list-group-item d-flex bg-light align-items-center  justify-content-between">
                     <span><?= $car_type['car_type'] ?></span>

                     <span><small style="font-size:11px; color:#b9b9b9"><?= time_elapsed_string($car_type['created_at']) ?></small></span>

                     <span>
                        <form action="/services/car_types/" method="POST">
                           <button name="car_type_delete" value="<?= $car_type['car_type'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
                        </form>
                     </span>
                  </li>
               <?php endforeach ?>

            <?php endif ?>

         </ul>
      </div>



   </div>
</section>


<?php view_include("inc/footer", $data) ?>