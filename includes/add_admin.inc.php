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

        $errors = array();

         // If the form is error free, then register the user 
        if (count($errors) == 0) {
            $sql = "INSERT INTO tbl_user (user_id, name, email, phone_no, ic, passport, sex, race, religion, country, nationality, register_status, password, user_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                header("Location: " . ROOT . "manage_admin.php");
            } 
            else {
                mysqli_stmt_bind_param($stmt, "ssssssssssssss", $user_id, $name, $email, $phone, $ic, $passport, $sex, $race, $religion, $country, $nationality, $status, $hashed_password, $user_type);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $_SESSION['insert-success'] = "Admin data insert successfully";
                header("Location: " . ROOT . "manage_admin.php");
            }
        }
        else{
            $_SESSION['insert-unsuccess'] = "Admin data insert unsuccessfully";
            header("Location: " . ROOT . "manage_admin.php");
        }
    }

?>