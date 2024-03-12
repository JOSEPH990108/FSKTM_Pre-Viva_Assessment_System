<?php
    include_once "dbh.inc.php";
    $userid = $_SESSION['user_id'];

    if(isset($_POST['submitbtn'])){

        $oldpass =$_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $confirmpass = $_POST['confirmpass'];
        $hashed_newpass = password_hash($newpass, PASSWORD_DEFAULT);

        $sql = "SELECT password FROM tbl_user
                WHERE user_id = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "Something went wrong! Please contact system developer!";
            header("Location: " . ROOT . "update_password.php");
            exit();
        } 
        else{
            mysqli_stmt_bind_param($stmt, "s", $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $hashed_password = $row['password'];
            }
            else{
                $_SESSION['no-user-found'] = "No user id found. Please contact system developer!";
                header("Location: " . ROOT . "update_password.php");
                exit();
            }
            mysqli_stmt_close($stmt);
        }

        if(!password_verify($oldpass, $hashed_password)){
            $_SESSION['incorrect-oldpass'] = "Incorrect old password. Please try again.";
            header("Location: " . ROOT . "update_password.php");
            exit();
        }
        else{
            if($oldpass === $newpass){
                $_SESSION['cannot-repeat-oldpass'] = "New password is same as old password. Please try again.";
                header("Location: " . ROOT . "update_password.php");
                exit();
            }
            else{
                if($newpass != $confirmpass){
                $_SESSION['not-match-confirmpass'] = "Confirm password does not matched. Please try again.";
                header("Location: " . ROOT . "update_password.php");
                exit();
                }
                else{
                    $sql1 = "UPDATE tbl_user SET password = ?
                            WHERE user_id = ?;";
                    $stmt = mysqli_stmt_init($conn);     

                    if(!mysqli_stmt_prepare($stmt, $sql1)){
                        $_SESSION['error'] = "Something went wrong! Please contact system developer!";
                        header("Location: " . ROOT . "update_password.php");
                    } 
                    else{
                        mysqli_stmt_bind_param($stmt, "ss", $hashed_newpass, $userid);
                        mysqli_stmt_execute($stmt);
                        $_SESSION['update-success'] = "Password changed successfully.";
                        header("Location: " . ROOT . "home.php");
                    }
                }
            }
            
        }

    }
?>