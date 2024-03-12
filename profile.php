<?php 
    //Check login session first
    include('includes/login_check.inc.php');
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    include('templates/sidebar.php'); 
    include('templates/header.php');
?>

<?php
    $sql = "SELECT * FROM tbl_user WHERE user_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['error'] = "<span class='error'>SQL Error. Please contact us.</span>";
        header("Location: " . ROOT);
    } 
    else {
        mysqli_stmt_bind_param($stmt,  "s", $userid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
            
        //Check whether data inside the database
        if($row = mysqli_fetch_assoc($result)){
            //Get student id
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone_no'];
            $ic = $row['ic'];
            $passport = $row['passport'];
            $sex = $row['sex'];
            $race = $row['race'];
            $religion = $row['religion'];
            $country = $row['country'];
            $nationality = $row['nationality'];
            $status = $row['register_status'];
            if($status == TRUE){
                $status = "ACTIVE";
            }
            else{
                $status = "INACTIVE";
            }
        }
    }
?>

<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div class="content">
        <div class="personal_information" id="personal_information">
            <h2>Personal Information</h2>
            <form id="personal_form" name="personal_form" class="row g-3">
                <div class="form-group col-md-6">
                    <label for="userid">User ID</label>
                    <input type="text" name="userid" class="form-control" value="<?=$userid?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="sex">Sex</label>
                    <input type="text" name="sex" class="form-control" value="<?=$sex?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?=$name?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?=$email?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone No</label>
                    <input type="text" name ="phone" class="form-control" value="<?=$phone?>" >
                </div>
                <div class="form-group col-md-6">
                    <label for="ic">IC</label>
                    <input type="text" name="ic" class="form-control" value="<?=$ic?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="passport">Passport</label>
                    <input type="text" name="passport" class="form-control" value="<?=$passport?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="race">Race</label>
                    <input type="text" name="race" class="form-control" value="<?=$race?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="religion">Religion</label>
                    <input type="text" name="religion" class="form-control" value="<?=$religion?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" value="<?=$country?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="nationality">Nationality</label>
                    <input type="text" name="nationality" class="form-control" value="<?=$nationality?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control" value="<?=$status?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="usertype">User Type</label>
                    <input type="text" name="usertype" class="form-control" value="<?=$usertype?>" readonly>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button type="button" name="personalbtn" class="btn btn-success personalbtn">Save</button>
                </div>
            </form>
        </div>
        <?php
        if($usertype == "STAFF"){
            $sql1 = "SELECT * FROM tbl_staff
                     INNER JOIN tbl_user ON tbl_staff.user_id = tbl_user.user_id
                     WHERE tbl_staff.user_id = ?;";
            $stmt1 = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt1, $sql1)){
                $_SESSION['error'] = "<span class='error'>SQL Error. Please contact us.</span>";
                header("Location: " . ROOT);
            } 
            else{
                mysqli_stmt_bind_param($stmt1,  "s", $userid);
                mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);
                    
                //Check whether data inside the database
                if($row1 = mysqli_fetch_assoc($result1)){
                    //Get student id
                    $faculty = $row1['faculty'];
                    $designation = $row1['designation'];
                    $field_category = $row1['field_category'];
                    $field = $row1['field'];
                }
            }
        ?>
        <div class="academic_information" id="staff_academic_information">
            <h2>Academic Information</h2>
            <form id="academic_form" name="academic_form" class="row">
                <div class="form-group col-md-6" hidden>
                    <label for="userid">User ID</label>
                    <input type="text" name="userid" class="form-control" value="<?=$userid?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Faculty</label>
                    <input type="text" name="faculty" class="form-control" id="faculty" placeholder="FSKTM" value="<?=$faculty?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Designation</label>
                    <input type="text" name="designation" class="form-control" id="designation" value="<?=$designation?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Field Category</label>
                    <input type="text" name="field_category" class="form-control" id="field_category" value="<?=$field_category?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Field</label>
                    <input type="text" name="field" class="form-control" id="field" value="<?=$field?>">
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button type="button" name="academicbtn" class="btn btn-success academicbtn">Save</button>
                </div>
            </form>
        </div>
        <?php
        }
        ?>
        <?php
        if($usertype == "STUDENT"){
            $sql2 = "SELECT student.*, supervisor.user_id AS supervisor FROM ((tbl_student student
                     INNER JOIN tbl_user user ON student.user_id = user.user_id)
                     INNER JOIN tbl_supervisor supervisor ON student.student_id = supervisor.student_id)
                     WHERE student.user_id = ?;";
            $stmt2 = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt2, $sql2)){
                $_SESSION['error'] = "<span class='error'>SQL Error. Please contact us.</span>";
                header("Location: " . ROOT);
            } 
            else{
                mysqli_stmt_bind_param($stmt2,  "s", $userid);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);
                    
                //Check whether data inside the database
                if($row2 = mysqli_fetch_assoc($result2)){
                    //Get information
                    $faculty1 = $row2['faculty'];
                    $level_of_study = $row2['level_of_study'];
                    $programme = $row2['programme'];
                    $research_title = $row2['research_title'];
                    $supervisor = $row2['supervisor'];
                }
                mysqli_stmt_close($stmt2);

                $sql3 = "SELECT user.name, staff.designation FROM tbl_user user
                         INNER JOIN tbl_staff staff ON user.user_id = staff.user_id
                         WHERE user.user_id = ?;";
                $stmt3 = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt3, $sql3)){
                    $_SESSION['error'] = "<span class='error'>SQL Error. Please contact us.</span>";
                    header("Location: " . ROOT);
                } 
                else{
                    mysqli_stmt_bind_param($stmt3,  "s", $supervisor);
                    mysqli_stmt_execute($stmt3);
                    $result3 = mysqli_stmt_get_result($stmt3);
                        
                    //Check whether data inside the database
                    if($row3 = mysqli_fetch_assoc($result3)){
                        //Get information
                        $supervisor_name = $row3['name'];
                        $supervisor_designation = $row3['designation'];
                    }
                    mysqli_stmt_close($stmt3);
                }
            }
        
        ?>
        <div class="academic_information" id="student_academic_information">
            <h2>Academic Information</h2>
            <form id="academic_form" name="academic_form" class="row">
                <div class="form-group col-md-6" hidden>
                    <label for="userid">User ID</label>
                    <input type="text" name="userid" class="form-control" value="<?=$userid?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="name">Faculty</label>
                    <input type="text" name="faculty1" class="form-control" id="faculty1" placeholder="FSKTM" value="<?=$faculty1?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="level_of_study">Level of Study</label>
                    <input type="text" name="level_of_study" class="form-control" id="level_of_study" value="<?=$level_of_study?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="programme">Programme</label>
                    <input type="text" name="programme" class="form-control" id="programme" value="<?=$programme?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="supervisor">Supervisor</label>
                    <input type="text" name="supervisor" class="form-control" id="supervisor" value="<?=$supervisor_name . ' (' . $supervisor_designation . ')'?>" readonly>
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="research_title">Research Title</label>
                    <input type="text" name="research_title" class="form-control" id="research_title" value="<?=$research_title?>">
                    <i class="las la-check-circle"></i>
                    <i class="las la-exclamation-circle"></i>
                    <small>Error Message</small>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button type="button" name="studentacademicbtn" class="btn btn-success studentacademicbtn">Save</button>
                </div>
            </form>
        </div>
        <?php
        }
        ?>
    </div>
</div>


<?php
    include('templates/footer.php');
?>