<?php view_include("inc/header", $data) ?>
<section class="contact-section">

   <div class="container pt-3">
      <h3 class="text-uppercase my-5 text-center">contact us</h3>

      <div class="row justify-content-center">
         <div class="col-md-8 mb-3 ">
            <div class="contact-form ">
               <p class="lead m-0">Need any help feel free to let us know.</p>
               <small class="text-secondary">We will replay to your message as soon as possible</small>
               <form action="/pages/contact" method="POST" class="mt-4">
                  <div class="form-group">
                     <input type="text" class="form-control <?= isset($data['errors']['name']) ? 'is-invalid' : '' ?>" name="name" placeholder="Enter your name" value="<?= isset($data['form_data']['name']) ? $data['form_data']['name'] : '' ?>">

                     <div id="validationServer03Feedback" class="invalid-feedback">
                        <span><?= isset($data['errors']['name']) ? $data['errors']['name'] : '' ?></span>
                     </div>
                  </div>

                  <div class="form-group">

                     <div class="input-group">

                        <input type="text" class="form-control <?= isset($data['errors']['email']) ? 'is-invalid' : '' ?>" name="email" placeholder="Email address" value="<?= isset($data['form_data']['email']) ? $data['form_data']['email'] : '' ?>">

                        <div class="input-group-append">
                           <span>@</span>
                        </div>

                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span><?= isset($data['errors']['email']) ? $data['errors']['email'] : '' ?></span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">

                     <textarea type="text" class="form-control <?= isset($data['errors']['message']) ? 'is-invalid' : '' ?>" name="message" placeholder="Your Message.." rows="7"><?= isset($data['form_data']['message']) ? $data['form_data']['message'] : '' ?></textarea>

                     <div id="validationServer03Feedback" class="invalid-feedback">
                        <span><?= isset($data['errors']['message']) ? $data['errors']['message'] : '' ?></span>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-dark">SEND</button>
               </form>
            </div>
         </div>

      </div>


      <div class="mapouter mt-5">
         <div class="gmap_canvas"><iframe width="1080" height="302" id="gmap_canvas" src="https://maps.google.com/maps?q=Gulshan Centre Point, House 26 Road 90, Parking Level 3, Dhaka 1212&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br>
            <style>
               .mapouter {
                  position: relative;
                  text-align: right;
                  height: 302px;
                  width: 1080px;
               }
            </style><a href="https://www.embedgooglemap.net">how to embed a google map in html</a>
            <style>
               .gmap_canvas {
                  overflow: hidden;
                  background: none !important;
                  height: 302px;
                  width: 1080px;
               }
            </style>
         </div>
      </div>

      <br>

      <hr>

      <div class="row justify-content-center contact-card-list mt-4">
         <div class="col-sm-12 col-md-6 col-lg-3 my-2">
            <div class="card border-0">
               <div class="card-body text-center">
                  <i class="fa fa-phone fa-5x mb-1" aria-hidden="true"></i>
                  <h4 class="text-uppercase mb-3">call us</h4>
                  <p>+8801683615582</p>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-6 col-lg-3 my-2">
            <div class="card border-0">
               <div class="card-body text-center">
                  <i class="fa fa-map-marker fa-5x mb-1" aria-hidden="true"></i>
                  <h4 class="text-uppercase mb-3">office loaction</h4>
                  <address>Gulshan Centre Point, House 26 Road 90, Parking Level 3, Dhaka 1212</address>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-6 col-lg-3 my-2">
            <div class="card border-0">
               <div class="card-body text-center">
                  <i class="fa fa-globe fa-5x mb-1" aria-hidden="true"></i>
                  <h4 class="text-uppercase mb-3">email</h4>
                  <p>main@mainto.com</p>
               </div>
            </div>
         </div>
      </div>

      <div class="contact-social ">
         <a href="//facebook.com"><i class="fa fa-facebook-square" aria-hidden="true"></i></i></a>
         <a href="//twitter.com"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
         <a href="//linkedin.com"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
         <a href="mailto:info@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i></a>
         <a href="tel:+8801683615582"><i class="fa fa-phone-square" aria-hidden="true"></i></a>
      </div>


   </div>

</section>


<?php view_include("inc/footer", $data) ?>