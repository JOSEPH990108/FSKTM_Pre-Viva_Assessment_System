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
    <!-- Table to show all Pre-Viva Application as Supervisor -->
    <div>
        <h4>Supervisor</h4>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-supervisor" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th class="d-none">Application ID</th>
                            <th>Matric No</th>
                            <th class="d-none">Student Name</th>
                            <th class="d-none">Level of Study</th>
                            <th class="d-none">Programme</th>
                            <th>Research Title</th>
                            <th>Thesis File</th>
                            <th>Plagiarism Report</th>
                            <th>Proofread Reciept</th>
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
                        //Select application and student details
                        $sql = "SELECT a.*, stu.level_of_study, stu.programme, stu.research_title, u.name, u.user_id FROM (((tbl_application a
                                INNER JOIN tbl_student stu ON a.student_id = stu.student_id)
                                INNER JOIN tbl_user u ON stu.user_id = u.user_id)
                                INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                WHERE sup.user_id = ? ;";
                
                        $stmt =  mysqli_stmt_init($conn);
                
                        //Check connection and sql statement without any error
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            //Redirect to pre viva application page
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            $application_status = "REJECTED";
                            mysqli_stmt_bind_param($stmt, "s", $userid);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                
                            //Check whether data inside the database
                            while($row = mysqli_fetch_assoc($result)){
                                //Get information
                                $application_id = $row['application_id'];
                                $matric_no = $row['user_id'];
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
                                $level_of_study = $row['level_of_study'];
                                $programme = $row['programme'];
                                $research_title = $row['research_title'];
                                $student_name = $row['name'];

                                //Check whether supervisor started thesis assessment
                                $sql1 = "SELECT tc.*, tr.* FROM ((tbl_application a
                                         INNER JOIN tbl_thesis_comment tc ON a.application_id = tc.application_id)
                                         INNER JOIN tbl_thesis_result tr ON a.application_id = tr.application_id)
                                         WHERE a.application_id = ? AND (tc.user_id = ? AND tr.user_id = ?);";
                                $stmt1 = mysqli_stmt_init($conn);
                        
                                if(!mysqli_stmt_prepare($stmt1, $sql1)){
                                    //Redirect to pre viva application page
                                    $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                    header("Location: " . ROOT . "pre_viva_application.php");
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($stmt1, "sss", $application_id, $userid, $userid);
                                    mysqli_stmt_execute($stmt1);
                                    $result1 = mysqli_stmt_get_result($stmt1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    mysqli_stmt_close($stmt1);
                                }

                                //Get the correct supervisor and examiner details
                                $sql2 ="SELECT sup.user_id AS supervisor,
                                            CASE 
                                                WHEN e1.examiner_id IS NOT NULL THEN e1.user_id ELSE NULL 
                                            END AS examiner1,
                                            CASE 
                                                WHEN e2.examiner_id IS NOT NULL THEN e2.user_id ELSE NULL 
                                            END AS examiner2
                                        FROM 
                                            tbl_application a
                                        INNER JOIN 
                                            tbl_student stu ON a.student_id = stu.student_id
                                        INNER JOIN 
                                            tbl_supervisor sup ON a.student_id = sup.student_id
                                        LEFT JOIN 
                                            (SELECT * FROM tbl_examiner WHERE examiner_id = 1) e1 ON a.application_id = e1.application_id
                                        LEFT JOIN 
                                            (SELECT * FROM tbl_examiner WHERE examiner_id = 2) e2 ON a.application_id = e2.application_id
                                        WHERE a.application_id = ?;";
                                $stmt2 = mysqli_stmt_init($conn);
                                                        
                                if(!mysqli_stmt_prepare($stmt2, $sql2)){
                                    //Redirect to pre viva application page
                                    $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                    header("Location: " . ROOT . "pre_viva_application.php");
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($stmt2, "s", $application_id);
                                    mysqli_stmt_execute($stmt2);
                                    $result2 = mysqli_stmt_get_result($stmt2);
                                    $count = mysqli_num_rows($result2);
                                    if($count != 0){
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $supervisor = $row2['supervisor'];
                                        $examiner1 = $row2['examiner1'];
                                        $examiner2 = $row2['examiner2'];
                                        mysqli_stmt_close($stmt2);
                                    }
                                    else{
                                        $supervisor = $userid;
                                        $examiner1 = NULL;
                                        $examiner2 = NULL;
                                    }

                                    //Check how many assesors
                                    if($supervisor != NULL && $examiner1 != NULL && $examiner2 != NULL)
                                        $number_of_marker = 3;
                                    else if($supervisor != NULL && $examiner1 != NULL && $examiner2 == NULL)
                                        $number_of_marker = 2;
                                    else
                                        $number_of_marker = 1;
                                    
                                    //Check how many assesors are completed thesis assessment
                                    $sql_check_current_thesis_assessment_count = 
                                            "SELECT COUNT(tr.result_id) AS total_thesis_assessment
                                            FROM tbl_thesis_comment tc
                                            INNER JOIN tbl_thesis_result tr ON (tc.application_id = tr.application_id AND tc.user_id = tr.user_id)
                                            WHERE tc.application_id = ? AND tr.application_id = ?;";
                                    $stmt3 = mysqli_stmt_init($conn);

                                    if(!mysqli_stmt_prepare($stmt3, $sql_check_current_thesis_assessment_count)){
                                        //Redirect to pre viva application page
                                        $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                        header("Location: " . ROOT . "pre_viva_application.php");
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($stmt3, "ss", $application_id, $application_id);
                                        mysqli_stmt_execute($stmt3);
                                        $result3 = mysqli_stmt_get_result($stmt3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $quantity_of_thesis_assessment = $row3['total_thesis_assessment'];
                                        mysqli_stmt_close($stmt3);
                        ?>
                        <tr>
                            <td class="align-middle">
                                <div class="action-button">
                                    <?php
                                        if($application_status == "PENDING" && $pre_viva_date == NULL && $pre_viva_time == NULL){
                                            echo '<button class="btn btn-success previva_acceptbtn" data-toggle="modal" data-target="#acceptpendingprevivaModal" data-tooltip="tooltip" title="Accept"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>';
                                            echo '<button class="btn btn-danger previva_rejectbtn" data-toggle="modal" data-target="#rejectpendingprevivaModal" data-tooltip="tooltip" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                                        }
                                        if($application_status == "PENDING" && $pre_viva_date != NULL && $pre_viva_time != NULL){
                                            echo '<button class="btn btn-warning previva_editbtn" data-toggle="modal" data-target="#editpendingprevivaModal" data-tooltip="tooltip" title="Edit"><i class="fa fa-cogs" aria-hidden="true"></i></button>';
                                        }
                                        if($application_status == 'APPROVED' && $row1 == NULL){
                                            echo '<button class="btn btn-primary assessmentbtn" data-toggle="modal" data-target="#thesisassessmentModal" data-tooltip="tooltip" title="Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'; 
                                        }
                                        if($application_status == 'APPROVED' && $row1 != NULL && $quantity_of_thesis_assessment != $number_of_marker){
                                            echo '<button class="btn btn-warning assessmenteditbtn" data-toggle="modal" data-target="#thesisassessmentModal" data-tooltip="tooltip" title="Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'; 
                                        }
                                        if($application_status == "COMPLETED" && ($quantity_of_thesis_assessment == $number_of_marker && $quantity_of_presentation_assessment == $number_of_marker)){
                                            echo '<button class="btn btn-success view_overall_markbtn" data-toggle="modal" data-target="#viewoverallthesismarkModal" data-tooltip="tooltip" title="Overview"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                                        }
                                    ?>
                                </div>
                            </td>
                            <td class="d-none"><?=$application_id; ?></td>
                            <td><?=$matric_no?></td>
                            <td class="d-none"><?=$student_name?></td>
                            <td class="d-none"><?=$level_of_study?></td>
                            <td class="d-none"><?=$programme?></td>
                            <td><?=$research_title?></td>
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
                            <td class="align-middle"><?=$pre_viva_date?></td>
                            <td class="align-middle text-center"><?=$pre_viva_time?></td>
                            <td class="align-middle text-center"><?=$pre_viva_venue_platform . '<br>' . $pre_viva_venue?></td>
                            <td class="align-middle">
                                <div class="action-button">
                                <?php
                                    if($application_status == "PENDING"){
                                        echo '<button class="btn btn-secondary" disabled>PENDING</button>';
                                    }
                                    else if($application_status == "APPROVED"){
                                        echo '<button class="btn btn-success" disabled>APPROVED</button>';
                                    }
                                    else if($application_status == "PRESENTATION"){
                                        echo '<button class="btn btn-warning" disabled>PRESENTATION</button>';
                                    }
                                    else if($application_status == "REJECTED"){
                                        echo '<button class="btn btn-danger" disabled>REJECTED</button>';
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
                                        else if(($application_status == "APPROVED"|| $application_status == "PRESENTATION") && $overall_mark == NULL){
                                            echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                        }
                                   ?>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="action-button">
                                    <?php
                                        if($quantity_of_thesis_assessment == $number_of_marker && $quantity_of_presentation_assessment == $number_of_marker){
                                            if($application_status == "COMPLETED" && $application_result == 1)
                                                echo '<button class="btn btn-success" disabled>PASSED</button>';
                                            else if($application_status == "COMPLETED" && $application_result == 0){
                                                echo '<button class="btn btn-danger" disabled>FAILED</button>';
                                            }
                                            else if(($application_status == "APPROVED"|| $application_status == "PRESENTATION") && $application_result == NULL){
                                                echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                            }
                                        }
                                        else{
                                            if($application_status == "APPROVED" && $application_result == NULL){
                                                echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                            }
                                        }
                                   ?>
                                </div>
                            </td>
                            <td><?=$remark?></td>
                        <?php
                                    }
                                }
                            }
                            mysqli_stmt_close($stmt);
                        }
                        ?>   
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pt-3">
        <h4>Examiner</h4>
        <div class="ibox-content">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-examiner" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th class="d-none">Application ID</th>
                            <th>As Examiner</th>
                            <th>Matric No</th>
                            <th class="d-none">Student Name</th>
                            <th class="d-none">Level of Study</th>
                            <th class="d-none">Programme</th>
                            <th>Research Title</th>
                            <th>Thesis File</th>
                            <th>Plagiarism</th>
                            <th>Proofread Reciept</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Application Status</th>
                            <th>Overall Mark</th>
                            <th>Application Result</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                        $sql_get_application_details = "SELECT a.*, stu.level_of_study, stu.programme, stu.research_title, u.name, u.user_id AS matric_no, sup.user_id AS supervisor, e.examiner1, e.examiner1_status, e.examiner2, e.examiner2_status 
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
                                WHERE  e.examiner1 = ? OR e.examiner2 = ?;";                    

                        $stmt =  mysqli_stmt_init($conn);
                                        
                        //Check connection and sql statement without any error
                        if(!mysqli_stmt_prepare($stmt, $sql_get_application_details)){
                            //Redirect to pre viva application page
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "ss", $userid, $userid);
                            mysqli_stmt_execute($stmt);
                            $result_of_application_details_examiner = mysqli_stmt_get_result($stmt);
                
                            //Check whether data inside the database
                            while($row = mysqli_fetch_assoc($result_of_application_details_examiner)){
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
                                $level_of_study = $row['level_of_study'];
                                $programme = $row['programme'];
                                $research_title = $row['research_title'];
                                $student_name = $row['name'];
                                $matric_no = $row['matric_no'];
                                $supervisor = $row['supervisor'];
                                $examiner1 = $row['examiner1'];
                                $examiner2 = $row['examiner2'];
                                $examiner1_status = $row['examiner1_status'];
                                $examiner2_status = $row['examiner2_status'];
                                $pre_viva_date_time = $pre_viva_date . ' ' . $pre_viva_time;
                                $pre_viva_date_time = strtotime($pre_viva_date_time);
                                $current_date_time = date('Y-m-d h:i:sa', time());
                                $current_date_time = strtotime($current_date_time);
                                if($examiner1 == $userid){
                                    $as_examiner = "Examiner 1";
                                    $examiner_userid = $examiner1;
                                    $examiner_status = $examiner1_status;
                                }
                                else{
                                    $as_examiner = "Examiner 2";
                                    $examiner_userid = $examiner2;
                                    $examiner_status = $examiner2_status;
                                }
                                $sql_get_thesis_assessment_info = "SELECT tc.*, tr.* FROM ((tbl_application a
                                         INNER JOIN tbl_thesis_comment tc ON a.application_id = tc.application_id)
                                         INNER JOIN tbl_thesis_result tr ON a.application_id = tr.application_id)
                                         WHERE a.application_id = ? AND (tc.user_id = ? AND tr.user_id = ?);";
                                $stmt2 = mysqli_stmt_init($conn);
                        
                                if(!mysqli_stmt_prepare($stmt2, $sql_get_thesis_assessment_info)){
                                    //Redirect to pre viva application page
                                    $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                    header("Location: " . ROOT . "pre_viva_application.php");
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($stmt2, "sss", $application_id, $examiner_userid, $examiner_userid);
                                    mysqli_stmt_execute($stmt2);
                                    $result_of_thesis_assessment_info = mysqli_stmt_get_result($stmt2);
                                    $row2 = mysqli_fetch_assoc($result_of_thesis_assessment_info);
                                    mysqli_stmt_close($stmt2);
                                }
        
                                    if($supervisor != NULL && $examiner1 != NULL && $examiner2 != NULL)
                                        $number_of_marker = 3;
                                    else if($supervisor != NULL && $examiner1 != NULL && $examiner2 == NULL)
                                        $number_of_marker = 2;
                                    
                                    $sql4 = "SELECT COUNT(tr.result_id) AS total_thesis_assessment
                                            FROM tbl_thesis_comment tc
                                            INNER JOIN tbl_thesis_result tr ON (tc.application_id = tr.application_id AND tc.user_id = tr.user_id)
                                            WHERE tc.application_id = ? AND tr.application_id = ?;";
                                    $stmt4 = mysqli_stmt_init($conn);

                                    if(!mysqli_stmt_prepare($stmt4, $sql4)){
                                        //Redirect to pre viva application page
                                        $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                        header("Location: " . ROOT . "pre_viva_application.php");
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($stmt4, "ss", $application_id, $application_id);
                                        mysqli_stmt_execute($stmt4);
                                        $result4 = mysqli_stmt_get_result($stmt4);
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $quantity_of_thesis_assessment = $row4['total_thesis_assessment'];

                                        mysqli_stmt_close($stmt4);
                                        
                                ?>
                        <tr>
                            <td class="align-middle">
                                <div class="action-button">
                                    <?php
                                    if($application_status == "PENDING" && $examiner_status == "PENDING"){
                                        echo '<button class="btn btn-success examineracceptbtn" data-toggle="modal" data-target="#examineracceptionModal" data-tooltip="tooltip" title="Accept"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>';
                                        echo '<button class="btn btn-danger examinerrejectbtn" data-toggle="modal" data-target="#examinerrejectionModal" data-tooltip="tooltip" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                                    }
                                    if($application_status == "PENDING" && $examiner_status == "ACCEPTED"){
                                        echo '<button class="btn btn-success" disabled>ACCEPTED</button>';
                                    }
                                    if($application_status == "PENDING" && $examiner_status == "REJECTED"){
                                        echo '<button class="btn btn-danger" disabled>REJECTED</button>';
                                    }
                                    if($application_status == 'APPROVED' && $row2 == NULL){
                                        echo '<button class="btn btn-primary assessmentbtn" data-toggle="modal" data-target="#thesisassessmentModal" data-tooltip="tooltip" title="Thesis Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'; 
                                    }
                                    if($application_status == 'APPROVED' && $row2 != NULL && $quantity_of_thesis_assessment != $number_of_marker){
                                        echo '<button class="btn btn-warning assessmenteditbtn" data-toggle="modal" data-target="#thesisassessmentModal" data-tooltip="tooltip" title="Edit Thesis Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'; 
                                    }
                                    if($application_status ==  'PRESENTATION'){
                                        $sql5 = 
                                        "SELECT COUNT(pr.present_result_id) as total_presentation_assessment
                                         FROM tbl_presentation_comment pc
                                         INNER JOIN tbl_presentation_result pr ON (pc.application_id = pr.application_id AND pc.user_id = pr.user_id)
                                         WHERE pc.application_id = ? AND pr.application_id = ?;";

                                        $stmt5 = mysqli_stmt_init($conn);
                                        if(!mysqli_stmt_prepare($stmt5, $sql5)){
                                            //Redirect to pre viva application page
                                            $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                            header("Location: " . ROOT . "pre_viva_application.php");
                                            exit();
                                        }
                                        else{
                                            mysqli_stmt_bind_param($stmt5, "ss", $application_id, $application_id);
                                            mysqli_stmt_execute($stmt5);
                                            $result5 = mysqli_stmt_get_result($stmt5);
                                            $row5 = mysqli_fetch_assoc($result5);
                                            $quantity_of_presentation_assessment = $row5['total_presentation_assessment'];
                                            mysqli_stmt_close($stmt5);
                                            $sql6 = "SELECT pc.*, pr.* FROM tbl_presentation_comment pc
                                                    INNER JOIN tbl_presentation_result pr ON pr.application_id = pc.application_id
                                                    WHERE pr.user_id = ? && pc.user_id = ?;";
                                            $stmt6 = mysqli_stmt_init($conn);
                                            if(!mysqli_stmt_prepare($stmt6, $sql6)){
                                                //Redirect to pre viva application page
                                                $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                                header("Location: " . ROOT . "pre_viva_application.php");
                                                exit();
                                            }
                                            else{
                                                mysqli_stmt_bind_param($stmt6, "ss", $examiner_userid, $examiner_userid);
                                                mysqli_stmt_execute($stmt6);
                                                $result6 = mysqli_stmt_get_result($stmt6);
                                                $row6 = mysqli_fetch_assoc($result6);
                                                if($row6 == NULL){
                                                    echo '<button class="btn btn-primary presentationassessmentbtn" data-toggle="modal" data-target="#presentationassessmentModal" data-tooltip="tooltip" title="Presentation Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                                                }else if($row5 != NULL && $quantity_of_presentation_assessment != $number_of_marker){
                                                    echo '<button class="btn btn-warning presentationassessmenteditbtn" data-toggle="modal" data-target="#presentationassessmentModal" data-tooltip="tooltip" title="Presentation Assessment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                                                }
                                            }
                                        }
                                    }
                                    if($application_status == "COMPLETED" && ($quantity_of_thesis_assessment == $number_of_marker  && $quantity_of_presentation_assessment == $number_of_marker)){
                                        echo '<button class="btn btn-success view_overall_markbtn" data-toggle="modal" data-target="#viewoverallthesismarkModal" data-tooltip="tooltip" title="Overview"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                                    }
                                ?>
                                </div>
                            </td>
                            <td class="d-none"><?=$application_id?></td>
                            <td><?=$as_examiner . ' (' . $examiner_userid . ')'?></td>
                            <td><?=$matric_no?></td>
                            <td class="d-none"><?=$student_name?></td>
                            <td class="d-none"><?=$level_of_study?></td>
                            <td class="d-none"><?=$programme?></td>
                            <td><?=$research_title?></td>
                            <td class="align-middle">
                                <div class="action-button">
                                   <button class="btn btn-outline-danger thesisbtn" data-tooltip="tooltip" title="Thesis File"><a href="<?=ROOT?>modal/open_file.php?thesis_name1=<?php echo $thesis1;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="action-button">
                                   <button class="btn btn-outline-danger plagiarismbtn" data-tooltip="tooltip" title="Plagiarism Report"><a href="<?=ROOT?>modal/open_file.php?plagiarism_name1=<?php echo $plagiarism1;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="action-button">
                                   <button class="btn btn-outline-danger proofreadbtn" data-tooltip="tooltip" title="Proofread Receipt"><a href="<?=ROOT?>modal/open_file.php?proofread_name1=<?php echo $proofread1;?>" class="text-dark" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></button> 
                                </div>
                            </td>
                            <td class="align-middle"><?=$pre_viva_date?></td>
                            <td class="align-middle text-center"><?=$pre_viva_time?></td>
                            <td class="align-middle text-center"><?=$pre_viva_venue_platform . '<br>' . $pre_viva_venue?></td>
                            <td class="align-middle">
                                <div class="action-button">
                                    <?php
                                        if($application_status == "PENDING"){
                                            echo '<button class="btn btn-secondary" disabled>PENDING</button>';
                                        }
                                        else if($application_status == "APPROVED"){
                                            echo '<button class="btn btn-success" disabled>APPROVED</button>';
                                        }
                                        else if($application_status == "PRESENTATION"){
                                            echo '<button class="btn btn-warning" disabled>PRESENTATION</button>';
                                        }
                                        else if($application_status == "REJECTED"){
                                            echo '<button class="btn btn-danger" disabled>REJECTED</button>';
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
                                            echo $overall_mark1 . '%';
                                        }
                                        else if(($application_status == "APPROVED" || $application_status =="PRESENTATION") && $overall_mark == NULL){
                                            echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                        }
                                   ?>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="action-button">
                                    
                                    <?php
                                        if($application_result == NULL){
                                            if(($application_status == "APPROVED" || $application_status == "PRESENTATION") && $application_result == NULL){
                                                echo '<button class="btn btn-warning" disabled>ASSESSING</button>';
                                            }
                                        }
                                        else{
                                            if($application_status == "COMPLETED" && $application_result == 1){
                                                echo '<button class="btn btn-success" disabled>PASSED</button>';
                                            }
                                            else if($application_status == "COMPLETED" && $application_result == 0){
                                                echo '<button class="btn btn-danger" disabled>FAILED</button>';
                                                
                                            }
                                        }
                                   ?>
                                </div>
                            </td>
                            <td clsss="d-none"><?=$remark?></td>
                            <?php
                                        }
                                    }
                                }
                        mysqli_stmt_close($stmt);
                        ?>   
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
    include('modal/accept_pending_pre_viva_modal.php');
    include('modal/reject_pending_pre_viva_modal.php');
    include('modal/edit_pending_pre_viva_modal.php');
    include('modal/examiner_accept_inviatation_modal.php');
    include('modal/examiner_reject_inviatation_modal.php');
    //  include('modal/pending_pre_viva_modal.php');
    include('modal/thesis_assessment_modal.php');
    include('modal/presentation_assessment_modal.php');
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

        if(isset($_SESSION['reject-success']) && $_SESSION['reject-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['reject-success']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['reject-success']);
        }

        if(isset($_SESSION['insert-assessment-success']) && $_SESSION['insert-assessment-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['insert-assessment-success']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['insert-assessment-success']);
        }

        if(isset($_SESSION['update-assessment-success']) && $_SESSION['update-assessment-success'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats',
                    text: '<?php echo $_SESSION['update-assessment-success']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['update-assessment-success']);
        }

        if(isset($_SESSION['insert-assessment-unsuccess']) && $_SESSION['insert-assessment-unsuccess'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['insert-assessment-unsuccess']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['insert-assessment-unsuccess']);
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

        if(isset($_SESSION['no-user-found']) && $_SESSION['no-user-found'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['no-user-found']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['no-user-found']);
        }

        if(isset($_SESSION['no-thesis-found']) && $_SESSION['no-thesis-found'] != ''){
            ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops',
                    text: '<?php echo $_SESSION['no-thesis-found']; ?>',
                    timer: 3500
                });
            </script>
            <?php
                unset($_SESSION['no-thesis-found']);
        }

    ?>