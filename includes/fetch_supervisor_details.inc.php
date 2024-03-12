<?php

    include_once "dbh.inc.php";

    $outputs = [];
    if(isset($_POST['application_id'])){
        $application_id = $_POST['application_id'];
        $sql = "SELECT u.user_id, u.name, s.designation, s.field FROM ((((tbl_supervisor sup
                INNER JOIN tbl_user u ON u.user_id = sup.user_id)
                INNER JOIN tbl_staff s ON s.user_id = sup.user_id)
                INNER JOIN tbl_student stu ON stu.student_id = sup.student_id)
                INNER JOIN tbl_application a ON a.student_id = sup.student_id)
                WHERE a.application_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $application_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $supervisor_userid = $row['user_id'];
                array_push($outputs, $row);
                mysqli_stmt_close($stmt);
                
                $sql1 = "SELECT tc.*, tr.* FROM ((tbl_application a
                         INNER JOIN tbl_thesis_comment tc ON a.application_id = tc.application_id)
                         INNER JOIN tbl_thesis_result tr ON a.application_id = tr.application_id)
                         WHERE a.application_id = ? AND (tc.user_id = ? AND tr.user_id = ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                } 
                else{
                    mysqli_stmt_bind_param($stmt,  "sss", $application_id, $supervisor_userid, $supervisor_userid);
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    if(!$row1 = mysqli_fetch_assoc($result1)){
                        echo json_encode($outputs);
                        exit();
                    }
                    else{
                        array_push($outputs, $row1);
                        echo json_encode($outputs);
                        exit();
                    }
                }
            }
        }
    }

?>