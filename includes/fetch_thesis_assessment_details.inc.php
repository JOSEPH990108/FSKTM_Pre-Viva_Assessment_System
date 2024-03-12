<?php

    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];
    $outputs = [];

    if(isset($_POST['application_id'])){
        $application_id = $_POST['application_id'];

        $sql = "SELECT tc.*, tr.* FROM ((tbl_application a
                INNER JOIN tbl_thesis_comment tc ON a.application_id = tc.application_id)
                INNER JOIN tbl_thesis_result tr ON a.application_id = tr.application_id)
                WHERE a.application_id = ? AND (tc.user_id = ? AND tr.user_id = ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "sss", $application_id, $userid, $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(!$row = mysqli_fetch_assoc($result)){
                $_SESSION['no-record-found'] = "No record found!";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                $outputs += $row;
                echo json_encode($outputs);
                exit();
            }
        }
    }

?>