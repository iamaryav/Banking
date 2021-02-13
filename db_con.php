<?php
    session_start();
    
    if(!isset($_SESSION['email'])){

      header('location:login.php');

    }
    else{

      $con = mysqli_connect("localhost", "root", "", "banking") or die(mysqli_connect_error());

    }
?>