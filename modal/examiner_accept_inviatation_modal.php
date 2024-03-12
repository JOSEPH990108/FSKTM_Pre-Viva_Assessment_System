<!-- Examiner Acception Modal -->
<div class="modal fade" id="examineracceptionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="examineracceptionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h5 class="modal-title" id="examineracceptionModalLabel"><strong>ACCEPTING AS AN EXAMINER</strong></h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <h5 class="form-group col-md-12 mb-3 text-dark">Pre-Viva Application Information</h5>
            <div class="form-group col-md-6" hidden>
                <label for="examiner_application_id">Application ID</label>
                <input type="text" name="examiner_application_id" class="form-control" id="examiner_application_id" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="as_examiner">As Examiner</label>
                <input type="text" name="as_examiner" class="form-control" id="as_examiner" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="as_examiner">Staff ID</label>
                <input type="text" name="examiner_staff_id" class="form-control" id="examiner_staff_id" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="examiner_studentname">Student Name</label>
                <input type="text" name="examiner_studentname" class="form-control" id="examiner_studentname" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="examiner_student_programme">Programme</label>
                <input type="text" name="examiner_student_programme" class="form-control" id="examiner_student_programme" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="examiner_levelofstudy">Level of Study</label>
                <input type="text" name="examiner_levelofstudy" class="form-control" id="examiner_levelofstudy" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="examiner_research_title">Research Title</label>
                <input type="text" name="examiner_research_title" class="form-control" id="examiner_research_title" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="examiner_pre_viva_date">Pre-Viva Date</label>
                <input type="date" name="examiner_pre_viva_date" class="form-control" id="examiner_pre_viva_date" readonly>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="examiner_pre_viva_time">Pre-Viva Time</label>
                <input type="time" name ="examiner_pre_viva_time" class="form-control" id="examiner_pre_viva_time" readonly>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="col-md-12 modal-footer">
                <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success examinersubmitbtn">Confirm</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>