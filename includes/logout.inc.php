<?php
require_once 'dbh.inc.php';
//1. Destroy the session
session_destroy(); //Unsets $_SESSION['user_id']
//2. Redirect to login page
header('Location:' . ROOT);

?>