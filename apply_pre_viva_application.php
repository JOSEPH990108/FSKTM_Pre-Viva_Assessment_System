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
        <div class="add_button">
            <?php
                $sql = "SELECT a.application_status, a.application_result FROM ((tbl_student s
                INNER JOIN tbl_user u ON s.user_id = u.user_id)
                INNER JOIN tbl_application a ON s.student_id = a.student_id)
                WHERE s.user_id = ?
                ORDER BY a.application_id DESC;";

                $stmt =  mysqli_stmt_init($conn);
                            
                //Check connection and sql statement without any error
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    //Redirect to pre viva application page
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $userid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyprevivaModal">Apply Pre-Viva</button>';
                    }
                    else{
                        $current_application_status = $row['application_status'];
                        $current_application_result = $row['application_result'];
                        
                        if($current_application_status == "REJECTED" || ($current_application_status == "COMPLETED" && $current_application_result == 0)){
                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyprevivaModal">Apply Pre-Viva</button>';            
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
                ?>
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
                if($totalApplications != 0){
            ?>
    <!-- Table to show all Application -->
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th class="d-none">Application ID</th>
                        <th>Supervisor</th>
                        <th>Examiner 1</th>
                        <th>Examiner 2</th>
                        <th>Thesis File</th>
                        <th>Plagiarism Report</th>
                        <th>Proofread Receipt</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th>Overall Mark</th>
                        <th>Result</th>
                        <th>Remark</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                    $sql1 = "SELECT a.*, stu.level_of_study, stu.programme, stu.research_title, stu.user_id AS matric_no, u.name, sup.user_id AS supervisor, e.examiner1, e.examiner1_status, e.examiner2, e.examiner2_status 
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
                            WHERE u.user_id = ?;";
            
                    $stmt =  mysqli_stmt_init($conn);
            
                    //Check connection and sql statement without any error
                    if(!mysqli_stmt_prepare($stmt, $sql1)){
                        //Redirect to pre viva application page
                        header("Location: " . ROOT . "apply_pre_viva_application.php");
                        exit();
                    }
                    else{
            
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result1 = mysqli_stmt_get_result($stmt);
            
                        //Check whether data inside the database
                        while($row1 = mysqli_fetch_assoc($result1)){

                            $application_id = $row1['application_id'];
                            $thesis = $row1['thesis_file'];
                            $plagiarism = $row1['plagiarism'];
                            $proofread = $row1['proofread'];
                            $pre_viva_date = $row1['pre_viva_date'];
                            $pre_viva_time = $row1['pre_viva_time'];
                            $pre_viva_venue = $row1['pre_viva_venue'];
                            $application_status = $row1['application_status'];
                            $overall_mark = $row1['overall_mark'];
                            $application_result = $row1['application_result'];
                            $remark = $row1['remark'];
                            $examiner1 = $row1['examiner1'];
                            $examiner2 = $row1['examiner2'];

                    ?>
                    <tr>
                        <td class="align-middle">
                            <div class="action-button">
                                <?php
                                    if($application_status == "COMPLETED"){
                                        echo '<button class="btn btn-success view_overall_markbtn" data-toggle="modal" data-target="#viewoverallthesismarkModal" data-tooltip="tooltip" title="Overview"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                                    }
                                ?>
                            </div>
                        </td> 
                        <td class="d-none"><?=$application_id?></td>            
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-primary viewsupervisorbtn" data-toggle="modal" data-target="#viewdetailsModal" data-tooltip="tooltip" title="View Supervisor"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-primary viewexaminer1btn" data-toggle="modal" data-target="#viewdetailsModal" data-tooltip="tooltip" title="View Examiner 1"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-primary viewexaminer2btn" data-toggle="modal" data-target="#viewdetailsModal" data-tooltip="tooltip" title="View Examiner 2"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-outline-danger thesisbtn" data-tooltip="tooltip" title="Thesis File"><a href="<?=ROOT?>modal/open_file.php?thesis_name=<?php echo $thesis;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-outline-danger plagiarismbtn" data-tooltip="tooltip" title="Plagiarism Report"><a href="<?=ROOT?>modal/open_file.php?plagiarism_name=<?php echo $plagiarism;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="action-button">
                                <button class="btn btn-outline-danger proofreadbtn" data-tooltip="tooltip" title="Proofread Receipt"><a href="<?=ROOT?>modal/open_file.php?proofread_name=<?php echo $proofread;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                            </div>
                        </td>
                        <td class='d-none'><?=$examiner1?></td>
                        <td class='d-none'><?=$examiner2?></td>
                        <td><?=$pre_viva_date?></td>
                        <td><?=$pre_viva_time?></td>
                        <td><?=$pre_viva_venue?></td>
                        <td class="align-middle">
                            <?php
                                if($application_status == "PENDING"){
                                    echo '<button class="btn btn-secondary" disabled>PENDING</button>';
                                }
                                else if($application_status == "ACCEPTED"){
                                    echo '<button class="btn btn-success" disabled>ACCEPTED</button>';
                                }
                                else if($application_status == "APPROVED"){
                                    echo '<button class="btn btn-primary" disabled>ASSESSING</button>';
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
                            <?php
                                if($application_status == "COMPLETED" && $application_result == "1")
                                    echo '<button class="btn btn-success" data-tooltip="tooltip" title="Congrats" disabled>PASSED</button>';
                                else if($application_status == "COMPLETED" && $application_result == "0"){
                                    echo '<button class="btn btn-danger" data-tooltip="tooltip" title="Redo Pre-viva" disabled>FAILED</button>';
                                }
                                else if(($application_status == "APPROVED" || $application_status == "PRESENTATION") && $application_result == NULL){
                                    echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                }
                            ?>
                        </td>
                        <td><?=$remark?></td>
                    <?php
                            }
                            mysqli_stmt_close($stmt);
                        }
                    ?>   
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
    }else{
        ?>
    <div>
        <span>No Application Records!</span>
    </div>
<?php
    }
}
    ?>
</div>

<?php
    include('modal/apply_pre_viva_modal.php');
    include('modal/view_details_modal.php');
    include('modal/thesis_assessment_modal.php');
    include('modal/view_overall_pre_viva_assessment_modal.php');
?>

<?php
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

        if(isset($_SESSION['file-size-error']) && $_SESSION['file-size-error'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['file-size-error']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['file-size-error']);
        }

        if(isset($_SESSION['max-upload-file-size']) && $_SESSION['max-upload-file-size'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['max-upload-file-size']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['max-upload-file-size']);
        }

        if(isset($_SESSION['upload-file-error']) && $_SESSION['upload-file-error'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['upload-file-error']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['upload-file-error']);
        }

        if(isset($_SESSION['create-folder-error']) && $_SESSION['create-folder-error'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['create-folder-error']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['create-folder-error']);
        }

        if(isset($_SESSION['folder-exist']) && $_SESSION['folder-exist'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['folder-exist']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['folder-exist']);
        }

        if(isset($_SESSION['apply-success']) && $_SESSION['apply-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['apply-success']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['apply-success']);
        }

?>