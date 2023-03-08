<?php view_include("inc/header", $data) ?>
<section class="content-section">

   <div class="container mt-5">


      <div class="col-12 rounded bg-white py-3 service-details">
         <div class="row justify-content-sm-between">

            <div class="col-sm-10">
               <h6 class="service-title mt-2 text-secondary" style="margin: 0;"> Service: <strong>Car Wash &
                     Polish/Hand Wash (30 minute)</strong>
               </h6>
            </div>

            <div class="col-sm-2 text-right mt-sm-0 mt-3">
               <button class="btn btn-dark" data-toggle="modal" data-target="#service-wash-review"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
            </div>
         </div>

      </div>


      <div class="col-12 service-buy my-4 p-sm-3  bg-light">
         <div class="row justify-content-center my-5">

            <form class="col-sm-9" method="POST" action="/services/book/<?= $data['service']['id']?>">
               <div class="form-section-title">
                  <h3>Options</h3>
               </div>

               <div class="form-group my-4">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Car Size/Type</h5>
                  <div class=" p-0">
                     <select class="form-control" id="exampleFormControlSelect2">
                        <option selected value="0">-- Please select an option --</option>
                        <option>Car</option>
                        <option>SUV or Minivan</option>
                     </select>

                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>

               <script type="application\json"></script>
               <div class="form-group my-4">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Car Year, Make & Model
                  </h5>
                  <div class=" p-0">
                     <label>Please enter the year, make & model of the car to be detailed</label>
                     <input type="text" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <div class="form-group my-4">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Scratch removal</h5>
                  <div class=" p-0">
                     <div class="custom-control  custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input b4-form-in" id="customControlInline">
                        <label class="custom-control-label" for="customControlInline">(+ $20)</label>
                     </div>
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <div class=" p-0 mt-4">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Date and time</h5>
                  <label>Please selelct the date and time for this service</label>
                  <div class="row">
                     <div class="col-sm-6 form-group">
                        <input type="date" name="service_date" class="form-control">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span>Please provide a valid city.</span>
                        </div>
                     </div>

                     <div class="col-sm-6 form-group">
                        <input type="time" name="service_time" class="form-control">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span>Please provide a valid city.</span>
                        </div>
                     </div>

                  </div>
               </div>


               <div class="form-group my-4">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Notes/ Special requirements
                  </h5>
                  <div class=" p-0">
                     <textarea name="" id="" class="form-control" style="min-height: 150px;"></textarea>
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>

               <div class="form-section-title">
                  <h3>Your details</h3>
               </div>

               <div class="form-group my-4">
                  <div class=" p-0">
                     <div class="custom-control  custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input b4-form-in" id="useProfiledetails">
                        <input hidden value="<?= base64_encode(json_encode($data['user_details'])) ?>">
                        <label class="custom-control-label" for="useProfiledetails"> Same as profile details?</label>
                     </div>
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <div class=" p-0 mt-4">
                  <div class="row">

                     <div class="col-sm-6 form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span>Please provide a valid city.</span>
                        </div>
                     </div>

                     <div class="col-sm-6 form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           <span>Please provide a valid city.</span>
                        </div>
                     </div>

                  </div>
               </div>



               <div class="form-group">
                  <h5 class="font-weight-normal text-secondary border-bottom pb-1 mb-3">Contact details</h5>
                  <div class=" p-0">
                     <label>Address line 1</label>
                     <input type="text" name="address_line_1" id="address_line_1" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>

               <div class="form-group">
                  <div class=" p-0">
                     <label>Address line 2</label>
                     <input type="text" name="address_line_2" id="address_line_2" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>

               <div class="form-group">
                  <div class=" p-0">
                     <label>Postcode</label>
                     <input type="number" name="postcode" id="postcode" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <div class="form-group">
                  <div class=" p-0">
                     <label>Current location</label>
                     <input type="text" name="current_location" id="current_location" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>

               <div class="form-group">
                  <div class=" p-0">
                     <label>State/Region</label>
                     <input type="text" name="state" id="state" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <div class="form-group">
                  <div class=" p-0">
                     <label>Email</label>
                     <input type="text" name="email" id="email" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>



               <div class="form-group">
                  <div class=" p-0">
                     <label>Phone</label>
                     <input type="text" name="mobile_number" id="mobile_number" class="form-control">
                  </div>

                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>


               <hr>

               <h3>Price</h3>
               <table class="table text-secondary">
                  <tr class="bg-secondary text-white">
                     <th>Description</th>
                     <th>Price</th>
                  </tr>
                  <tr>
                     <td>Service: Hand Wash</td>
                     <td>50$</td>
                  </tr>
                  <tr>
                     <td>Service: Scratch removal</td>
                     <td>30$</td>
                  </tr>
                  </tbody>
                  <tr>
                     <th>Total</th>
                     <th>130$</th>
                  </tr>
               </table>

               <div class="voucher text-right">
                  <span class="text-secondary">Have a voucer code?</span>
                  <div data-toggle="modal" data-target="#voucher-field" class="ml-2 btn btn-info"><i class="fa fa-tag" aria-hidden="true"></i> Enter Code</div>
               </div>

               <div class="modal" tabindex="-1" id="voucher-field" aria-labelledby="voucher-field" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Promotion/voucher code</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <input name="voucher_code" type="text" class="form-control">
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                           <button type="button" class="btn btn-info">OK</button>
                        </div>
                     </div>
                  </div>
               </div>



               <div class="form-group  my-4">
                  <div class="btn btn-dark" type="button" data-toggle="modal" data-target="#customer-buying-details" value="confBook">Confirm Your Order</div>
               </div>


               <?php view_include('modals/confirmbookModal', $data) ?>
            </form>



         </div>

      </div>

   </div>

   <?php view_include('modals/serviceModal', $data) ?>



</section>


<?php view_include("inc/footer", $data) ?>


<?php function yield_footer($data)
{ ?>
   <script>

      (function() {
         
         document.getElementById('useProfiledetails').addEventListener('change', (e) => {
            const s = atob(e.target.nextElementSibling.value);
            const b = JSON.parse(s);
            const f = e.target.parentElement.parentElement.parentElement.parentElement;

            if (e.target.checked) {
               for (let name in b) {
                  f[name]['disabled'] = true;
                  f[name]['value'] = b[name]
               }
            } else {
               for (let name in b) {
                  f[name]['disabled'] = false;
                  f[name]['value'] = ''
               }
            }

         })

      }());

   </script>
<?php } ?>