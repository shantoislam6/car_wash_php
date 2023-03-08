<!-- review service modal -->
<div class="modal " id="service-wash-review" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <button type="button" class="close modal-service-view-closepan" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
   <div class="modal-dialog modal-lg modal-dialog-centered">

      <div class="modal-content">
         <div class="modal-content">
            <div class="modal-body">

               <div class="wash-list-group ">
                  <div class="card  ">

                     <?php $service = $data['service'] ?>

                     <div class="card-image servic-cover-img">

                        <img class="img-fluid view w-100" src="<?= URLROOT . '/static/service_covers/' . $service['cover_img'] ?>" alt="<?= $service['title'] ?>">



                        <div class="service-cover-img-overlay overlay-bottom">

                           <div class="row justify-content-between">
                              <div class="col-7 overlay-service-description">
                                 <h4 class="card-title mb-1 w-100"><?= $service['title'] ?></h4>
                                 <p class="card-text lead m-0"><?= $service['description'] ?></p>

                                 <div class="text-white  ">
                                    <small style="color:#b3b3b3">Last updated <?= time_elapsed_string($service['created_at']) ?></small>
                                 </div>
                              </div>
                              <div class="col-5 overlay-service-ratting">
                                 <div class="row ">
                                    <div class="ratings col-12">
                                       <i class="fa fa-star rating-color"></i>
                                       <i class="fa fa-star rating-color"></i>
                                       <i class="fa fa-star rating-color"></i>
                                       <i class="fa fa-star rating-color"></i>
                                       <i class="fa fa-star"></i>
                                    </div>
                                    <h6 class="review-count text-center col-12 m-0 ">12 Reviews</h6>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-body">
                        <?= $service['body'] ?>
                     </div>
                  </div>



               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>