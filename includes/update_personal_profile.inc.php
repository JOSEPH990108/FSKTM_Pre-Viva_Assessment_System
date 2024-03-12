<?php

    include_once "dbh.inc.php";

    if(isset($_POST['userid'])){
        $userid = $_POST['userid'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $ic = $_POST['ic'];
        $passport = strtoupper(mysqli_real_escape_string($conn, $_POST['passport']));

        $sql = "UPDATE tbl_user SET email = ?, phone_no = ?, ic = ?, passport = ?
                WHERE user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $result = FALSE;
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "sssss", $email, $phone, $ic, $passport, $userid);
            mysqli_stmt_execute($stmt);
            $result = TRUE;

        }
        echo json_encode($result);
    }

?>