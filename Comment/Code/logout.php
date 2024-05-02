<?php
    
    session_start();

    unset($_SESSION['auth_user_id']);
    unset($_SESSION['authuser_name']);

    $_SESSION['status'] = "Logout Successfully";
    header('Location:facebook.com');

?>