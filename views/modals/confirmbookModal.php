  <!-- check before confirm modal -->
  <div class="modal " id="customer-buying-details" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           <div class="modal-header bg-light">
              <h5 class="modal-title" id="staticBackdropLabel">Booking Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body">
              <div>
                 <strong>Name:</strong> Shanto Islam<br>
                 <Strong>Address:</Strong> Gulshan Centre Point, House 26 Road 90, Parking Level 3,
                 Dhaka 1212<br>
                 <Strong>Email:</Strong> ishanto412@gmail.com<br>
                 <Strong>Phone:</Strong> +8801745123123
                 <br>
              </div>
              <table class="table text-secondary">
                 <tr>
                    <td class="text-info font-weight-bold">Time: Tuesday, January 24, 2023 4:00 PM</td>
                 </tr>
                 <tr>
                    <td>Service: Hand Wash</td>
                    <td>50$</td>
                 </tr>
                 <tr>
                    <td>Service: Scratch removal</td>
                    <td>30$</td>
                 </tr>

                 <tr>
                    <th>Total: You have to pay when service is done</th>
                    <th class="text-info">130$</th>
                 </tr>
              </table>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-info" onclick="document.getElementById('customer-buying-details').parentElement.submit()" data-dismiss="modal">Confirm</button>
           </div>
        </div>
     </div>
  </div>