<!-- Assesors Details Modal -->
<div class="modal fade" id="adminacceptpendingprevivaModal" tabindex="-1" role="dialog" aria-labelledby="adminacceptpendingprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
          <h4 class="modal-title" id="adminacceptpendingprevivaModalLabel"><strong>APPROVE PRE-VIVA APPLICATION</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="admin_approve_pre_viva_form" name="admin_approve_pre_viva_form" class="form-row" action="<?= ROOT ?>includes/approve_pending_pre_viva.inc.php" method="POST">
            <h5 class="form-group col-md-12 mb-3 text-dark">Pre-Viva Application Information</h5>
            <div class="form-group col-md-6" hidden>
                <label for="application_id">Application ID</label>
                <input type="text" name="application_id" class="form-control" id="application_id" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="student_name">Student Name</label>
                <input type="text" name="student_name" class="form-control" id="student_name" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="student_programme">Programme</label>
                <input type="text" name="student_programme" class="form-control" id="student_programme" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="levelofstudy">Level of Study</label>
                <input type="text" name="levelofstudy" class="form-control" id="levelofstudy" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="research_title">Research Title</label>
                <input type="text" name="research_title" class="form-control" id="research_title" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="pre_viva_date">Pre-Viva Date</label>
                <input type="date" name="pre_viva_date" class="form-control" id="pre_viva_date">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="pre_viva_time">Pre-Viva Time</label>
                <input type="time" name ="pre_viva_time" class="form-control" id="pre_viva_time">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="pre_viva_venue_platform">Pre-Viva Venue Platform</label>
                <select name='pre_viva_venue_platform' class='form-control' id='pre_viva_venue_platform'>
                    <option value=''></option>
                    <option value='GOOGLE MEET'>Google Meet</option>
                    <option value='ZOOM'>Zoom</option>
                    <option value='F2F'>F2F</option>
                </select>
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="pre_viva_venue">Pre-Viva Venue</label>
                <input type="pre_viva_venue" name ="pre_viva_venue" class="form-control" id="pre_viva_venue">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="col-md-12 modal-footer">
                <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>