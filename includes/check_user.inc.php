<?php

include_once "dbh.inc.php";

    if(isset($_POST['user_name']) && $_POST['user_name'] != ''){
        $response = array();
        $username = strtoupper(mysqli_real_escape_string($conn,$_POST['user_name']));
        $sql  = "SELECT user_id FROM tbl_user where tbl_user.user_id='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count != 0)
        {
            $response['status'] = false;
            $response['msg'] = 'Username already exists.';
        }
        else
        {
            $response['status'] = true;
            $response['msg'] = 'Username is available.';
        }
            echo json_encode($response);
    }

?>