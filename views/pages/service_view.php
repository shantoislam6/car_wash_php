<?php view_include("inc/header", $data) ?>

<section class="content-section">

   <div class="container pt-4">

      <div class="wash-list-group ">
         <div class="row ">
            <div class="col-md-12">
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
                                 <small style="color:#b3b3b3">Last updated <?= time_elapsed_string($service['created_at'])?></small>
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

                  <div class="card-footer">
                     <div class="row">
                        <div class="col-6 text-left font-weight-bold footer-text-price">
                           <span>$<?= $service['price'] / 100 ?></span>
                        </div>
                        <div class="col-6 text-right footer-btn">
                           <?php if (is_admin()) : ?>
                              <a href="/services/edit/<?= $service['id'] ?>" class="btn btn-dark btn-sm">Edit</a>

                              <a href="/services/delete/<?= $service['id'] ?>" class="btn btn-danger btn-sm">Delete</a>

                           <?php else : ?>
                              <a href="/services/book/<?= $service['id'] ?>" class="btn text-left btn-dark">
                                 <i class="fa fa-eye" aria-hidden="true"></i> Book Now
                              </a>


                           <?php endif; ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>


      </div>

   </div>



   <div class="container bootstrap comment snippets">

      <div class="panel bg-white">
         <div class="panel-body">
            <textarea class="form-control" rows="2" placeholder="Leave a comment..."></textarea>
            <div class="mar-top clearfix">
               <button class="btn btn-sm btn-dark pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> Comment</button>
               <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#"></a>
            </div>
         </div>
      </div>

      <div class="panel bg-light">
         <div class="panel-body">
            <!-- Newsfeed Content -->
            <!--===================================================-->
            <div class="media-block">
               <a class="media-left" href="#">
                  <div class="avater-container-img" style="background-image: url('https://bootdey.com/img/Content/user_3.jpg');">
                  </div>
               </a>
               <div class="media-body">
                  <div class="mar-btm">
                     <a href="#" class="btn-link text-semibold media-heading box-inline">Lisa D.</a>
                     <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                  </div>
                  <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                  <div class="pad-ver">
                     <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
                     <div class="btn-group">
                        <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                        <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                     </div>
                     <a class="btn btn-sm btn-default btn-hover-primary" href="#">Replay</a>
                  </div>
                  <hr>

                  <!-- Comments -->
                  <div>
                     <div class="media-block">
                        <a class="media-left" href="#">
                           <div class="avater-container-img" style="background-image: url('https://bootdey.com/img/Content/user_3.jpg');">
                           </div>
                        </a>
                        <div class="media-body">
                           <div class="mar-btm">
                              <a href="#" class="btn-link text-semibold media-heading box-inline">Bobby Marz</a>
                              <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 7 min ago</p>
                           </div>
                           <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                           <div class="pad-ver">
                              <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
                              <div class="btn-group">
                                 <a class="btn btn-sm btn-default btn-hover-success active" href="#"><i class="fa fa-thumbs-up"></i> You Like it</a>
                                 <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                              </div>
                              <a class="btn btn-sm btn-default btn-hover-primary" href="#">Replay</a>
                           </div>
                           <hr>
                        </div>
                     </div>

                     <div class="media-block">
                        <a class="media-left" href="#">
                           <div class="avater-container-img" style="background-image: url('https://bootdey.com/img/Content/user_3.jpg');">
                           </div>
                        </a>
                        <div class="media-body">
                           <div class="mar-btm">
                              <a href="#" class="btn-link text-semibold media-heading box-inline">Lucy Moon</a>
                              <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                           </div>
                           <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                           <div class="pad-ver">
                              <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
                              <div class="btn-group">
                                 <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                                 <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                              </div>
                              <a class="btn btn-sm btn-default btn-hover-primary" href="#">Replay</a>
                           </div>
                           <hr>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--===================================================-->
            <!-- End Newsfeed Content -->


            <!-- Newsfeed Content -->
            <!--===================================================-->
            <div class="media-block pad-all">
               <a class="media-left" href="#">
                  <div class="avater-container-img" style="background-image: url('https://bootdey.com/img/Content/user_3.jpg');">
                  </div>
               </a>
               <div class="media-body">
                  <div class="mar-btm">
                     <a href="#" class="btn-link text-semibold media-heading box-inline">John Doe</a>
                     <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                  </div>
                  <p>Lorem ipsum dolor sit amet.</p>
                  <img class="img-fluid thumbnail" src="https://www.bootdey.com/image/400x300" alt="Image">
                  <div class="pad-ver">
                     <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
                     <div class="btn-group">
                        <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                        <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                     </div>
                     <a class="btn btn-sm btn-default btn-hover-primary" href="#">Replay</a>
                  </div>
                  <hr>

                  <!-- Comments -->
                  <div>
                     <div class="media-block pad-all">
                        <a class="media-left" href="#">
                           <div class="avater-container-img" style="background-image: url('https://bootdey.com/img/Content/user_3.jpg');">
                           </div>
                        </a>
                        <div class="media-body">
                           <div class="mar-btm">
                              <a href="#" class="btn-link text-semibold media-heading box-inline">Maria Leanz</a>
                              <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - From Web - 2 min ago</p>
                           </div>
                           <p>Duis autem vel eum iriure dolor in hendrerit in vulputate ?</p>
                           <div class="pad-ver">
                              <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
                              <div class="btn-group">
                                 <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                                 <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                              </div>
                              <a class="btn btn-sm btn-default btn-hover-primary" href="#">Replay</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--===================================================-->
            <!-- End Newsfeed Content -->
         </div>
      </div>
   </div>


</section>

<?php view_include("inc/footer", $data) ?>