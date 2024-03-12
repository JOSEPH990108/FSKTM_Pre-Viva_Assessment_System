<?php

include_once "dbh.inc.php";

if(isset($_POST['submitbtn'])){
    $application_id = $_POST['application_id'];
    $pre_viva_venue_platform = $_POST['pre_viva_venue_platform'];
    $pre_viva_venue = $_POST['pre_viva_venue'];
    $application_status = "APPROVED";

    $sql = "UPDATE tbl_application SET pre_viva_venue_platform = ?, pre_viva_venue = ?, application_status = ?
            WHERE application_id = ?;";
    
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $_SESSION['error'] = "Something went wrong! Please contact system developer!";
        header("Location: " . ROOT . "all_pre_viva_application.php");
    } 
    else{
        mysqli_stmt_bind_param($stmt,  "ssss", $pre_viva_venue_platform, $pre_viva_venue, $application_status, $application_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['update-success'] = "Application data update successfully.";
        header("Location: " . ROOT . "all_pre_viva_application.php");
    }
}

?>