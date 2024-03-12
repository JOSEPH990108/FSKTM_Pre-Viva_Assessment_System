<?php

require_once 'dbh.inc.php';

if(isset($_POST['login_submit']))
{
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $register_status = 1;

    //PHP Validation
    if(empty($username) && empty($password)){
        $_SESSION['username-error'] = "<div class='alert'>Staff ID or Matric ID field is required.</div>";
        $_SESSION['password-error'] = "<div class='alert'>Password field is required.</div>";
        header("Location: " . ROOT);
    }
    else if(empty($username)){
        $_SESSION['username-error'] = "<div class='alert'>Staff ID or Matric ID field is required.</div>";
        header("Location: " . ROOT);
    }
    else if(empty($password)){
        $_SESSION['password-error'] = "<div class='alert'>Password field is required.</div>";
        header("Location: " . ROOT);
    }
    else{
        //Prepare statement
        $sql = "SELECT user_id, user_type, password FROM tbl_user WHERE user_id = ? AND register_status = ?;";
        $stmt =  mysqli_stmt_init($conn);

        //Check connection and sql statement without any error
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //Redirect to login page
            $_SESSION['error'] = "<div class='alert'>Something went wrong! Please contact system developer!</div><br/>";
            header("Location: " . ROOT);
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $register_status);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $user_id = $row['user_id'];
                $user_type = $row['user_type'];
                $hashed_password = $row['password'];

                if(password_verify($password, $hashed_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_type'] = $user_type;
                    //Redirect user to home page of the system
                    header('Location: ' . ROOT . 'home.php');
                }
                else{
                     //Invalid password
                    $_SESSION['login-fail'] = "<div class='alert'>Invalid password. Please try again.</div><br/>";
                    header("Location: " . ROOT);
                    exit();
                }
            }
            else{
                //No user found in database
                $_SESSION['no-user'] = "<div class='alert'>Invalid username or registration. Please try again.</div><br/>";
                header("Location: " . ROOT);
                exit();
            }
        }
    }

}

// if(isset($_POST['login_submit'])){

//     //Get username and password from form
//     // $username = $_POST['username'];
//     // $password = $_POST['password'];

//     $username = filter_input(INPUT_POST, 'username');
//     $password = filter_input(INPUT_POST, 'password');
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//     $register_status = 1;

//     //PHP Validation
//     if(empty($username) && empty($password)){
//         $_SESSION['username_error'] = "<div class='alert'>Staff ID or Matric ID field is required.</div>";
//         $_SESSION['password_error'] = "<div class='alert'>Password field is required.</div>";
//         header("Location: " . ROOT);
//     }
//     else if(empty($username)){
//         $_SESSION['username_error'] = "<div class='alert'>Staff ID or Matric ID field is required.</div>";
//         header("Location: " . ROOT);
//     }
//     else if(empty($password)){
//         $_SESSION['password_error'] = "<div class='alert'>Password field is required.</div>";
//         header("Location: " . ROOT);
//     }
//     else{
        
//         //Prepare statement
//         $sql = "SELECT user_id, user_type FROM tbl_user WHERE user_id = ? AND password = ? AND register_status = ?;";
//         $stmt =  mysqli_stmt_init($conn);

//         //Check connection and sql statement without any error
//         if(!mysqli_stmt_prepare($stmt, $sql)){
//             //Redirect to login page
//         header("Location: " . ROOT);
//         exit();
//         }
//         else{    
//             mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $register_status);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);

//             //Check whether data inside the database
//             if($row = mysqli_fetch_assoc($result)){

//                     //Global variable to store user_id
//                     $_SESSION['user_id'] = $row['user_id'];
//                     $_SESSION['user_type'] = $row['user_type'];
//                     //Redirect user to home page of the system
//                     header('Location: ' . ROOT . 'home.php');
//                     //exit();  

//             }
//             else{
//                 //If no user id is found in database
//                 $_SESSION['login-fail'] = "<div class='alert'>Invalid login credentials or registration status. Please try again.</div><br/>";
//                 header("Location: " . ROOT);
//                 exit();
//             }
//         }
//     }
// }
// else{
//     header("Location: " . ROOT);
//     exit();
// }


?>