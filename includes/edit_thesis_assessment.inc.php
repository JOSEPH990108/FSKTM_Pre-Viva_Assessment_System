<?php

    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];
    
    if(isset($_POST['thesis_assessmentbtn'])){
        $application_id = $_POST['assessment_application_id'];
        $matric_no = $_POST['student_matric_no'];
        $abstract = $_POST['abstract'];
        $abstract_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['abstract_comment']));
        $abstract_comment = str_replace('\R\N', "\r\n", $abstract_comment);
        $introduction = $_POST['introduction'];
        $introduction_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['introduction_comment']));
        $introduction_comment = str_replace('\R\N', "\r\n", $introduction_comment);
        $literature_review = $_POST['literature_review'];
        $literature_review_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['literature_review_comment']));
        $literature_review_comment = str_replace('\R\N', "\r\n", $literature_review_comment);
        $research_methodology = $_POST['research_methodology'];
        $research_methodology_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['research_methodology_comment']));
        $research_methodology_comment = str_replace('\R\N', "\r\n", $research_methodology_comment);
        $result_discussion = $_POST['result_discussion'];
        $result_discussion_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['result_discussion_comment']));
        $result_discussion_comment = str_replace('\R\N', "\r\n", $result_discussion_comment);
        $conclusion_recommendation = $_POST['conclusion_recommendation'];
        $conclusion_recommendation_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['conclusion_recommendation_comment']));
        $conclusion_recommendation_comment = str_replace('\R\N', "\r\n", $conclusion_recommendation_comment);
        $reference = $_POST['reference'];
        $reference_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['reference_comment']));
        $reference_comment = str_replace('\R\N', "\r\n", $reference_comment);
        $writing_format = $_POST['writing_format'];
        $writing_format_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['writing_format_comment']));
        $writing_format_comment = str_replace('\R\N', "\r\n", $writing_format_comment);

        if($_FILES['thesis_amendment']['size'] != NULL && $_FILES['thesis_amendment']['error'] == 0){
            $file = $_FILES['thesis_amendment'];
            $fileName = $_FILES['thesis_amendment']['name'];
            $fileTempName = $_FILES['thesis_amendment']['tmp_name'];
            $fileSize = $_FILES['thesis_amendment']['size'];
            $fileError = $_FILES['thesis_amendment']['error'];

            $ext = explode('.', $fileName);
            $fileActualExt = strtolower(end($ext));

            $errors = array();

            //Search thesis file directory location
            $sql = "SELECT thesis_file FROM tbl_application WHERE application_id = ?;";
            $stmt =  mysqli_stmt_init($conn);

            //Check connection and sql statement without any error
            if(!mysqli_stmt_prepare($stmt, $sql)){
                //Redirect to apply pre viva application page
                $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt,  "s", $application_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $thesis_file_name = $row['thesis_file'];
                    mysqli_stmt_close($stmt);
                }
                else{
                    $_SESSION['no-thesis-found'] = "No thesis records found!";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
                $current_dir = dirname(__FILE__, 2);
                $current_application_dir = substr($thesis_file_name, 0, -24);
                $directory_location = $current_dir . '/' . $current_application_dir;
            
                //Check files
                if($fileError === 0){
                    //30mb
                    if($fileSize <= 30000000){

                        $sql1 = "SELECT sup.user_id AS supervisor, exam.examiner1, exam.examiner2 FROM ((tbl_application a
                                 INNER JOIN tbl_supervisor sup ON a.student_id = sup.student_id)
                                 INNER JOIN tbl_examiner exam ON a.application_id = exam.application_id)
                                 WHERE a.application_id = ?;";
                        $stmt =  mysqli_stmt_init($conn);

                        //Check connection and sql statement without any error
                        if(!mysqli_stmt_prepare($stmt, $sql1)){
                            //Redirect to apply pre viva application page
                            $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt,  "s", $application_id);
                            mysqli_stmt_execute($stmt);
                            $result1 = mysqli_stmt_get_result($stmt);
                            if($row1 = mysqli_fetch_assoc($result1)){
                                $supervisor = $row1['supervisor'];
                                $examiner1 = $row1['examiner1'];
                                $examiner2 = $row1['examiner2'];
                                mysqli_stmt_close($stmt);
                                if($supervisor == $userid){
                                    $commented_thesis_file = "SUPERVISOR_COMMENTED_THESIS_FILE" . '.' . $fileActualExt;
                                }
                                else if($examiner1 == $userid){
                                    $commented_thesis_file = "EXAMINER1_COMMENTED_THESIS_FILE" . '.' . $fileActualExt;
                                }
                                else if($examiner2 == $userid){
                                    $commented_thesis_file = "EXAMINER2_COMMENTED_THESIS_FILE" . '.' . $fileActualExt;
                                }
                                else{
                                    $_SESSION['error'] = "Something went wrong! Please contact the developer.";
                                    header("Location: " . ROOT . "pre_viva_application.php");
                                    exit();
                                }
                                $commented_thesis_file_destination = $directory_location . $commented_thesis_file;
                                $commented_thesis_file_name = $current_application_dir . $commented_thesis_file;
                            }
                            else{
                                $_SESSION['no-user-found'] = "No user records found!";
                                header("Location: " . ROOT . "pre_viva_application.php");
                                exit();
                            }
                        }
                    }
                    else{
                        $_SESSION['file-size-error'] = "The file size is too big! Only 30 MB and below. Please try again.";
                        header("Location: " . ROOT . "pre_viva_application.php");
                        exit();
                    }
                }
                else{
                    $_SESSION['upload-file-error'] = "There was an error while uploading your file! Please try again.";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
            }
            
            $sql2 = "UPDATE tbl_thesis_result SET abstract_mark = ?, introduction_mark = ?, literature_review_mark = ?, research_methodology_mark = ?, result_discussion_mark = ?, conclusion_recommendation_mark = ?, reference_mark = ?, writing_format_mark = ?
                     WHERE application_id = ? AND user_id = ?;";
            $stmt =  mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql2)){
                //Redirect to apply pre viva application page
                $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssssssssss", $abstract, $introduction, $literature_review, $research_methodology, $result_discussion, $conclusion_recommendation, $reference, $writing_format, $application_id, $userid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $sql3 = "UPDATE tbl_thesis_comment SET abstract = ?, introduction = ?, literature_review = ?, research_methodology = ?, result_discussion = ?, conclusion_recommendation = ?, reference = ?, writing_format = ?, commented_version = ?
                         WHERE application_id = ? AND user_id = ?;";
                $stmt =  mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql3)){
                    //Redirect to apply pre viva application page
                    $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sssssssssss", $abstract_comment, $introduction_comment, $literature_review_comment, $research_methodology_comment, $result_discussion_comment, $conclusion_recommendation_comment, $reference_comment, $writing_format_comment, $commented_thesis_file_name, $application_id, $userid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    move_uploaded_file($fileTempName, $commented_thesis_file_destination);
                    $_SESSION['update-assessment-success'] = "Thesis assessment data update successfully";
                    header("Location: " . ROOT . "pre_viva_application.php");
                }
            }
        }
        else{
            $sql = "UPDATE tbl_thesis_result SET abstract_mark = ?, introduction_mark = ?, literature_review_mark = ?, research_methodology_mark = ?, result_discussion_mark = ?, conclusion_recommendation_mark = ?, reference_mark = ?, writing_format_mark = ?
                     WHERE application_id = ? AND user_id = ?;";
            $stmt =  mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                //Redirect to apply pre viva application page
                $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssssssssss", $abstract, $introduction, $literature_review, $research_methodology, $result_discussion, $conclusion_recommendation, $reference, $writing_format, $application_id, $userid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $sql1 = "UPDATE tbl_thesis_comment SET abstract = ?, introduction = ?, literature_review = ?, research_methodology = ?, result_discussion = ?, conclusion_recommendation = ?, reference = ?, writing_format = ?
                         WHERE application_id = ? AND user_id = ?;";
                $stmt =  mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    //Redirect to apply pre viva application page
                    $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $abstract_comment, $introduction_comment, $literature_review_comment, $research_methodology_comment, $result_discussion_comment, $conclusion_recommendation_comment, $reference_comment, $writing_format_comment, $application_id, $userid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $_SESSION['update-assessment-success'] = "Thesis assessment data update successfully";
                    header("Location: " . ROOT . "pre_viva_application.php");
                }
            }
        }
    }
?>