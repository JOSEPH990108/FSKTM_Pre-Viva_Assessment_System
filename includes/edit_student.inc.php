<?php
    include_once 'dbh.inc.php';


    if(isset($_POST['edit_submitbtn'])){

        $user_id = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_userid']));
        $name = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_name']));
        $email = strtolower(mysqli_real_escape_string($conn, $_POST['edit_email']));
        $phone = mysqli_real_escape_string($conn, $_POST['edit_phone']);
        $ic = mysqli_real_escape_string($conn, $_POST['edit_ic']);
        $passport = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_passport']));
        $sex = mysqli_real_escape_string($conn, $_POST['edit_sex']);
        $race = mysqli_real_escape_string($conn, $_POST['edit_race']);
        $religion = mysqli_real_escape_string($conn, $_POST['edit_religion']);
        $country = mysqli_real_escape_string($conn, $_POST['edit_country']);
        $nationality = mysqli_real_escape_string($conn, $_POST['edit_nationality']);
        $status = mysqli_real_escape_string($conn, $_POST['edit_status']);
        $faculty = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_faculty']));
        $levelofstudy = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_levelofstudy']));
        $programme = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_programme']));
        $research_title = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_research_title']));
        $supervisor = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_supervisor']));

        $errors = array();

         // If the form is error free, then register the user 
        if (count($errors) == 0) {
            $sql = "UPDATE tbl_user SET name = ?, email = ?, phone_no = ?, ic = ?, passport = ?, sex = ?, race = ?, religion = ?, country = ?, nationality = ?, register_status = ?
                    WHERE user_id = ?;";

            $sql1 = "UPDATE tbl_student SET faculty = ?, level_of_study = ?, programme = ?, research_title = ?
                     WHERE user_id = ?;";

            $sql2 = "SELECT student_id FROM tbl_student WHERE user_id = ?;";
            
            $sql3 = "UPDATE tbl_supervisor SET user_id = ? WHERE student_id = ?;";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_student.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "ssssssssssss", $name, $email, $phone, $ic, $passport, $sex, $race, $religion, $country, $nationality, $status, $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                    header("Location: " . ROOT . "manage_student.php");
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sssss", $faculty, $levelofstudy, $programme, $research_title, $user_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql2)){
                        $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                        header("Location: " . ROOT . "manage_student.php");
                    }
                    else{
                        //Select student_id from tbl_student
                        mysqli_stmt_bind_param($stmt, "s", $user_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt); 
                        if($row = mysqli_fetch_assoc($result)){
                            $student_id = $row['student_id'];
                        }
                        mysqli_stmt_close($stmt);

                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql3)){
                            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                            header("Location: " . ROOT . "manage_student.php");
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "ss", $supervisor, $student_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                
                }
                $_SESSION['update-success'] = "Student data update successfully";
                header("Location: " . ROOT . "manage_student.php");
            }
        }
        else{
            $_SESSION['update-unsuccess'] = "Student data update unsuccessfully";
            header("Location: " . ROOT . "manage_student.php");
        }
    }

?>