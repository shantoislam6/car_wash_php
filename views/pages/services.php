<?php view_include("inc/header", $data) ?>

<section class="content-section">

   <div class="container py-4">

      <?php if (count($data['services']) > 6) { ?>
         <div class="row my-2 mb-4">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-body p-t-0">
                     <form action="">

                        <div class="input-group">
                           <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                           <span class="input-group-btn">
                              <button type="submit" class="btn btn-effect-ripple btn-dark"><i class="fa fa-search"></i></button>
                           </span>
                        </div>

                     </form>
                  </div>
               </div>
            </div>
         </div>
      <?php } ?>


      <?php if (count($data['services'])  == 0) { ?>

         <h4 class="display-4 d-flex justify-content-center align-items-center" style="height:500px;color:#818181;">EMPTY</h4>

      <?php } else { ?>

         <div class="wash-list-group ">
            <div class="row ">


               <?php foreach ($data['services'] as $service) : ?>

                  <div class="col-lg-4 col-sm-6">
                     <div class="card">
                        <div class="card-image">
                           <img class="img-fluid" src="<?= URLROOT . '/static/service_thumbnails/' . $service['thumbnail_img'] ?>" alt="<?= $service['title'] ?>">
                        </div>
                        <div class="card-body">

                           <h5 class="card-title"><a href="/pages/service_view/<?= $service['id'] ?>"><?= $service['title'] ?></a></h5>

                           <p style="min-height:49px" class="card-text"><?= $service['description'] ?></p>

                        </div>

                        <div class="col-12 my-2">
                           <div class="row">
                              <div class="col-md-6 ">
                                 <div class="small-ratings ratings">
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star"></i>
                                 </div>
                                 <span class="m-0" style="color: #a9a9a9;font-size: 14px;">12 Reviews</span>
                              </div>
                              <div class="col-md-6 wash-list-update-time mt-2">
                                 <small>Last updated <?= time_elapsed_string($service['created_at']) ?></small>
                              </div>
                           </div>
                        </div>


                        <div class="card-footer">
                           <div class="row">
                              <div class="col-6 text-left font-weight-bold footer-text-price"> <span>$<?= $service['price'] / 100 ?></span></div>
                              <div class="col-6 text-right footer-btn">
                                 <?php if (is_admin()) : ?>
                                    <a href="/services/edit/<?= $service['id'] ?>" class="btn btn-dark btn-sm">Edit</a>

                                    <a href="/services/delete/<?= $service['id'] ?>" class="btn btn-danger btn-sm">Delete</a>

                                 <?php else : ?>
                                    <a href="/pages/service_view/<?= $service['id'] ?>" class="btn text-left btn-dark btn-sm">
                                       <i class="fa fa-eye" aria-hidden="true"></i> View / Book
                                    </a>


                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>

            </div>

         </div>


      <?php } ?>





      <?php if (count($data['services']) > 6) { ?>
         <div class="container my-3">
            <nav aria-label="Page navigation example ">
               <ul class="pagination m-0 justify-content-center ">
                  <li class="page-item disabled">
                     <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                     <a class="page-link" href="#">Next</a>
                  </li>
               </ul>
            </nav>
         </div>

      <?php } ?>

   </div>

   </div>

</section>

<?php view_include("inc/footer", $data) ?>