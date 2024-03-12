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
        // $password = mysqli_real_escape_string($conn, $_POST['password']);
        // $user_type = mysqli_real_escape_string($conn, $_POST['usertype']);

        $errors = array();

         // If the form is error free, then update the user 
        if (count($errors) == 0) {
            $sql = "UPDATE tbl_user SET name = ?, email = ?, phone_no = ?, ic = ?, passport = ?, sex = ?, race = ?, religion = ?, country = ?, 
                    nationality = ?, register_status = ? 
                    WHERE user_id = ?;";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['edit-error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_admin.php");
            } 
            else {
                mysqli_stmt_bind_param($stmt,  "ssssssssssss", $name, $email, $phone, $ic, $passport, $sex, $race, $religion, $country, $nationality, $status, $user_id);
                mysqli_stmt_execute($stmt);
                $_SESSION['update-success'] = "Admin data update successfully.";
                header("Location: " . ROOT . "manage_admin.php");
            }
        }
        else{
            $_SESSION['update-unsuccess'] = "Admin data update unsuccessfully.";
            header("Location: " . ROOT . "manage_admin.php");
        }
    }

?>