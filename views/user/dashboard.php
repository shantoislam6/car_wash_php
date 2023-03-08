<?php view_include("inc/header", $data) ?>

<section class="content-section">
   <div class="container bg-light p-5 rounded mt-5">

      <div class="text-center">
         <h3 class="dashboard-title m-0"><?= $data['user']['first_name'] . ' ' . $data['user']['last_name'] ?></h3>
         <span class="font-weight-bold"> <?= is_admin() ? '<span class="text-danger">★ Owner ★</span>' : '<span class="text-secondary">♡ Customer ♡</span>'  ?></span>
      </div>

      <p class="text-center my-4 lead">Please select one of the actions below</p>
      <div class="row justify-content-center">
         <div class="dashboard-group col-sm-10">
            <div class="row">


               <!--Customers-->

               <?php if (!is_admin()) : ?>

                  <div class="col-lg-6 dashboard-item">
                     <a href="/pages/services" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>New booking</h5>
                           <span>Make new booking</span>
                        </div>
                     </a>
                  </div>


                  <div class="col-lg-6 dashboard-item">
                     <a href="/user/bookings" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Your bookings</h5>
                           <span>View and mange your existing bookings</span>
                        </div>
                     </a>
                  </div>

                  <div class="col-lg-6 dashboard-item">
                     <a href="/services/voucher" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-gift" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Purchase a gift voucher</h5>
                           <span>Add new car wash services for customers</span>
                        </div>
                     </a>
                  </div>



               <?php endif;
               if (is_admin()) : ?>

                  <div class="col-lg-6 dashboard-item">
                     <a href="/pages/services" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class=" fa fa-globe fa-lg" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Site Info</h5>
                           <span>See site details, visitors and more</span>
                        </div>
                     </a>
                  </div>
                  <div class="col-lg-6 dashboard-item">
                     <a href="/pages/services" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                        <i class="fa fa-th-list" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Service list</h5>
                           <span>View, edit and Delete, services</span>
                        </div>
                     </a>
                  </div>


                  <div class="col-lg-6 dashboard-item">
                     <a href="/services/create" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-cog" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Add New Service</h5>
                           <span>Add new car wash service</span>
                        </div>
                     </a>
                  </div>


                  <div class="col-lg-6 dashboard-item">
                     <a href="/services/optional_services" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-cogs" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Optional Services</h5>
                           <span>Add, view and delete car types</span>
                        </div>
                     </a>
                  </div>

                  <div class="col-lg-6 dashboard-item">
                     <a href="/services/car_types" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-car" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Car Types</h5>
                           <span>Add,View and delete car types</span>
                        </div>
                     </a>
                  </div>


                  <div class="col-lg-6 dashboard-item">
                     <a href="/user/bookings" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Bookings List</h5>
                           <span>Confirm, cancel and delete booking</span>
                        </div>
                     </a>
                  </div>


                  <div class="col-lg-6 dashboard-item">
                     <a href="/services/voucher" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-gift" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Gift vouchers</h5>
                           <span>Add, delete and edit gift voucher</span>
                        </div>
                     </a>
                  </div>




                  <div class="col-lg-6 dashboard-item">
                     <a href="/customers" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                        <div class="menu-left col-2 flex-start">
                           <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="menu-right col-10">
                           <h5>Customers</h5>
                           <span>Check delete Customers</span>
                        </div>
                     </a>
                  </div>


               <?php endif ?>


               <div class="col-lg-6 dashboard-item">
                  <a href="/user/profile" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                     <div class="menu-left col-2 flex-start">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                     </div>
                     <div class="menu-right col-10">
                        <h5>Your Profile</h5>
                        <span>Check & edit your profile</span>
                     </div>
                  </a>
               </div>


               <div class="col-lg-6 dashboard-item">
                  <a href="/user/signout" type="button" class="btn btn-outline-dark btn-lg btn-block mb-3 ">
                     <div class="menu-left col-2 flex-start">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                     </div>
                     <div class="menu-right col-10">
                        <h5>Sign out</h5>
                        <span>Leave the customer area</span>
                     </div>
                  </a>
               </div>

            </div>
         </div>
      </div>
   </div>

</section>

<?php view_include("inc/footer", $data) ?>