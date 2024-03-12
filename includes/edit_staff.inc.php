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
        $designation = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_designation']));
        $field_category = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_field_category']));
        $field = strtoupper(mysqli_real_escape_string($conn, $_POST['edit_field']));

        $errors = array();

         // If the form is error free, then update the user 
        if (count($errors) == 0) {
            $sql = "UPDATE tbl_user SET name = ?, email = ?, phone_no = ?, ic = ?, passport = ?, sex = ?, race = ?, religion = ?, country = ?, nationality = ?, register_status = ? 
                    WHERE user_id = ?;";
            $sql1 = "UPDATE tbl_staff SET faculty = ?, designation = ?, field_category = ?, field = ?
                     WHERE user_id = ?;";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['edit-error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_staff.php");
            } 
            else {
                mysqli_stmt_bind_param($stmt,  "ssssssssssss", $name, $email, $phone, $ic, $passport, $sex, $race, $religion, $country, $nationality, $status, $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql1)){
                    $_SESSION['edit-error'] = "Something went wrong! Please contact system developer!";
                    header("Location: " . ROOT . "manage_staff.php");
                } 
                else{
                    mysqli_stmt_bind_param($stmt,  "sssss", $faculty, $designation, $field_category, $field, $user_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                $_SESSION['update-success'] = "Staff data update successfully.";
                header("Location: " . ROOT . "manage_staff.php");
            }
        }
        else{
            $_SESSION['update-unsuccess'] = "Staff data update unsuccessfully.";
            header("Location: " . ROOT . "manage_staff.php");
        }
    }

?>