<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['deleteid'])){

        $deleteid = strtoupper(mysqli_real_escape_string($conn, $_POST['deleteid']));

            $sql = "DELETE FROM tbl_user WHERE user_id = ?;";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['delete-error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_admin.php");
            } 
            else {
                mysqli_stmt_bind_param($stmt,  "s", $deleteid);
                mysqli_stmt_execute($stmt);
            }
    }
?>