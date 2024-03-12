<?php

    include_once "dbh.inc.php";

    if(isset($_POST['reject_submitbtn'])){
        $remark = $_POST['examiner_remark'];
        $asexaminer = $_POST['reject_as_examiner'];
        $examiner_id = $_POST['reject_as_examiner_id'];

        $application_id = $_POST['examiner_reject_application_id'];
        $status = "REJECTED";

        if($asexaminer == "Examiner 1"){
            $sql = "UPDATE tbl_examiner SET examiner_status = ?, remark = ? WHERE application_id = ? && user_id = ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "ssss", $status, $remark, $application_id, $examiner_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $_SESSION['reject-success'] = "Inviatation reject successfully!";
                header("Location: " . ROOT . "pre_viva_application.php");
            }
        }
        else if($asexaminer == "Examiner 2"){
            $$sql = "UPDATE tbl_examiner SET examiner_status = ?, remark = ? WHERE application_id = ? && user_id = ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "ssss", $status, $remark, $application_id, $examiner_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $_SESSION['reject-success'] = "Inviatation reject successfully!";
                header("Location: " . ROOT . "pre_viva_application.php");
            }
        }
    }
?>