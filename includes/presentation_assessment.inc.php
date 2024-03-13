<?php

    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];
    
    if(isset($_POST['presentation_assessmentbtn'])){
        $application_id = $_POST['presentation_assessment_application_id'];
        $presentation = $_POST['presentation'];
        $presentation_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['presentation_comment']));
        $presentation_comment = str_replace('\R\N', "\r\n", $presentation_comment);
        $qna = $_POST['qna'];
        $qna_comment = strtoupper(mysqli_real_escape_string($conn, $_POST['qna_comment']));
        $qna_comment = str_replace('\R\N', "\r\n", $qna_comment);

        $sql = "SELECT
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
                $examiner1 = $row['examiner1'];
                $examiner2 = $row['examiner2'];
                mysqli_stmt_close($stmt);
            }
            else{
                $_SESSION['no-user-found'] = "No user records found!";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }

            $sql2 = "INSERT INTO tbl_presentation_result (application_id, user_id, presentation_mark, QNA_mark)
                     VALUES (?, ?, ?, ?);";
            $stmt =  mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql2)){
                //Redirect to apply pre viva application page
                $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                header("Location: " . ROOT . "pre_viva_application.php");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssss", $application_id, $userid, $presentation, $qna);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $sql3 = "INSERT INTO tbl_presentation_comment(application_id, user_id, presentation, QNA)
                         VALUES (?, ?, ?, ?);";
                $stmt =  mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql3)){
                     //Redirect to apply pre viva application page
                     $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                     header("Location: " . ROOT . "pre_viva_application.php");
                     exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ssss", $application_id, $userid, $presentation_comment, $qna_comment);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            }
        }

        if($examiner1 != NULL && $examiner2 != NULL)
            $number_of_presentation_marker = 2;
        else if($examiner1 != NULL && $examiner2 == NULL)
            $number_of_presentation_marker = 1;

        $sql4 = "SELECT tpr.* FROM tbl_presentation_result tpr
                 WHERE tpr.application_id = ?;";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql4)){
            //Redirect to apply pre viva application page
            $_SESSION['error'] = "Something went wrong! Please contact system developer.";
            header("Location: " . ROOT . "pre_viva_application.php");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $application_id);
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
            $presentation_result_rowcount = mysqli_num_rows($result1);

            if($number_of_presentation_marker == $presentation_result_rowcount){
                $i = -1;
                while($row1 = mysqli_fetch_assoc($result1)){
                    $user_id = $row1['user_id'];
                    if($user_id == $examiner1){
                        $examiner1_presentation_mark = 0;
                        $i++;
                        $examiner1_presentation_mark += $presentation_mark[$i]['presentation_mark'] = $row1['presentation_mark'];
                        $examiner1_presentation_mark += $QNA_mark[$i]['QNA_mark'] = $row1['QNA_mark'];
                    }
                    else if($user_id == $examiner2){
                        $examiner2_presentation_mark = 0;
                        $i++;
                        $examiner2_presentation_mark += $presentation_mark[$i]['presentation_mark'] = $row1['presentation_mark'];
                        $examiner2_presentation_mark += $QNA_mark[$i]['QNA_mark'] = $row1['QNA_mark'];
                    }
                }
                mysqli_stmt_close($stmt);
                $pre_viva_total_mark = 0;
                $thesis_total_mark = 0;
                $presentation_total_mark = 0;
                //Get thesis assessment result details
                $sql5 ="SELECT sup.user_id AS supervisor,
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
                                        
                if(!mysqli_stmt_prepare($stmt, $sql5)){
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
                        $number_of_thesis_marker = 3;
                    else if($supervisor != NULL && $examiner1 != NULL && $examiner2 == NULL)
                        $number_of_thesis_marker = 2;
                }

                $sql6 = "SELECT tr.* FROM tbl_thesis_result tr
                            WHERE tr.application_id = ?;";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql6)){
                    $_SESSION['error'] = "Something went wrong! Please contact system developer.";
                    header("Location: " . ROOT . "apply_pre_viva_application.php");
                } 
                else{
                    mysqli_stmt_bind_param($stmt, "s", $application_id);
                    mysqli_stmt_execute($stmt);
                    $result3 = mysqli_stmt_get_result($stmt);
                    $thesis_result_rowcount = mysqli_num_rows($result3);

                    if($number_of_thesis_marker == $thesis_result_rowcount){
                        $i = -1;
                        while($row3 = mysqli_fetch_assoc($result3)){
                            $user_id = $row3['user_id'];
                            if($user_id == $supervisor){
                                $supervisor_thesis_mark = 0;
                                $i++;
                                $supervisor_thesis_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                                $supervisor_thesis_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                                $supervisor_thesis_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                                $supervisor_thesis_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                                $supervisor_thesis_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                                $supervisor_thesis_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                                $supervisor_thesis_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                                $supervisor_thesis_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                                
                            }
                            else if($user_id == $examiner1){
                                $examiner1_thesis_mark = 0;
                                $i++;
                                $examiner1_thesis_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                                $examiner1_thesis_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                                $examiner1_thesis_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                                $examiner1_thesis_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                                $examiner1_thesis_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                                $examiner1_thesis_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                                $examiner1_thesis_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                                $examiner1_thesis_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                            
                            }
                            else if($user_id == $examiner2){
                                $examiner2_thesis_mark = 0;
                                $i++;
                                $examiner2_thesis_mark += $abstract_mark[$i]['abstract_mark'] = $row3['abstract_mark'];
                                $examiner2_thesis_mark += $introduction_mark[$i]['introduction_mark'] = $row3['introduction_mark'];
                                $examiner2_thesis_mark += $literature_mark[$i]['literature_review_mark'] = $row3['literature_review_mark'];
                                $examiner2_thesis_mark += $research_methodology_mark[$i]['research_methodology_mark'] = $row3['research_methodology_mark'];
                                $examiner2_thesis_mark += $result_discussion_mark[$i]['result_discussion_mark'] = $row3['result_discussion_mark'];
                                $examiner2_thesis_mark += $conclusion_recommended_mark[$i]['conclusion_recommendation_mark'] = $row3['conclusion_recommendation_mark'];
                                $examiner2_thesis_mark += $reference_mark[$i]['reference_mark'] = $row3['reference_mark'];
                                $examiner2_thesis_mark += $writing_format_mark[$i]['writing_format_mark'] = $row3['writing_format_mark'];
                                
                            }
                        }
                        mysqli_stmt_close($stmt);

                        if($thesis_result_rowcount == 3 && $presentation_result_rowcount == 2){
                            $examiner_average_thesis_mark = ($examiner1_thesis_mark + $examiner2_thesis_mark)/2;
                            $examiner_average_presentation_mark = ($examiner1_presentation_mark + $examiner2_presentation_mark)/2;
                            $thesis_total_mark = 0.6 * $supervisor_thesis_mark + 0.2 * $examiner_average_thesis_mark;
                            $presentation_total_mark = 0.2 * $examiner_average_presentation_mark;
                            $pre_viva_total_mark = $thesis_total_mark + $presentation_total_mark;
                        }
                        else{
                            $examiner_average_thesis_mark = $examiner1_thesis_mark;
                            $examiner_average_presentation_mark = $examiner1_presentation_mark;
                            $thesis_total_mark = 0.6 * $supervisor_thesis_mark + 0.2 * $examiner_average_thesis_mark;
                            $presentation_total_mark = 0.2 * $examiner_average_presentation_mark;
                            $pre_viva_total_mark = $thesis_total_mark + $presentation_total_mark;
                        }

                        $sql7 = "UPDATE tbl_application SET application_status = ?, overall_mark = ?, application_result = ?
                                    WHERE application_id = ?;";
                        $stmt = mysqli_stmt_init($conn);

                        if($pre_viva_total_mark < 80){
                            $application_result = "0";
                            $application_status = "COMPLETED";
                            if(!mysqli_stmt_prepare($stmt, $sql7)){
                                $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                header("Location: " . ROOT . "pre_viva_application.php");
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "ssss", $application_status, $pre_viva_total_mark, $application_result, $application_id);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                        }
                        else{
                            $application_result = "1";
                            $application_status = "COMPLETED";
                            if(!mysqli_stmt_prepare($stmt, $sql7)){
                                $_SESSION['error'] = "Something went wrong! Please contact developer.";
                                header("Location: " . ROOT . "pre_viva_application.php");
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "ssss", $application_status, $pre_viva_total_mark, $application_result, $application_id);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                }
            }
        }

        $_SESSION['insert-assessment-success'] = "Presentation assessment data insert successfully";
        header("Location: " . ROOT . "pre_viva_application.php");
    }

?>