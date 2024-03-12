<?php

    include_once('dbh.inc.php');
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    if(isset($_POST['applybtn'])){
        //Get Files information
        $file = $_FILES['thesis'];
        $file1 = $_FILES['plagiarism'];
        $file2 = $_FILES['proofread'];

        $fileName = $_FILES['thesis']['name'];
        $file1Name = $_FILES['plagiarism']['name'];
        $file2Name = $_FILES['proofread']['name'];

        $fileTempName = $_FILES['thesis']['tmp_name'];
        $file1TempName = $_FILES['plagiarism']['tmp_name'];
        $file2TempName = $_FILES['proofread']['tmp_name'];

        $fileSize = $_FILES['thesis']['size'];
        $file1Size = $_FILES['plagiarism']['size'];
        $file2Size = $_FILES['proofread']['size'];

        $fileError = $_FILES['thesis']['error'];
        $file1Error = $_FILES['plagiarism']['error'];
        $file2Error = $_FILES['proofread']['error'];
        
        $ext = explode('.', $fileName);
        $fileActualExt = strtolower(end($ext));

        //Get student id
        $sql = "SELECT tbl_student.student_id FROM tbl_student
        INNER JOIN tbl_user ON tbl_student.user_id = tbl_user.user_id
        WHERE tbl_student.user_id = ?;";

        $stmt =  mysqli_stmt_init($conn);

        //Check connection and sql statement without any error
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Redirect to apply pre viva application page
            $_SESSION['apply-error'] = "Something went wrong! Please contact system developer.";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
            exit();
        }
        else{

            mysqli_stmt_bind_param($stmt, "s", $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            //Check whether data inside the database
            if($row = mysqli_fetch_assoc($result)){
                //Get student id
                $student_id = $row['student_id'];
            }
            else{
                $_SESSION['no-user-found'] = "Something went wrong! No student ID found. Please contact system developer.";
                header("Location: " . ROOT . "apply_pre_viva_application.php");
                exit();
            }
            mysqli_stmt_close($stmt);

            $sql1 = "SELECT * FROM tbl_application WHERE student_id = ?;";
            $stmt =  mysqli_stmt_init($conn);
            //Check connection and sql statement without any error
            if(!mysqli_stmt_prepare($stmt, $sql1)){
                //Redirect to apply pre viva application page
                $_SESSION['apply-error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "apply_pre_viva_application.php");
                exit();
            }
            else{
                //Check whether student 1st time apply or more than 1 time
                $num = 1;
                mysqli_stmt_bind_param($stmt, "s", $student_id);
                mysqli_stmt_execute($stmt);
                $result1 = mysqli_stmt_get_result($stmt);
                
                //Check whether data inside the database
                while($row1 = mysqli_fetch_assoc($result1)){
                    //increment $num
                $num++;
                }

                mysqli_stmt_close($stmt);
                //Check whether directory exist
                $current_dir = dirname(__FILE__,2);
                $student_dir = $current_dir . "/STUDENT/" . $userid;
                
                //Check files
                if($fileError === 0 && $file1Error === 0 && $file2Error === 0){
                    $total_file_size = $fileSize + $file1Size + $file2Size;
                    if($total_file_size > 5000000){
                        $_SESSION['max-upload-file-size'] = "The maximum upload file size only less than 5MB. Please try again.";
                        header("Location: " . ROOT . "apply_pre_viva_application.php");
                        exit();
                    }
                    else{

                        //20mb
                        if($fileSize <= 5000000){
                            $thesis_file = $userid . "_THESIS_FILE" . '.' . $fileActualExt;
                            $fileDestination = $student_dir . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $thesis_file;
                            $filename1 = 'STUDENT/' . $userid . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $thesis_file;
                        }
                        else{
                            $_SESSION['file-size-error'] = "The thesis file size is too big! Only 20 MB and below. Please try again.";
                            header("Location: " . ROOT . "apply_pre_viva_application.php");
                            exit();
                        }

                        if($file1Size <= 5000000){
                            $plagiarism_report = $userid . "_PLAGIARISM_REPORT" . '.' . $fileActualExt;
                            $file1Destination = $student_dir . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $plagiarism_report;
                            $filename2 = 'STUDENT/' . $userid . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $plagiarism_report;
                        }
                        else{
                            $_SESSION['file-size-error'] = "The plagiarism file size is too big! Only 20 MB and below. Please try again.";
                            header("Location: " . ROOT . "apply_pre_viva_application.php");
                            exit();
                        }

                        if($file2Size <= 5000000){
                            $proofread_receipt = $userid . "_PROOFREAD_RECEIPT" . '.' . $fileActualExt;
                            $file2Destination = $student_dir . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $proofread_receipt;
                            $filename3 = 'STUDENT/' . $userid . "/" . $num . "_APPLICATION" . "/THESIS" . "/" . $proofread_receipt;
                        }
                        else{
                            $_SESSION['file-size-error'] = "The proofread receipt file size is too big! Only 20 MB and below. Please try again.";
                            header("Location: " . ROOT . "apply_pre_viva_application.php");
                            exit();
                        }

                        if(!file_exists($student_dir . "/" . $num . "_APPLICATION")){

                            //create application directory
                            $application_dir = mkdir($student_dir . "/" . $num . "_APPLICATION");
                            if(!$application_dir){
                                //Redirect to apply pre viva application page
                                $_SESSION['create-folder-error'] = "Failed to create folder! Please contact system developer.";
                                header("Location: " . ROOT . "apply_pre_viva_application.php");
                            }
                            else{
                                //create thesis and thesis correction directory inside application directory
                                $new_dir = $student_dir . "/" . $num . "_APPLICATION";
                                $thesis_dir = mkdir($new_dir . "/THESIS");
                                $thesis_correction_dir = mkdir($new_dir . "/THESIS_CORRECTION");
                            }
                        }
                        else{
                            $_SESSION['folder-exist'] = "Folder existed! Please contact system developer.";
                            header("Location: " . ROOT . "apply_pre_viva_application.php");
                            exit();
                        }
                    }
                    
                }
                else{
                    $_SESSION['upload-file-error'] = "There was an error while uploading your file! Please try again.";
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                    exit();
                }

                $sql2 = "INSERT INTO tbl_application (student_id, thesis_file, plagiarism, proofread, application_status) VALUES (?, ?, ?, ?, ?);";
                $stmt =  mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt, $sql2)){
                    //Redirect to apply pre viva application page
                    $_SESSION['apply-error'] = "Something went wrong! Please contact system developer.";
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                    exit();
                }
                else{
                    $application_status = "PENDING";
                    mysqli_stmt_bind_param($stmt,  "issss", $student_id, $filename1, $filename2, $filename3, $application_status);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    move_uploaded_file($fileTempName, $fileDestination);
                    move_uploaded_file($file1TempName, $file1Destination);
                    move_uploaded_file($file2TempName, $file2Destination);
                    $_SESSION['apply-success'] = "Pre-Viva apply successfully.";
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                }
            }
        }

    }

?>