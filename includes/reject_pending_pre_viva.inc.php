<?php

require_once 'dbh.inc.php';

if(isset($_POST['reject_submitbtn'])){

    $application_id = $_POST['reject_application_id'];
    $remark = $_POST['supervisor_remark'];
    $application_status = "REJECTED";

    $sql = "UPDATE tbl_application SET application_status = ?, remark = ?
            WHERE application_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['error'] = "Something went wrong! Please contact system developer!";
        header("Location: " . ROOT . "pre_viva_application.php");
    } 
    else{
        mysqli_stmt_bind_param($stmt, "sss", $application_status, $remark, $application_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['reject-success'] = "Application reject successfully.";
        header("Location: " . ROOT . "pre_viva_application.php");
        exit();
    }
}
?>