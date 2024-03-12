<!-- Edit Pending Pre-Viva Modal -->
<div class="modal fade" id="editpendingprevivaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editpendingprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h4 class="modal-title" id="editpendingprevivaModalLabel"><strong>EDIT PENDING PENDING PRE-VIVA</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="edit_pending_pre_viva_form" name="edit_pending_pre_viva_form" class="form-row" action="<?= ROOT ?>includes/edit_pending_pre_viva.inc.php" method="POST">
        <h5 class="form-group col-md-12 mb-3 text-dark">Pre-Viva Application Information</h5>
            <div class="form-group col-md-6" hidden>
                <label for="edit_application_id">Application ID</label>
                <input type="text" name="edit_application_id" class="form-control" id="edit_application_id" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_student_name">Student Name</label>
                <input type="text" name="edit_student_name" class="form-control" id="edit_student_name" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_student_programme">Programme</label>
                <input type="text" name="edit_student_programme" class="form-control" id="edit_student_programme" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_levelofstudy">Level of Study</label>
                <input type="text" name="edit_levelofstudy" class="form-control" id="edit_levelofstudy" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="edit_research_title">Research Title</label>
                <input type="text" name="edit_research_title" class="form-control" id="edit_research_title" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_pre_viva_date">Pre-Viva Date</label>
                <input type="date" name="edit_pre_viva_date" class="form-control" id="edit_pre_viva_date">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class="form-group col-md-6">
                <label for="edit_pre_viva_time">Pre-Viva Time</label>
                <input type="time" name ="edit_pre_viva_time" class="form-control" id="edit_pre_viva_time">
                <i class="las la-check-circle"></i>
                <i class="las la-exclamation-circle"></i>
                <small>Error Message</small>
            </div>
            <div class='form-group col-md-6'>
                <div class="form-group col-md-12 p-0 m-0">
                    <label for="name">Examiner 1</label>
                    <?php
                        echo "<select name='edit_examiner1' class='form-control' id='edit_examiner1' onClick='getEditExaminer1(this.value);'>";
                        echo "<option value=''>--Choose Examiner--</option>";
                        $sql = "SELECT tbl_user.name, tbl_user.user_id, tbl_staff.designation, tbl_staff.field FROM tbl_user
                                INNER JOIN tbl_staff ON tbl_user.user_id = tbl_staff.user_id
                                WHERE tbl_staff.user_id != '$userid'
                                ORDER BY tbl_staff.field ASC, tbl_staff.designation ASC, tbl_user.name ASC;";
                        $stmt =  mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            //Redirect to login page
                            header("Location: " . ROOT);
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['name'];
                                $staff_id = $row['user_id'];
                                $designation = $row['designation'];
                                $field = $row['field'];
                                echo "<option value='$staff_id'>$name - <strong>$field</strong> ($designation)</option>";
                            }
                            echo "</select>";
                        }
                        mysqli_stmt_close($stmt);
                        ?>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12 p-0 m-0 pt-3">
                    <label for="examiner1_status">Status</label>
                    <input type="text" name="edit_examiner1_status" class="form-control" id="edit_examiner1_status" readonly>
                </div>
                <div class="form-group col-md-12 p-0 m-0 pt-3 examiner1_remark">
                    <label for="edit_examiner1_remark">Remark</label>
                    <textarea class="form-control" name="edit_examiner1_remark" id="edit_examiner1_remark"  rows="3" readonly></textarea>
                </div>
            </div>
            <div class='form-group col-md-6'>
                <div class="form-group col-md-12 p-0 m-0 p">
                    <label for="name">Examiner 2</label>
                    <?php
                        echo "<select name='edit_examiner2' class='form-control' id='edit_examiner2' onClick='getEditExaminer2(this.value);'>";
                        echo "<option value=''>--Choose Examiner--</option>";
                        $sql1 = "SELECT tbl_user.name, tbl_user.user_id, tbl_staff.designation, tbl_staff.field FROM tbl_user
                                INNER JOIN tbl_staff ON tbl_user.user_id = tbl_staff.user_id
                                WHERE tbl_staff.user_id != '$userid'
                                ORDER BY tbl_staff.field ASC, tbl_staff.designation ASC, tbl_user.name ASC;";
                        $stmt =  mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql1)){
                            //Redirect to login page
                            header("Location: " . ROOT);
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($stmt);
                            $result1 = mysqli_stmt_get_result($stmt);
                            while($row1 = mysqli_fetch_assoc($result1)){
                                $name1 = $row1['name'];
                                $staff_id1 = $row1['user_id'];
                                $designation1 = $row1['designation'];
                                $field1 = $row1['field'];
                                echo "<option value='$staff_id1'>$name1 - <strong>$field1</strong> ($designation1)</option>";
                            }
                            echo "</select>";
                        }
                        mysqli_stmt_close($stmt);
                        ?>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                 <div class="form-group col-md-12 p-0 m-0 pt-3">
                    <label for="examiner2_status">Status</label>
                    <input type="text" name="edit_examiner2_status" class="form-control" id="edit_examiner2_status" readonly>
                </div>
                <div class="form-group col-md-12 p-0 m-0 pt-3 examiner2_remark">
                    <label for="edit_examiner2_remark">Remark</label>
                    <textarea class="form-control" name="edit_examiner2_remark" id="edit_examiner2_remark"  rows="3" readonly></textarea>
                </div>
            </div>
        
            <div class="col-md-12 modal-footer">
                <button type="button" id="edit_cancelbtn" name="edit_cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" id="edit_submitbtn" name="edit_submitbtn" class="btn btn-success">Submit</button>
            </div>
        </form>
      </div> 
    </div>
  </div>
</div>
