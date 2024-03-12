<?php

    include_once "dbh.inc.php";

    if(isset($_POST['userid'])){
        $userid = $_POST['userid'];
        $research_title = strtoupper(mysqli_real_escape_string($conn, $_POST['research_title']));

        $sql = "UPDATE tbl_student SET research_title = ?
                WHERE user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $result = FALSE;
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "ss", $research_title, $userid);
            mysqli_stmt_execute($stmt);
            $result = TRUE;

        }
        echo json_encode($result);
    }

?>