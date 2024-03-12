<!-- Accept Pending Pre-Viva Modal -->
<div class="modal fade" id="acceptpendingprevivaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="acceptpendingprevivaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-title">
            <h4 class="modal-title" id="acceptpendingprevivaModalLabel"><strong>ACCEPT PENDING PRE-VIVA</strong></h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="accept_pending_pre_viva_form" name="accept_pending_pre_viva_form" class="form-row" action="<?= ROOT ?>includes/accept_pending_pre_viva.inc.php" method="POST">
                <h5 class="form-group col-md-12 mb-3 text-dark">Pre-Viva Application Information</h5>
                <div class="form-group col-md-6" hidden>
                    <label for="application_id">Application ID</label>
                    <input type="text" name="application_id" class="form-control" id="application_id" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="studentname">Student Name</label>
                    <input type="text" name="studentname" class="form-control" id="student_name" readonly>
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
                    <label for="examiner1">Examiner 1</label>
                    <?php
                        echo "<select name='examiner1' class='form-control' id='examiner1' onChange='getExaminer1(this.value);'>";
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
                <div class="form-group col-md-6">
                    <label for="examiner2">Examiner 2</label>
                    <?php
                        echo "<select name='examiner2' class='form-control' id='examiner2' onChange='getExaminer2(this.value);'>";
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
                <div class="col-md-12 modal-footer">
                    <button type="button" id="cancelbtn" name="cancelbtn" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success">Submit</button>
                </div>
            </form>
      </div> 
    </div>
  </div>
</div>
