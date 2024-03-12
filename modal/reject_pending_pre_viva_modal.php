<!--Reject Pending Pre-Viva Modal-->
<div class="modal fade" id="rejectpendingprevivaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rejectpendingprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="rejectpendingprevivaModalLabel"><strong>REJECT PENDING PRE-VIVA</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="reject_pre_viva_form" name="reject_pre_viva_form" class="form-row" action="<?= ROOT ?>includes/reject_pending_pre_viva.inc.php" method="POST" onsubmit="return checkSupervisorRemark();">
            <h5 class="form-group col-md-12 mb-3 text-dark">Reason of Rejecting</h5>
            <div class="form-group col-md-6" hidden>
                <label for="reject_application_id">Application ID</label>
                <input type="text" name="reject_application_id" class="form-control" id="reject_application_id" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="supervisor_remark">Remark:</label>
                <textarea class="form-control" name="supervisor_remark" id="supervisor_remark" cols="4" rows="3"></textarea>
                <small>Error Message</small>
            </div>
            <div class="modal-footer col-12">
              <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="submit" id="submitbtn" name="reject_submitbtn" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>