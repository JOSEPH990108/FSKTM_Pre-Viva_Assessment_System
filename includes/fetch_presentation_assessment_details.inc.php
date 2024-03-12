<?php

    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];
    $outputs = [];

    if(isset($_POST['application_id'])){
        $application_id = $_POST['application_id'];

        $sql = "SELECT tpc.*, tpr.* FROM ((tbl_application a
                INNER JOIN tbl_presentation_comment tpc ON a.application_id = tpc.application_id)
                INNER JOIN tbl_presentation_result tpr ON a.application_id = tpr.application_id)
                WHERE a.application_id = ? AND (tpc.user_id = ? AND tpr.user_id = ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "sss", $application_id, $userid, $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                array_push($outputs, $row);
                echo json_encode($outputs);
            }

        }
    }

?>