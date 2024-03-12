<?php

    include_once "dbh.inc.php";

    if(isset($_POST['application_id'])){
        $applicationid = $_POST['application_id'];
        $outputs = [];
        $sql = "SELECT * FROM tbl_examiner WHERE application_id = ?;";
        $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "pre_viva_application.php");
            } 
            else{
                mysqli_stmt_bind_param($stmt,  "s", $applicationid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)){ // Loop through all records
                    $outputs[] = $row; // Append each row to the $outputs array
                }
                echo json_encode($outputs);

            }
    
    }

?>