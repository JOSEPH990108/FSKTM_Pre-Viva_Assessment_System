<?php

require_once 'dbh.inc.php';

//Authorization - Access Control
    //Check whether the user is logged in or not
    if (!isset($_SESSION['user_id'])) //If user session is not set
    {
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login'] = "<div class='alert'>Please login to access this system</div>";
        //Redirect to Login Page
        header('Location: ' . ROOT);
    }

?>