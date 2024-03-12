<?php

    include_once "dbh.inc.php";

    if(isset($_POST['matric_no'])){
        $matric_no = $_POST['matric_no'];

        $sql = "SELECT user.name, student.level_of_study, student.programme, student.research_title FROM (tbl_user user
                INNER JOIN tbl_student student ON user.user_id = student.user_id)
                WHERE student.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $matric_no);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }

    if(isset($_POST['supervisor_id'])){
        $supervisor_id = $_POST['supervisor_id'];

        $sql = "SELECT user.name, staff.designation, staff.field_category, staff.field FROM (tbl_user user
                INNER JOIN tbl_staff staff ON user.user_id = staff.user_id)
                WHERE staff.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $supervisor_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }

    if(isset($_POST['examiner1_id'])){
        $examiner1_id = $_POST['examiner1_id'];

        $sql = "SELECT user.name, staff.designation, staff.field_category, staff.field FROM (tbl_user user
                INNER JOIN tbl_staff staff ON user.user_id = staff.user_id)
                WHERE staff.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $examiner1_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }

    if(isset($_POST['examiner2_id'])){
        $examiner2_id = $_POST['examiner2_id'];

        $sql = "SELECT user.name, staff.designation, staff.field_category, staff.field FROM (tbl_user user
                INNER JOIN tbl_staff staff ON user.user_id = staff.user_id)
                WHERE staff.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $examiner2_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }

    if(isset($_POST['staff_user_id'])){
        $staff_user_id = $_POST['staff_user_id'];

        $sql = "SELECT user.*, staff.* FROM (tbl_user user
                INNER JOIN tbl_staff staff ON user.user_id = staff.user_id)
                WHERE staff.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $staff_user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }

    if(isset($_POST['student_user_id'])){
        $student_user_id = $_POST['student_user_id'];

        $sql = "SELECT user.*, student.*, supervisor.user_id AS supervisor FROM ((tbl_student student
                INNER JOIN tbl_user user ON student.user_id = user.user_id)
                INNER JOIN tbl_supervisor supervisor ON student.student_id = supervisor.student_id)
                WHERE user.user_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt,  "s", $student_user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                echo json_encode($row); 
            }
        }
    }
?>