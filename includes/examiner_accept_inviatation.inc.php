<?php

    include_once "dbh.inc.php";

    if(isset($_POST['application_id'])){
        $applicationid = $_POST['application_id'];
        $asexaminer = $_POST['examiner'];
        $examiner_id = $_POST['examiner_id'];
        $status = "ACCEPTED";

        if($asexaminer == "Examiner 1"){
            $sql = "UPDATE tbl_examiner SET examiner_status = ? WHERE application_id = ? && user_id = ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "sss", $status, $applicationid, $examiner_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
        else if($asexaminer == "Examiner 2"){
            $sql = "UPDATE tbl_examiner SET examiner_status = ? WHERE application_id = ?  && user_id = ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "sss", $status, $applicationid, $examiner_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
?>