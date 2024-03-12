<?php 
    //Check login session first
    include('includes/login_check.inc.php');
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    include('templates/sidebar.php'); 
    include('templates/header.php');
?>

<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div class="head-content">
        <div class="header">
            <h2>Pre-Viva Application</h2>
        </div>
    </div>

    <?php
            $emptyCheckSql = "SELECT COUNT(*) AS total_applications FROM tbl_application";
            $stmt = mysqli_stmt_init($conn);
        
            // Prepare and execute the SQL query to check if the table is empty
            if(mysqli_stmt_prepare($stmt, $emptyCheckSql)){
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $totalApplications = $row['total_applications'];

                if($totalApplications == 0){
                    echo "<p>No applications found.</p>";
                }
                else{
    ?>
    <div class="ibox-content">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered dataTables-example" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th class="d-none">Application ID</th>
                        <th>Student</th>
                        <th>Supervisor</th>
                        <th>Examiner 1</th>
                        <th>Examiner 2</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Application Status</th>
                        <th>Overall Mark</th>
                        <th>Application Result</th>
                        <th>Remark</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                    $sql = "SELECT a.*, stu.level_of_study, stu.programme, stu.research_title, stu.user_id AS matric_no, u.name, sup.user_id AS supervisor, e.examiner1, e.examiner1_status, e.examiner2, e.examiner2_status 
                            FROM 
                                (((tbl_application a
                                INNER JOIN tbl_student stu ON a.student_id = stu.student_id)
                                INNER JOIN tbl_user u ON stu.user_id = u.user_id)
                                INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                LEFT JOIN (
                                    SELECT 
                                        application_id,
                                        MAX(CASE WHEN examiner_id = 1 THEN user_id ELSE NULL END) AS examiner1,
                                        MAX(CASE WHEN examiner_id = 1 THEN examiner_status ELSE NULL END) AS examiner1_status,
                                        MAX(CASE WHEN examiner_id = 2 THEN user_id ELSE NULL END) AS examiner2,
                                        MAX(CASE WHEN examiner_id = 2 THEN examiner_status ELSE NULL END) AS examiner2_status
                                    FROM 
                                        tbl_examiner
                                    GROUP BY 
                                        application_id
                                ) e ON a.application_id = e.application_id
                            ORDER BY a.application_id ASC;";
            
                    $stmt =  mysqli_stmt_init($conn);
            
                    //Check connection and sql statement without any error
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        //Redirect to pre viva application page
                        header("Location: " . ROOT . "all_pre_viva_application.php");
                        exit();
                    }
                    else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
            
                        //Check whether data inside the database
                        while($row = mysqli_fetch_assoc($result)){
                            //Get student id
                            $application_id = $row['application_id'];
                            $thesis = $row['thesis_file'];
                            $plagiarism = $row['plagiarism'];
                            $proofread = $row['proofread'];
                            $pre_viva_date = $row['pre_viva_date'];
                            $pre_viva_time = $row['pre_viva_time'];
                            $pre_viva_venue_platform = $row['pre_viva_venue_platform'];
                            $pre_viva_venue = $row['pre_viva_venue'];
                            $application_status = $row['application_status'];
                            $overall_mark = $row['overall_mark'];
                            $application_result = $row['application_result'];
                            $remark = $row['remark'];
                            $matric_no = $row['matric_no'];
                            $research_title = $row['research_title'];
                            $supervisor = $row['supervisor'];
                            $examiner1 = $row['examiner1'];
                            $examiner1_status = $row['examiner1_status'];
                            $examiner2 = $row['examiner2'];
                            $examiner2_status = $row['examiner2_status'];
                      
                    ?>
                    <tr>
                        <td class="align-middle">
                            <div class="action-button">
                                <?php
                                if($examiner1 != "" AND $examiner2 != ""){
                                    if(($examiner1_status == "ACCEPTED" && $examiner2_status == "ACCEPTED") && ($application_status != "REJECTED" && $application_status != "COMPLETED" && $application_status != "APPROVED" && $application_status != "PRESENTATION")){
                                        echo '<button class="btn btn-success admin_acceptprevivabtn" data-toggle="modal" data-target="#adminacceptpendingprevivaModal" data-tooltip="tooltip" title="Accept"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>';
                                        echo '<button class="btn btn-danger admin_rejectprevivabtn" data-toggle="modal" data-target="#adminrejectpendingprevivaModal" data-tooltip="tooltip" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                                    }
                                }
                                else if($examiner1 != "" AND $examiner2 == ""){
                                    if($examiner1_status == "ACCEPTED" && ($application_status != "REJECTED" && $application_status != "COMPLETED" && $application_status != "APPROVED")){
                                        echo '<button class="btn btn-success admin_acceptprevivabtn" data-toggle="modal" data-target="#adminacceptpendingprevivaModal" data-tooltip="tooltip" title="Accept"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>';
                                        echo '<button class="btn btn-danger admin_rejectprevivabtn" data-toggle="modal" data-target="#adminrejectpendingprevivaModal" data-tooltip="tooltip" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                                    }
                                }
                                    // if(($examiner1 == NULL && $examiner2 == NULL && $application_status == "REJECTED") || ($examiner1 != NULL && $examiner2 != NULL && $application_status == "REJECTED")){
                                    //     echo '<button class="btn btn-danger admin_deleteprevivabtn" data-toggle="modal" data-target="#admindeleteprevivaModal" data-tooltip="tooltip" title="Delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>';
                                    // }
                                    if($application_status == "COMPLETED" && $application_result != NULL){
                                        echo '<button class="btn btn-success view_overall_markbtn" data-toggle="modal" data-target="#viewoverallthesismarkModal" data-tooltip="tooltip" title="Overview"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="d-none"><?=$application_id?></td>
                        <td class="text-center align-middle"><button class="btn btn-outline-dark viewstudentdetailbtn"  data-toggle="modal" data-target="#viewStudentModal" data-tooltip="tooltip" title="View"><?=$matric_no?></button></td>
                        <td class="text-center align-middle"><button class="btn btn-outline-dark viewsupervisordetailbtn" data-toggle="modal" data-target="#viewAcademicStaffModal" data-tooltip="tooltip" title="View"><?=$supervisor?></button></td>
                        <td class="text-center align-middle">
                            <?php
                                if($examiner1 != NULL && $examiner1_status == "ACCEPTED"){
                                ?>
                                    <button class="btn btn-outline-dark viewexaminer1detailbtn" data-toggle="modal" data-target="#viewAcademicStaffModal" data-tooltip="tooltip" title="View"><?=$examiner1?></button>
                                <?php
                                }
                            ?>
                        </td>
                        <td class="text-center align-middle">
                            <?php
                                if($examiner2 != NULL && $examiner2_status == "ACCEPTED"){
                                ?>
                                    <button class="btn btn-outline-dark viewexaminer2detailbtn" data-toggle="modal" data-target="#viewAcademicStaffModal" data-tooltip="tooltip" title="View"><?=$examiner2?></button>
                                <?php
                                }
                            ?>
                        </td>
                        <td class="text-center align-middle"><?=$pre_viva_date?></td>
                        <td class="text-center align-middle"><?=$pre_viva_time?></td>
                        <td class="text-center align-middle"><?=$pre_viva_venue_platform . '<br>' . $pre_viva_venue?></td>
                        <td class="align-middle">
                            <div class="action-button">
                                <?php
                                    if($application_status == "PENDING"){
                                        echo '<button class="btn btn-secondary" disabled>PENDING</button>';
                                    }
                                    else if($application_status == "APPROVED"){
                                        echo '<button class="btn btn-success" disabled>APPROVED</button>';
                                    }
                                    else if($application_status == "REJECTED"){
                                        echo '<button class="btn btn-danger" disabled>REJECTED</button>';
                                    }
                                    else if($application_status == "PRESENTATION"){
                                        echo '<button class="btn btn-warning" disabled>PRESENTATION</button>';
                                    }
                                    else if($application_status == "COMPLETED"){
                                        echo '<button class="btn btn-success" disabled>COMPLETED</button>';
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <?php
                                    if($application_status == "COMPLETED" && $overall_mark != NULL){
                                        echo $overall_mark . '%';
                                    }
                                    else if(($application_status == "APPROVED" || $application_status == "PRESENTATION") && $overall_mark == NULL){
                                        echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                    }
                                ?>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <?php
                                    if($application_status == "COMPLETED"&& $application_result == 1)
                                        echo '<button class="btn btn-success" disabled>PASSED</button>';
                                    else if($application_status == "COMPLETED" && $application_result == 0){
                                        echo '<button class="btn btn-danger" disabled>FAILED</button>';
                                    }                            
                                    else if(($application_status == "APPROVED" || $application_status == "PRESENTATION") && $application_result == NULL){
                                        echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                    }                                   
                                ?>
                            </div>
                        </td>
                        <td><?=$remark?></td>
                    <?php
                            }
                        }
                    ?>   
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
    } 
}
    ?>
</div>

<?php
    include('modal/admin_approve_pending_pre_viva_modal.php');
    include('modal/admin_reject_pending_pre_viva_modal.php');
    include('modal/view_academic_staff_details_modal.php');
    include('modal/view_student_details_modal.php');
    include('modal/view_overall_pre_viva_assessment_modal.php');
    include('templates/footer.php');   
?>

<?php
    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: '<?php echo $_SESSION['error']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['error']);
    }

    if(isset($_SESSION['update-success']) && $_SESSION['update-success'] != ''){
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Congrats',
                text: '<?php echo $_SESSION['update-success']; ?>',
                timer: 3500
            });
        </script>
        <?php
            unset($_SESSION['update-success']);
    }
?>