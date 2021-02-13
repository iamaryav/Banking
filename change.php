<?php

    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
    else{

        $con = mysqli_connect("localhost", "root", "", "banking");

        if(!con){
            die("Connection failed: " .mysqli_connect_error());
        }

        if(isset($_POST['button4'])){

            $cpass = $_POST['cpwd'];
            $npass = $_POST['npwd'];
            $cnpass = $_POST['cnpwd'];
            $email = $_SESSION['email']; 

            $sql = " SELECT account FROM customer WHERE email = '$email' and password='$cpass' ";
            $result = mysqli_query($con, $sql);
           

            if(mysqli_num_rows($result) == 1){

                if($npass == $cnpass){


                    $row = mysqli_fetch_array($result);
                    $account = $row['account'];
                    $sql2 = " UPDATE customer SET password = '$cnpass' WHERE account = '$account' ";
                    $result2 = mysqli_query($con, $sql2);
                    if($result2){
                        //echo "password sucessfully updated ";
                        $_SESSION['message']="password sucessfully updated ";
                        header('location: user_account.php');
                    }
                    else{
                        //echo "password updation failed";
                        $_SESSION['message1']="password updation failed";
                        header('location: password.php');
                    }

                }
                else{
                    //echo "Password does not match";
                    $_SESSION['message1']="Password does not match";
                    header('location:password.php');
                }

            }
            else{
                //echo "Current Password is wrong";
                $_SESSION['message1']="Your old Password does not match";
                header('location:password.php');
            }
        }
    }
?>