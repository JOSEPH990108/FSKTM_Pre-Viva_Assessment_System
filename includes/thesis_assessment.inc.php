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
                //5mb
                if($fileSize <= 5000000){

                    $sql1 = "SELECT sup.user_id AS supervisor,
                                CASE 
                                    WHEN e1.examiner_id IS NOT NULL THEN e1.user_id ELSE NULL 
                                END AS examiner1,
                                CASE 
                                    WHEN e2.examiner_id IS NOT NULL THEN e2.user_id ELSE NULL 
                                END AS examiner2
                            FROM 
                                tbl_application a
                            INNER JOIN 
                                tbl_student stu ON a.student_id = stu.student_id
                            INNER JOIN 
                                tbl_supervisor sup ON a.student_id = sup.student_id
                            LEFT JOIN 
                                (SELECT * FROM tbl_examiner WHERE examiner_id = 1) e1 ON a.application_id = e1.application_id
                            LEFT JOIN 
                                (SELECT * FROM tbl_examiner WHERE examiner_id = 2) e2 ON a.application_id = e2.application_id
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
                            //Naming the file uploaded by the assesor
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
                    $_SESSION['file-size-error'] = "The file size is too big! Only 5 MB and below. Please try again.";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
            }
            else{
                $_SESSION['upload-file-error'] = "There was an error while uploading your file! Please try again.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            
            $sql2 = "INSERT INTO tbl_thesis_result (application_id, user_id, abstract_mark, introduction_mark, literature_review_mark, research_methodology_mark, result_discussion_mark, conclusion_recommendation_mark, reference_mark, writing_format_mark) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt =  mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql2)){
                //Redirect to apply pre viva application page
                $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssssssssss", $application_id, $userid, $abstract, $introduction, $literature_review, $research_methodology, $result_discussion, $conclusion_recommendation, $reference, $writing_format);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $sql3 = "INSERT INTO tbl_thesis_comment (application_id, user_id, abstract, introduction, literature_review, research_methodology, result_discussion, conclusion_recommendation, reference, writing_format, commented_version) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt =  mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql3)){
                    //Redirect to apply pre viva application page
                    $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                    header("Location: " . ROOT . "pre_viva_application.php");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "sssssssssss", $application_id, $userid, $abstract_comment, $introduction_comment, $literature_review_comment, $research_methodology_comment, $result_discussion_comment, $conclusion_recommendation_comment, $reference_comment, $writing_format_comment, $commented_thesis_file_name);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    move_uploaded_file($fileTempName, $commented_thesis_file_destination);
                }
            }
        }

        //Update application status if all 2 or 3 assesors done assessment
        $sql4 ="SELECT sup.user_id AS supervisor,
                    CASE 
                        WHEN e1.examiner_id IS NOT NULL THEN e1.user_id ELSE NULL 
                    END AS examiner1,
                    CASE 
                        WHEN e2.examiner_id IS NOT NULL THEN e2.user_id ELSE NULL 
                    END AS examiner2
                FROM 
                    tbl_application a
                INNER JOIN 
                    tbl_student stu ON a.student_id = stu.student_id
                INNER JOIN 
                    tbl_supervisor sup ON a.student_id = sup.student_id
                LEFT JOIN 
                    (SELECT * FROM tbl_examiner WHERE examiner_id = 1) e1 ON a.application_id = e1.application_id
                LEFT JOIN 
                    (SELECT * FROM tbl_examiner WHERE examiner_id = 2) e2 ON a.application_id = e2.application_id
                WHERE a.application_id = ?;";
        $stmt = mysqli_stmt_init($conn);
                                
        if(!mysqli_stmt_prepare($stmt, $sql4)){
            //Redirect to pre viva application page
            $_SESSION['error'] = "Something went wrong! Please contact developer.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $application_id);
            mysqli_stmt_execute($stmt);
            $result2 = mysqli_stmt_get_result($stmt);
            $row2 = mysqli_fetch_assoc($result2);
            $supervisor = $row2['supervisor'];
            $examiner1 = $row2['examiner1'];
            $examiner2 = $row2['examiner2'];
            mysqli_stmt_close($stmt);

            if($supervisor != NULL && $examiner1 != NULL && $examiner2 != NULL)
                $number_of_marker = 3;
            else if($supervisor != NULL && $examiner1 != NULL && $examiner2 == NULL)
                $number_of_marker = 2;
        }

        $sql5 = "SELECT tr.* FROM tbl_thesis_result tr
                 WHERE tr.application_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql5)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer.";
            header("Location: " . ROOT . "apply_pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt, "s", $application_id);
            mysqli_stmt_execute($stmt);
            $result3 = mysqli_stmt_get_result($stmt);
            $rowcount = mysqli_num_rows($result3);

            if($number_of_marker == $rowcount){
                $i = -1;
                while($row3 = mysqli_fetch_assoc($result3)){
                    $user_id = $row3['user_id'];
                    if($user_id == $supervisor){
                        $supervisor_mark = 0;
                        $i++;
                        $supervisor_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                        $supervisor_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                        $supervisor_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                        $supervisor_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                        $supervisor_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                        $supervisor_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                        $supervisor_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                        $supervisor_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                        
                    }
                    else if($user_id == $examiner1){
                        $examiner1_mark = 0;
                        $i++;
                        $examiner1_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                        $examiner1_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                        $examiner1_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                        $examiner1_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                        $examiner1_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                        $examiner1_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                        $examiner1_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                        $examiner1_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                    
                    }
                    else if($user_id == $examiner2){
                        $examiner2_mark = 0;
                        $i++;
                        $examiner2_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                        $examiner2_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                        $examiner2_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                        $examiner2_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                        $examiner2_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                        $examiner2_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                        $examiner2_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                        $examiner2_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                        
                    }
                }
                mysqli_stmt_close($stmt);
                if($rowcount == 3){
                    $examiner_average_mark = ($examiner1_mark + $examiner2_mark)/2;
                    $sql6 = "UPDATE tbl_application SET application_status = ?, application_result = ?
                             WHERE application_id = ?;";
                    $sql7 = "UPDATE tbl_application SET application_status = ?
                    WHERE application_id = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if($supervisor_mark < 80 || $examiner_average_mark < 80){
                        $application_result = "0";
                        $application_status = "COMPLETED";
                        if(!mysqli_stmt_prepare($stmt, $sql6)){
                            //Redirect to pre viva application page
                            $_SESSION['error'] = "Something went wrong! Please contact developer.";
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "sss", $application_status, $application_result, $application_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                    else{
                        $application_status = "PRESENTATION";
                        if(!mysqli_stmt_prepare($stmt, $sql7)){
                            //Redirect to pre viva application page
                            $_SESSION['error'] = "Something went wrong! Please contact developer.";
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "ss", $application_status, $application_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
                else{
                    $examiner_average_mark = $examiner1_mark;
                    $sql6 = "UPDATE tbl_application SET application_status = ?, application_result = ?
                             WHERE application_id = ?;";
                    $sql7 = "UPDATE tbl_application SET application_status = ?
                             WHERE application_id = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if($supervisor_mark < 80 || $examiner_average_mark < 80){
                        $application_result = "0";
                        $application_status = "COMPLETED";
                        if(!mysqli_stmt_prepare($stmt, $sql6)){
                            //Redirect to pre viva application page
                            $_SESSION['error'] = "Something went wrong! Please contact developer.";
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "sss", $application_status, $application_result, $application_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                    else{
                        $application_status = "PRESENTATION";
                        if(!mysqli_stmt_prepare($stmt, $sql7)){
                            //Redirect to pre viva application page
                            $_SESSION['error'] = "Something went wrong! Please contact developer.";
                            header("Location: " . ROOT . "pre_viva_application.php");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "ss", $application_status, $application_id);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }
        }
        $_SESSION['insert-assessment-success'] = "Thesis assessment data insert successfully";
        header("Location: " . ROOT . "pre_viva_application.php");
    }
?>