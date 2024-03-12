<?php

    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];
    $outputs = [];

    if(isset($_POST['application_id'])){
        $application_id = $_POST['application_id'];

        $sql = "SELECT * FROM (SELECT tpr.user_id, tpr.presentation_mark, tpr.QNA_mark, tpc.presentation, tpc.QNA 
                FROM tbl_presentation_result tpr
                INNER JOIN tbl_presentation_comment tpc ON tpr.user_id = tpc.user_id WHERE tpc.application_id = ? AND tpr.application_id = ?) t1
                RIGHT JOIN (SELECT tr.user_id, tr.abstract_mark, tr.introduction_mark, tr.literature_review_mark, tr.research_methodology_mark, tr.result_discussion_mark, 
                tr.conclusion_recommendation_mark, tr.reference_mark, tr.writing_format_mark, tc.abstract, tc.introduction, tc.literature_review, tc.research_methodology, 
                tc.result_discussion, tc.conclusion_recommendation, tc.reference, tc.writing_format,
                (SELECT IF((SELECT 1 FROM tbl_supervisor WHERE user_id = tr.user_id AND student_id =
                (SELECT student_id FROM tbl_application WHERE application_id = tr.application_id)) = 1, 'SUPERVISOR',
                IF((SELECT 1 FROM tbl_examiner WHERE examiner1 = tr.user_id AND application_id = tr.application_id) = 1, 'EXAMINER 1',
                IF((SELECT 1 FROM tbl_examiner WHERE examiner2 = tr.user_id AND application_id = tr.application_id) = 1, 'EXAMINER 2', 'NULL')))) AS role
                FROM tbl_thesis_result tr 
                INNER JOIN tbl_thesis_comment tc on tr.user_id = tc.user_id WHERE tc.application_id = ? AND tr.application_id = ?) t2 ON t1.user_id = t2.user_id;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "pre_viva_application.php");
        } 
        else{
            mysqli_stmt_bind_param($stmt, "ssss", $application_id, $application_id, $application_id, $application_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // $row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result)){
                array_push($outputs, $row);
            }
            echo json_encode($outputs);
        }
    }

?>