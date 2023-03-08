<!-- review service modal -->
<div class="modal " id="booking-cancel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="staticBackdropLabel"> Cancellation Request </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="">
            <div class="modal-body">
               <div class="form-group">
                  <textarea class="form-control" name="cancel_reason" id="" placeholder="Cancellation Reason" rows="3"></textarea>
                  <div class="valid-feedback">
                     <span>good!</span>
                  </div>
                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <span>Please provide a valid city.</span>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger" value="submit">Confirm</button>
            </div>
         </form>
      </div>
   </div>
</div>