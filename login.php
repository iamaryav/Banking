<?php
    session_start();

    //database connection object oriented


    // checking for user that are already login

    if(isset($_SESSION['email'])){
        header('location:./user_account.php');
    }

    $con = new mysqli("localhost", "root", "", "banking");

    // check connection

    if($con->connect_error){
        die("Failed to connect:" .$con->connect_error);
    }

    // taking variable in case of username or password is worng
    $error="";

    //checking if submit button pressed or not

    if(isset($_POST['button1'])){

        // fetching form data

        $email = trim($_POST['uname']);
        $pass = trim($_POST['pwd']);

        $sql = "SELECT fname, lname, email FROM customer WHERE email='$email' AND password='$pass' ";
        $result = $con->query($sql) or die("oops");
        
        //check user credentials
        if(mysqli_num_rows($result) == 1){
            
            $_SESSION['message'] = "You are Logged in";
            $row = mysqli_fetch_array($result);
            $_SESSION['email'] = $row['email'];

            // Assigning last login date and time

           // date_default_timezone_set('India/New delhi');
            //$date_time = date('Y-m-d H:i:s',time());
            //echo $date_time;
            $sql1 = " UPDATE account SET last_login= now() WHERE email='$email' ";
            $con->query($sql1) or die("oopss");


            header('location:./user_account.php');
        }
        else{
            $error = "Username or password is wrong ";
        }
    }

    // close the connection of database

    $con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/login_style.css" />
    <title>Home</title>
</head>
<body>
    <div class="header"><span id="head_logo">Online Banking</span></div>
    <div class="site_body">
    <div class="left_side">Left</div>
    <div class="main_body">
        <!-- <marquee direction="left">
            *Beware of Frauds, Don't share your password with anyone
        </marquee> -->
    <form action="login.php" method="post" id="login_form">
    Username <input type="text" id="uname" name="uname" autocomplete="off" class="inputt" required /><br><br>
    Password <input type="password" id="pwd" name="pwd" autocomplete="off" class="inputt"  required/><br/><br>
    <span id="error"><?PHP echo $error; ?></span>
    <input type="submit" value="login" id="button1" name="button1"><br><br>
    <a href="register.php" id="link1">New user?Create an account</a>
    </form>
    </div>
    <div class="right_side">right</div>
    </div>
    <div class="footer">footer</div>
</body>
</html>