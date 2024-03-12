<?php 
    //Check login session first
    include('includes/login_check.inc.php');
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    include('templates/sidebar.php'); 
    include('templates/header.php');
?>

<?php
if($usertype == "ADMIN"){
?>
<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div id="overview">
        <h2 class="dash-title">Dashboard</h2>
        <div class="dash-cards">
            <div id="user_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                    <h5>Student</h5>
                    <?php
                        $sql = "SELECT COUNT(DISTINCT user_id) AS total_user
                                FROM tbl_user
                                WHERE user_type = ? AND register_status = ?;";
                        $stmt =  mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            //Redirect to login page
                            header("Location: " . ROOT);
                            exit();
                        }
                        else{
                            $status = 1;
                            $user_type = "STUDENT";
                            mysqli_stmt_bind_param($stmt, "ss", $user_type, $status);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if($row = mysqli_fetch_assoc($result)){
                                $total_user = $row['total_user'];
                            }
                            mysqli_stmt_close($stmt); 
                        }
                    ?>
                    <h4><?=$total_user?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>manage_student.php">View all</a>
                </div>
            </div>

            <div id="application_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Applications</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS total_application
                                     FROM tbl_application;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_application = $row['total_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>all_pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="progress_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>In Progress</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS total_pending_application
                                    FROM tbl_application
                                    WHERE application_status != ? AND application_status != ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                $application_completed_status = "COMPLETED";
                                $application_rejected_status = "REJECTED";
                                mysqli_stmt_bind_param($stmt, "ss", $application_rejected_status, $application_completed_status);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_pending_application = $row['total_pending_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_pending_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>all_pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="done_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Done</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS total_completed_application
                                    FROM tbl_application
                                    WHERE application_status = ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                $application_status = "COMPLETED";
                                mysqli_stmt_bind_param($stmt, "s", $application_status);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_completed_application = $row['total_completed_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_completed_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>all_pre_viva_application.php">View all</a>
                </div>
            </div>
        </div>
    </div>
    <section id="recent_activities" class="recent">
        <h3>Recent activity</h3>
        <!-- Table to show all application inside database but still pending -->
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
                    echo "<p>No recent activities found.</p>";
                }
                else{
        ?>
        <div class="ibox-content">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered dataTables-example" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Supervisor</th>
                        <th>Examiner 1</th>
                        <th>Examiner 2</th>
                        <th>Research Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th>Overall Mark</th>
                        <th>Application Result</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT a.*, stu.user_id AS matric_no, stu.research_title, sup.user_id AS supervisor,        
                                CASE 
                                    WHEN e1.examiner_id IS NOT NULL THEN e1.user_id ELSE NULL 
                                END AS examiner1,
                                CASE 
                                    WHEN e1.examiner_id IS NOT NULL THEN e1.examiner_status ELSE NULL 
                                END AS examiner1_status,
                                CASE 
                                    WHEN e2.examiner_id IS NOT NULL THEN e2.user_id ELSE NULL 
                                END AS examiner2,
                                CASE 
                                    WHEN e2.examiner_id IS NOT NULL THEN e2.examiner_status ELSE NULL 
                                END AS examiner2_status
                            FROM 
                                tbl_application a
                            INNER JOIN 
                                tbl_supervisor sup ON sup.student_id = a.student_id
                            INNER JOIN 
                                tbl_student stu ON stu.student_id = a.student_id
                            LEFT JOIN 
                                (SELECT * FROM tbl_examiner WHERE examiner_id = 1) e1 ON e1.application_id = a.application_id
                            LEFT JOIN 
                                (SELECT * FROM tbl_examiner WHERE examiner_id = 2) e2 ON e2.application_id = a.application_id;
                            ";
            
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
                            <td class="text-center align-middle"><button class="btn btn-outline-dark" disable><?=$matric_no?></button></td>
                            <td class="text-center align-middle"><button class="btn btn-outline-dark" disable><?=$supervisor?></button></td>
                            <td class="text-center align-middle">
                                <?php
                                    if($examiner1 != NULL){
                                    ?>
                                        <button class="btn btn-outline-dark" disable><?=$examiner1?></button>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td class="text-center align-middle">
                                <?php
                                    if($examiner2 != NULL){
                                    ?>
                                        <button class="btn btn-outline-dark" disable><?=$examiner2?></button>
                                    <?php
                                    }
                                ?>
                            </td>
                            <td><?=$research_title?></td>
                            <td><?=$pre_viva_date?></td>
                            <td class="text-center align-middle"><?=$pre_viva_time?></td>
                            <td class="text-center align-middle"><?=$pre_viva_venue_platform . '<br>' . $pre_viva_venue?></td>
                            <td class="text-center align-middle"><?php if($overall_mark != NULL){echo $overall_mark . '%';}?></td>
                            <td class="text-center align-middle"><?=$application_result?></td>
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
    </section>  
</div>
<?php
}
?>

<?php
if($usertype == "STAFF"){
    ?>
<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div id="overview">
        <h2 class="dash-title">Dashboard</h2>
        <div class="dash-cards">
            <div id="application_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Applications</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT a.application_id) AS total_application FROM ((tbl_application a
                                    INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                    INNER JOIN tbl_examiner exam ON a.application_id = exam.application_id)
                                    WHERE sup.user_id = ? OR exam.user_id = ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT . "home.php");
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "ss", $userid, $userid);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_application = $row['total_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="progress_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>In Progress</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT a.application_id) AS total_application_in_progress FROM ((tbl_application a
                                    INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                    LEFT JOIN tbl_examiner exam ON a.application_id = exam.application_id)
                                    WHERE (sup.user_id = ? OR exam.user_id = ?) AND (a.application_status != ? AND a.application_status != ?);";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT . "home.php");
                                exit();
                            }
                            else{
                                $application_completed = "COMPLETED";
                                $application_rejected = "REJECTED";
                                mysqli_stmt_bind_param($stmt, "ssss", $userid, $userid, $application_rejected, $application_completed);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_application_in_progress = $row['total_application_in_progress'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_application_in_progress?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="done_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Done</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT a.application_id) AS total_application_completed FROM ((tbl_application a
                                    INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                    INNER JOIN tbl_examiner exam ON a.application_id = exam.application_id)
                                    WHERE (sup.user_id = ? OR exam.user_id = ?) AND a.application_status = ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT . "home.php");
                                exit();
                            }
                            else{
                                $application_status = "COMPLETED";
                                mysqli_stmt_bind_param($stmt, "sss", $userid, $userid, $application_status);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_application_completed = $row['total_application_completed'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_application_completed?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="pre_viva_application.php">View all</a>
                </div>
            </div>
        </div>
    </div>
  
    <section id="recent_activities" class="recent">
        <h3>Recent activity</h3>
        <!-- Table to show all application inside database but still pending -->
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
                    echo "<p>No recent activities found.</p>";
                }
                else{
        ?>
        <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dataTables-supervisor" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="d-none">Application ID</th>
                        <th>Matric No</th>
                        <th>Research Title</th>
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
                        $sql = "SELECT a.*, stu.level_of_study, stu.programme, stu.research_title, u.user_id FROM ((((tbl_application a
                                INNER JOIN tbl_student stu ON a.student_id = stu.student_id)
                                INNER JOIN tbl_user u ON stu.user_id = u.user_id)
                                INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                LEFT JOIN tbl_examiner exam ON a.application_id = exam.application_id)
                                WHERE (sup.user_id = ? OR exam.user_id = ?) AND a.application_status != ?;";
                
                        $stmt =  mysqli_stmt_init($conn);
                
                        //Check connection and sql statement without any error
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            //Redirect to pre viva application page
                            header("Location: " . ROOT . "home.php");
                            exit();
                        }
                        else{
                            $application_rejected_status = "REJECTED";
                            mysqli_stmt_bind_param($stmt, "sss", $userid, $userid, $application_rejected_status);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                
                            //Check whether data inside the database
                            while($row = mysqli_fetch_assoc($result)){
                                //Get information
                                $application_id = $row['application_id'];
                                $pre_viva_date = $row['pre_viva_date'];
                                $pre_viva_time = $row['pre_viva_time'];
                                $pre_viva_venue_platform = $row['pre_viva_venue_platform'];
                                $pre_viva_venue = $row['pre_viva_venue'];
                                $application_status = $row['application_status'];
                                $overall_mark = $row['overall_mark'];
                                $application_result = $row['application_result'];
                                $remark = $row['remark'];
                                $research_title = $row['research_title'];
                                $matric_no = $row['user_id'];

                                //Check whether supervisor started thesis assessment
                                $sql1 = "SELECT tc.*, tr.* FROM ((tbl_application a
                                         INNER JOIN tbl_thesis_comment tc ON a.application_id = tc.application_id)
                                         INNER JOIN tbl_thesis_result tr ON a.application_id = tr.application_id)
                                         WHERE a.application_id = ? AND (tc.user_id = ? AND tr.user_id = ?);";
                                $stmt1 = mysqli_stmt_init($conn);
                        
                                if(!mysqli_stmt_prepare($stmt1, $sql1)){
                                    //Redirect to pre viva application page
                                    $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                    header("Location: " . ROOT . "home.php");
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
                                    header("Location: " . ROOT . "home.php");
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($stmt2, "s", $application_id);
                                    mysqli_stmt_execute($stmt2);
                                    $result2 = mysqli_stmt_get_result($stmt2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $supervisor = $row2['supervisor'];
                                    $examiner1 = $row2['examiner1'];
                                    $examiner2 = $row2['examiner2'];
                                    mysqli_stmt_close($stmt2);

                                    //Check how many assesors
                                    if($supervisor != NULL && $examiner1 != NULL && $examiner2 != NULL)
                                        $number_of_marker = 3;
                                    else if($supervisor != NULL && $examiner1 != NULL && $examiner2 == NULL)
                                        $number_of_marker = 2;
                                    else{
                                        $number_of_marker = 1;
                                    }
                                    
                                    //Check how many assesors are completed thesis assessment
                                    $sql3 = "SELECT tc.*, tr.* FROM tbl_thesis_comment tc
                                             INNER JOIN tbl_thesis_result tr ON (tc.application_id = tr.application_id AND tc.user_id = tr.user_id)
                                             WHERE tc.application_id = ? AND tr.application_id = ?;";
                                    $stmt3 = mysqli_stmt_init($conn);

                                    if(!mysqli_stmt_prepare($stmt3, $sql3)){
                                        //Redirect to pre viva application page
                                        $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                        header("Location: " . ROOT . "home.php");
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($stmt3, "ss", $application_id, $application_id);
                                        mysqli_stmt_execute($stmt3);
                                        $result3 = mysqli_stmt_get_result($stmt3);
                                        $rowcount = mysqli_num_rows($result3);
                                        mysqli_stmt_close($stmt3);
                        ?>
                    <tr>
                        <td class="d-none"><?=$application_id; ?></td>
                        <td class="align-middle text-center"><button class="btn btn-outline-dark" disable><?=$matric_no?></button></td>
                        <td class="align-middle"><?=$research_title?></td>
                        <td class="align-middle"><?=$pre_viva_date?></td>
                        <td class="align-middle text-center"><?=$pre_viva_time?></td>
                        <td class="align-middle text-center"><?=$pre_viva_venue_platform . '<br>'  . $pre_viva_venue?></td>
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
                                    if($rowcount == $number_of_marker){
                                        if($application_status == "COMPLETED" && $application_result == 1)
                                            echo '<button class="btn btn-success" disabled>PASSED</button>';
                                        else if($application_status == "COMPLETED" &&$application_result == 0){
                                            echo '<button class="btn btn-danger" disabled>FAILED</button>';
                                        }
                                        else if(($application_status == "APPROVED" || $application_status == "PRESENTATION") && $overall_mark == NULL){
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
    <?php
      }
    }
    ?>
    </section>
</div>

    <?php
}
?>

<?php
if($usertype == "STUDENT"){
    ?>
<!-- Main Content -->
<div class="main-content" onclick="removeToggle();">
    <div id="overview">
        <h2 class="dash-title">Dashboard</h2>
        <div class="dash-cards">
            
            <div id="application_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Applications</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS total_application FROM ((tbl_student student
                                     INNER JOIN tbl_application a ON student.student_id = a.student_id)
                                     INNER JOIN tbl_user u ON student.user_id = u.user_id)
                                     WHERE u.user_id = ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "s", $userid);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $total_application = $row['total_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$total_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>apply_pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="progress_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>In Progress</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS pending_application FROM ((tbl_student student
                                     INNER JOIN tbl_application a ON student.student_id = a.student_id)
                                     INNER JOIN tbl_user u ON student.user_id = u.user_id)
                                     WHERE u.user_id = ? AND a.application_status != ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                $application_status = "COMPLETED";
                                mysqli_stmt_bind_param($stmt, "ss", $userid, $application_status);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $pending_application = $row['pending_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$pending_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>apply_pre_viva_application.php">View all</a>
                </div>
            </div>

            <div id="done_card" class="card-single">
                <div class="card-body">
                    <span><i class="las la-user"></i></span>
                    <div>
                        <h5>Done</h5>
                        <?php
                            $sql = "SELECT COUNT(DISTINCT application_id) AS completed_application FROM ((tbl_student student
                                     INNER JOIN tbl_application a ON student.student_id = a.student_id)
                                     INNER JOIN tbl_user u ON student.user_id = u.user_id)
                                     WHERE u.user_id = ? AND a.application_status = ? AND a.application_result != ?;";
                            $stmt =  mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                //Redirect to login page
                                header("Location: " . ROOT);
                                exit();
                            }
                            else{
                                $application_status = "COMPLETED";
                                $application_result = "NULL";
                                mysqli_stmt_bind_param($stmt, "sss", $userid, $application_status, $application_result);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($row = mysqli_fetch_assoc($result)){
                                    $completed_application = $row['completed_application'];
                                }
                                mysqli_stmt_close($stmt); 
                            }
                        ?>
                        <h4><?=$completed_application?></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=ROOT?>apply_pre_viva_application.php">View all</a>
                </div>
            </div>
        </div>
    </div>
  
    <section id="recent_activities" class="recent">
        <h3>Recent activity</h3>
        <!-- Table to show all application inside database but still pending -->
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
                    echo "<p>No recent activities found.</p>";
                }
                else{
        ?>
        <div class="ibox-content">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered dataTables-example" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Supervisor</th>
                        <th>Examiner 1</th>
                        <th>Examiner 2</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th>Overall Mark</th>
                        <th>Application Result</th>
                        <th>Remark</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                    $sql = "SELECT a.*, stu.user_id AS matric_no, stu.research_title, sup.user_id AS supervisor, 
                                CASE 
                                    WHEN e1.examiner_id IS NOT NULL THEN e1.user_id ELSE NULL 
                                END AS examiner1,
                                CASE 
                                    WHEN e1.examiner_id IS NOT NULL THEN e1.examiner_status ELSE NULL 
                                END AS examiner1_status,
                                CASE 
                                    WHEN e2.examiner_id IS NOT NULL THEN e2.user_id ELSE NULL 
                                END AS examiner2,
                                CASE 
                                    WHEN e2.examiner_id IS NOT NULL THEN e2.examiner_status ELSE NULL 
                                END AS examiner2_status
                            FROM 
                                tbl_application a
                            INNER JOIN 
                                tbl_supervisor sup ON sup.student_id = a.student_id
                            INNER JOIN 
                                tbl_student stu ON stu.student_id = a.student_id
                            LEFT JOIN 
                                (SELECT *, ROW_NUMBER() OVER (PARTITION BY application_id ORDER BY examiner_id) AS row_num FROM tbl_examiner) e1 
                                ON e1.application_id = a.application_id AND e1.row_num = 1
                            LEFT JOIN 
                                (SELECT *, ROW_NUMBER() OVER (PARTITION BY application_id ORDER BY examiner_id) AS row_num FROM tbl_examiner) e2 
                                ON e2.application_id = a.application_id AND e2.row_num = 2
                            WHERE 
                                stu.user_id = ?;";
                
            
                    $stmt =  mysqli_stmt_init($conn);
            
                    //Check connection and sql statement without any error
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        //Redirect to pre viva application page
                        header("Location: " . ROOT . "all_pre_viva_application.php");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $userid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        //Check whether data inside the database
                        while($row = mysqli_fetch_assoc($result)){
                            //Get student id
                            $application_id = $row['application_id'];
                            $pre_viva_date = $row['pre_viva_date'];
                            $pre_viva_time = $row['pre_viva_time'];
                            $pre_viva_venue_platform = $row['pre_viva_venue_platform'];
                            $pre_viva_venue = $row['pre_viva_venue'];
                            $application_status = $row['application_status'];
                            $overall_mark = $row['overall_mark'];
                            $application_result = $row['application_result'];
                            $remark = $row['remark'];
                            $supervisor = $row['supervisor'];
                            $examiner1 = $row['examiner1'];
                            $examiner1_status = $row['examiner1_status'];
                            $examiner2 = $row['examiner2'];
                            $examiner2_status = $row['examiner2_status'];
                      
                    ?>
                    <tr>
                        <td class="text-center align-middle"><button class="btn btn-outline-dark" disable><?=$supervisor?></button></td>
                        <td class="text-center align-middle">
                            <?php
                                if($examiner1 != NULL && $examiner1_status != "REJECTED" || $examiner1_status != "NULL"){
                                ?>
                                    <button class="btn btn-outline-dark" disable><?=$examiner1?></button>
                                <?php
                                }
                            ?>
                        </td>
                        <td class="text-center align-middle">
                            <?php
                                if($examiner2 != NULL && $examiner2_status != "REJECTED" || $examiner2_status != "NULL"){
                                ?>
                                    <button class="btn btn-outline-dark" disable><?=$examiner2?></button>
                                <?php
                                }
                            ?>
                        </td>
                        <td><?=$pre_viva_date?></td>
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

                                    if($application_status == "COMPLETED" && $application_result == 1)
                                        echo '<button class="btn btn-success" disabled>PASSED</button>';
                                    else if($application_status == "COMPLETED" &&$application_result == 0){
                                        echo '<button class="btn btn-danger" disabled>FAILED</button>';
                                    }
                                    else if(($application_status == "APPROVED" && $application_result == NULL) || $application_status == "PRESENTATION" && $application_result == NULL){
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
    </section>
</div>

    <?php
}
?>


<?php
    include('templates/footer.php');
?>

<?php
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