<?php

    include_once "dbh.inc.php";
    $outputs = [];

    if(isset($_POST['application_id'])){
        $applicationid = $_POST['application_id'];
        $user_id = $_POST['user_id'];
        $sql = "SELECT * FROM tbl_application WHERE application_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $applicationid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                array_push($outputs, $row) ;
            }

            mysqli_stmt_close($stmt);
            $sql1 = "SELECT stu.*, u.name FROM (tbl_student stu
                     INNER JOIN tbl_user u ON stu.user_id = u.user_id)
                     WHERE u.user_id = ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql1)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "s", $user_id);
                mysqli_stmt_execute($stmt);
                $result1 = mysqli_stmt_get_result($stmt);
                if($row1 = mysqli_fetch_assoc($result1)){
                    array_push($outputs, $row1) ;
                }
            }
        }
        echo json_encode($outputs);
    }

?>