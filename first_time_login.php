<?php
    include_once 'includes/dbh.inc.php';

    $sql_checked_admin = "SELECT COUNT(*) AS total_admin FROM tbl_user WHERE user_type = 'ADMIN'";
    $result_checked_admin = mysqli_query($conn, $sql_checked_admin);
    $row_checked_admin = mysqli_fetch_assoc($result_checked_admin);
    $total_admins = $row_checked_admin['total_admin'];

    if($total_admins == 0){
    $user_id = "AM001"; 
    $name = "JOSEPH ADMIN"; 
    $email = "josephadmin@uthm.edu.my"; // Admin's email address
    $phone_no = "601128758432"; // Admin's phone number
    $ic = "990108-01-6136"; // Admin's identification number (e.g., IC number)
    $passport = "";
    $sex = "MALE"; // Admin's gender
    $race = "CHINESE"; // Admin's race
    $religion = "CHRISTIAN";
    $nationality = "MALAYSIAN"; // Admin's nationality
    $country = "MALAYSIA"; // Admin's country of residence
    $register_status = 1; // Admin's register status (e.g., true or false)
    $password = "AM001";
    $user_type = "ADMIN";
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tbl_user (user_id, name, email, phone_no, ic, passport, sex, race, religion, nationality, country, register_status, password, user_type)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $user_id, $name, $email, $phone_no, $ic, $passport, $sex, $race, $religion, $nationality, $country, $register_status, $hash_password, $user_type);
    // Set values for parameters and execute the statement
    mysqli_stmt_execute($stmt);
    // Handle success or errors accordingly
    $_SESSION['first-time-success'] = "<div class='alert-success1'>Admin created successfully! Login now!</div>";
    header("Location: " . ROOT);
    } else {
    // Handle SQL statement preparation failure
    $_SESSION['first-time-unsuccess'] = "<div class='alert'>Admin created unsuccessfully! Contact developer!</div>";
    header("Location: " . ROOT);
    }
    }
    else{
        // Inform that there is already an admin
        $_SESSION['admin-already-exists'] = "<div class='alert'>An admin already exists! Cannot add another admin!</div>";
        header("Location: " . ROOT);
    }

?>