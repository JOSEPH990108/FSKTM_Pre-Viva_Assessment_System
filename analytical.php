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
            <h2>Report > Analytical</h2>
        </div>
    </div>

    <?php

        $sql = "SELECT COUNT(a.application_result) AS Pass FROM tbl_application a
                WHERE a.application_status = ? AND a.application_result = ?;";
        $stmt =  mysqli_stmt_init($conn);
    
        //Check connection and sql statement without any error
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Redirect to pre viva application page
            header("Location: " . ROOT . "analytical.php");
            exit();
        }
        else{
            $application_completed_status = "COMPLETED";
            $application_pass_result = 1;
            mysqli_stmt_bind_param($stmt,  "ss", $application_completed_status, $application_pass_result);
            mysqli_stmt_execute($stmt);
            $pass_result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }

        $sql1 = "SELECT COUNT(a.application_result) AS Fail FROM tbl_application a
                WHERE a.application_status = ? AND a.application_result = ?;";
        $stmt =  mysqli_stmt_init($conn);
    
        //Check connection and sql statement without any error
        if(!mysqli_stmt_prepare($stmt, $sql1)){
            //Redirect to pre viva application page
            header("Location: " . ROOT . "analytical.php");
            exit();
        }
        else{
            $application_completed_status = "COMPLETED";
            $application_fail_result = 0;
            mysqli_stmt_bind_param($stmt,  "ss", $application_completed_status, $application_fail_result);
            mysqli_stmt_execute($stmt);
            $fail_result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
        

    ?>

    <div class="ibox-content">
        <div style="display: flex; justify-content: center; align-items: center;">
          <div id="piechart" style="width: 650px; height: 500px;"></div>  
        </div>
    </div>
    
</div>


<?php
    include('templates/footer.php');
?>
