<!--Examiner Rejection Modal-->
<div class="modal fade" id="examinerrejectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="examinerrejectionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="examinerrejectionModalLabel"><strong>REJECT AS EXAMINER</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="examiner_reject_form" name="examiner_reject_form" class="form-row" action="<?= ROOT ?>includes/examiner_reject_inviatation.inc.php" method="POST" onsubmit="return checkExaminerRemark();">
            <h5 class="form-group col-md-12 mb-3 text-dark">Reason of Rejecting</h5>
            <div class="form-group col-md-6" hidden>
                <label for="examiner_reject_application_id">Application ID</label>
                <input type="text" name="examiner_reject_application_id" class="form-control" id="examiner_reject_application_id" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="reject_as_examiner">As Examiner</label>
                <input type="text" name="reject_as_examiner" class="form-control" id="reject_as_examiner" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="reject_as_examiner_id">Examiner ID</label>
                <input type="text" name="reject_as_examiner_id" class="form-control" id="reject_as_examiner_id" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="examiner_remark">Remark:</label>
                <textarea class="form-control" name="examiner_remark" id="examiner_remark" cols="4" rows="3"></textarea>
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