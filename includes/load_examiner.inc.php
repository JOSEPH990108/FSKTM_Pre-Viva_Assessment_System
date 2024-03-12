<?php

    include_once('includes/dbh.inc.php');
    if(isset($_POST['application_id'])){
        $application_id = $_POST['application_id'];
        $sql = "SELECT * FROM tbl_student 
                INNER JOIN tbl_application ON tbl_student.student_id = tbl_application.student_id
                WHERE tbl_application.application_id = '$application_id';";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Redirect to login page
            header("Location: " . ROOT);
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $level_of_study = $row['level_of_study'];
            mysqli_stmt_close($stmt);

            if($level_of_study == 'DOCTOR OF PHILOSOPHY'){
                $sql1 = "SELECT tbl_user.name, tbl_user.user_id, tbl_staff.designation FROM tbl_user
                         INNER JOIN tbl_staff ON tbl_user.user_id = tbl_staff.user_id
                         WHERE tbl_staff.designation != 'DS51 - PENSYARAH KANAN' AND tbl_staff.designation != 'DS52 - PENSYARAH KANAN'
                         ORDER BY tbl_staff.designation;";
                $stmt =  mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    //Redirect to login page
                    header("Location: " . ROOT);
                    exit();
                }
                else{
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    while($row1 = mysqli_fetch_assoc($result1)){
                        $output[] = array(
                            'id'  => $row1["user_id"],
                            'name'  => $row1["name"]
                           ); 
                    }
                    echo json_encode($output);
                }
            }
            else{
                $sql1 = "SELECT tbl_user.name, tbl_user.user_id, tbl_staff.designation FROM tbl_user
                         INNER JOIN tbl_staff ON tbl_user.user_id = tbl_staff.user_id
                         ORDER BY tbl_staff.designation;";
                 $stmt =  mysqli_stmt_init($conn);

                 if(!mysqli_stmt_prepare($stmt, $sql1)){
                     //Redirect to login page
                     header("Location: " . ROOT);
                     exit();
                 }
                 else{
                     mysqli_stmt_execute($stmt);
                     $result1 = mysqli_stmt_get_result($stmt);
                     while($row1 = mysqli_fetch_assoc($result1)){
                         $output[] = array(
                             'id'  => $row1["user_id"],
                             'name'  => $row1["name"]
                            ); 
                     }
                     echo json_encode($output);
                 }
            }  
        }
    }

?>