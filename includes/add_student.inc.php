<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['submitbtn'])){

        $user_id = strtoupper(mysqli_real_escape_string($conn, $_POST['userid']));
        $name = strtoupper(mysqli_real_escape_string($conn, $_POST['name']));
        $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $ic = mysqli_real_escape_string($conn, $_POST['ic']);
        $passport = strtoupper(mysqli_real_escape_string($conn, $_POST['passport']));
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $race = mysqli_real_escape_string($conn, $_POST['race']);
        $religion = mysqli_real_escape_string($conn, $_POST['religion']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $faculty = strtoupper(mysqli_real_escape_string($conn, $_POST['faculty']));
        $levelofstudy = strtoupper(mysqli_real_escape_string($conn, $_POST['levelofstudy']));
        $programme = strtoupper(mysqli_real_escape_string($conn, $_POST['programme']));
        $research_title = strtoupper(mysqli_real_escape_string($conn, $_POST['research_title']));
        $supervisor = strtoupper(mysqli_real_escape_string($conn, $_POST['supervisor']));

        $errors = array();

         // If the form is error free, then register the user 
        if (count($errors) == 0) {
            $sql = "INSERT INTO tbl_user (user_id, name, email, phone_no, ic, passport, sex, race, religion, country, nationality, register_status, password, user_type)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $sql1 = "INSERT INTO tbl_student (user_id, faculty, level_of_study, programme, research_title)
                    VALUES (?, ?, ?, ?, ?);";

            $sql2 = "SELECT student_id FROM tbl_student WHERE user_id = ?;";
            
            $sql3 = "INSERT INTO tbl_supervisor (user_id, student_id)
                     VALUES (?, ?);";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_student.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "ssssssssssssss", $user_id, $name, $email, $phone, $ic, $passport, $sex, $race, $religion, $country, $nationality, 
                $status, $hashed_password, $user_type);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                    header("Location: " . ROOT . "manage_student.php");
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sssss", $user_id, $faculty, $levelofstudy, $programme, $research_title);
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
                $current_dir = dirname(__FILE__,2);
                $student_dir = mkdir($current_dir . "/STUDENT/" . $user_id);
                $_SESSION['insert-success'] = "Student data insert successfully";
                header("Location: " . ROOT . "manage_student.php");
            }
        }
        else{
            $_SESSION['insert-unsuccess'] = "Student data insert unsuccessfully";
            header("Location: " . ROOT . "manage_student.php");
        }
    }

?>
