<?php

require_once 'dbh.inc.php';

if(isset($_POST['edit_submitbtn'])){
    $application_id = $_POST['edit_application_id'];
    $examiner1 = $_POST['edit_examiner1'];
    $examiner2 = $_POST['edit_examiner2'];
    $examiner1_status = $_POST['edit_examiner1_status'];
    $examiner2_status = $_POST['edit_examiner2_status'];
    $pre_viva_date = $_POST['edit_pre_viva_date'];
    $pre_viva_time = $_POST['edit_pre_viva_time'];

    if($examiner1_status == 'PENDING' && $examiner2_status == 'PENDING'){
        $sql = "UPDATE tbl_application SET pre_viva_date = ?, pre_viva_time = ?
                WHERE application_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt, "sss", $pre_viva_date, $pre_viva_time, $application_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['update-success'] = "Application data update successfully.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
    }
    else if($examiner1_status == 'REJECTED' && $examiner2_status == 'REJECTED'){
        $updated_examiner1_status = 'PENDING';
        $updated_examiner1_remark = '';
        $updated_examiner2_status = 'PENDING';
        $updated_examiner2_remark = '';
        $sql = "UPDATE tbl_examiner SET user_id = ?, examiner_status = ?, remark = ? 
                WHERE application_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $examiner1, $updated_examiner1_status, $updated_examiner1_remark, $application_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['update-success'] = "Application data update successfully.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
    }
    else if($examiner1_status == 'REJECTED' && $examiner2_status != 'REJECTED'){
        $updated_examiner1_status = 'PENDING';
        $updated_examiner1_remark = '';
        $sql = "UPDATE tbl_examiner SET user_id = ?, examiner_status = ?, remark = ?
                WHERE application_id = ? && examiner_status = 'REJECTED';";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $examiner1, $updated_examiner1_status, $updated_examiner1_remark, $application_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['update-success'] = "Application data update successfully.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
    }
    else if($examiner1_status != 'REJECTED' && $examiner2_status == 'REJECTED'){
        $updated_examiner2_status = 'PENDING';
        $updated_examiner2_remark = '';
        $sql = "UPDATE tbl_examiner SET user_id = ?, examiner_status = ?, remark = ?  
                WHERE application_id = ? && examiner_status = 'REJECTED';";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $examiner2, $updated_examiner2_status, $updated_examiner2_remark, $application_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['update-success'] = "Application data update successfully.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
    }
    else{
        $_SESSION['nothing-updated'] = "Nothing to be updated.";
        header("Location: " . ROOT . "pre_viva_application.php");
        exit();
    }
}
?>