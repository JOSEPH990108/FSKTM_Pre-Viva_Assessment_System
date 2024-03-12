<!-- Apply Pre-Viva Modal -->
<div class="modal fade" id="pendingprevivaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="pendingprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-">
            <h5 class="modal-" id="pendingprevivaModalLabel"><strong>APPLY PRE-VIVA</strong></h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="accept_pre_viva_form" name="accept_pre_viva_form" class="form-row" action="<?= ROOT ?>includes/accept_pre_viva.inc.php" method="POST">
                <h4>Pre-Viva Application Information</h4>
                <div class="form-group col-md-6">
                    <label for="application_id">Application ID</label>
                    <input type="text" name="application_id" class="form-control" id="application_id" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="levelofstudy">Level of Study</label>
                    <input type="text" name="levelofstudy" class="form-control" id="levelofstudy" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="studentname">Student Name</label>
                    <input type="text" name="studentname" class="form-control" id="student_name" readonly>
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
                    <label for="name">Examiner 1</label>
                        <select name="examiner1" class="form-control input-lg" id="examiner1" data-live-search="true" onchange="getSelectValue1(this.value);">
                        <!-- <option value="">--Choose Examiner--</option> -->
                        </select>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Examiner 2</label>
                        <select name="examiner2" class="form-control input-lg" id="examiner2" data-live-search="true" onchange="getSelectValue2(this.value);">
                        <!-- <option value="">--Choose Examiner--</option> -->
                        </select>
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
