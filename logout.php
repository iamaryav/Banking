<?php
    session_start();
    session_destroy();
    unset($_POST['email']);
    header('location:login.php');
?>