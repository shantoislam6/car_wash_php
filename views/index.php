<?php function yield_head()
{ ?>

<?php } ?>
<?php view_include("inc/header", $data) ?>


<section class="banner-section" style="background-image: url('<?= URLROOT ?>/imgs/banner/bh.jpg');">
   <div class="container text-center font-weight-bold">
      <h1 class="banner-title text-light font-weight-normal pt-4 pb-4"> Car Wash</h1>
      <div class="caption pb-5">
         <p class="lead text-light">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam, quia.</p>
         <a type="button" href="pages/services" class="btn text-light border">Explore More Service</a>
      </div>
   </div>
   </div>
</section>


<section class="content-section">

   <div class="container py-4">
      <h4 class="text-secondary text-center pb-2">
         Top Sellings
      </h4>
      <hr>
      <div class="wash-list-group mt-3">

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
                              <small>Last updated <?= time_elapsed_string($service['created_at'])?></small>
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

   </div>






</section>

<?php view_include("inc/footer", $data) ?>