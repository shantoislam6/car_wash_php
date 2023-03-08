<?php view_include("inc/header", $data) ?>

<section class="content-section">

   <div class="container ">


      <div class="user-bookings p-3">
         <h4 class="px-3 py-2 text-secondary">You Bookings</h4>
      
         <div class="row">

            <div class="col-md-6 booking-item p-2 mb-1">
               <div class="card ">
                  <div class="card-body">
                     <span><b>Service Name:</b> <a class="text-secondary" href="">Car Wash & Polish/Hand Wash</a></span>
                     <br>
                     <span><b>Status:</b> <span class="text-danger">Pending</span></span>
                     <br>
                     <span><b>Booked At:</b> <span class="text-secondary">12:33pm, 12 NOV 2022</span> </span>
                     <br>
                     <span><b>Service Price:</b> <span class="text-success">50$</span> </span>
                     <br>
                     <br>
                     <a href="#" class=" font-weight-bold" data-toggle="modal" data-target="#customer-buying-details">Booking Details</a>
                     <br>
                     <br>
                     <div class="row justify-content-end">
                        <div class="col-md-7 text-right">
                           <a href="#" class=" btn btn-secondary " data-toggle="modal" data-target="#service-wash-review"><i class="fa fa-eye" aria-hidden="true"></i> Review </a>
                           <a href="#" class=" btn btn-danger " data-toggle="modal" data-target="#booking-cancel">Cancel Booking</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>




         </div>

      </div>

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

   </div>

   <!--All modals-->
   <?php view_include('modals/serviceModal', $data) ?>
   <?php view_include('modals/cancelBookModal', $data) ?>
   <?php view_include('modals/confirmbookModal', $data) ?>

</section>

<?php view_include("inc/footer", $data) ?>