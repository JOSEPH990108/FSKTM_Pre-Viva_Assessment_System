<?php

require_once 'dbh.inc.php';

if(isset($_POST['submitbtn'])){
    $application_id = $_POST['application_id'];
    $pre_viva_date = date('Y-m-d', strtotime($_POST['pre_viva_date']));
    $pre_viva_time = $_POST['pre_viva_time'];
    $examiner1 = $_POST['examiner1'];
    $examiner2 = $_POST['examiner2'];
    $examiner1_status = "PENDING";
    $examiner2_status = "PENDING";

    $sql = "UPDATE tbl_application SET pre_viva_date = ?, pre_viva_time = ? WHERE application_id = ?;";
    $sql1 = "INSERT INTO tbl_examiner (user_id, application_id, examiner_status) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['error'] = "Something went wrong! Please contact system developer!";
        header("Location: " . ROOT . "pre_viva_application.php");
    } 
    else {
        mysqli_stmt_bind_param($stmt,  "sss", $pre_viva_date, $pre_viva_time, $application_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        if($examiner1 != "" && $examiner2 != ""){
            $stmt1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt1, $sql1)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt1, "sss", $examiner1, $application_id, $examiner1_status);
                mysqli_stmt_execute($stmt1);

                // Second examiner
                mysqli_stmt_bind_param($stmt1, "sss", $examiner2, $application_id, $examiner2_status);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_close($stmt1);
            }
        }
        else if($examiner1 != "" && $examiner2 == ""){
            $stmt1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt1, $sql1)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt1,  "sss", $application_id, $examiner1, $examiner1_status);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_close($stmt1);
            }
        }
        else if($examiner1 == "" && $examiner2 != ""){
            $stmt1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt1, $sql1)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt1,  "sss", $application_id, $examiner2, $examiner2_status);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_close($stmt1);
            }
        }
        $_SESSION['update-success'] = "Application data update successfully.";
        header("Location: " . ROOT . "pre_viva_application.php");
    }
}

?>