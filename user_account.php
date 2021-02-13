<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
    else{

        $con = mysqli_connect("localhost", "root", "", "banking");
        $email = $_SESSION['email'];

        $sql = "SELECT * FROM customer WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result)== 1){

            $row = mysqli_fetch_array($result);
            $fname = $row['fname'];
            $lname = $row['lname'];
            $account = $row['account'];
            $_SESSION['account'] =  $row['account'];
            $_SESSION['message1']="";
            
        }
        $sql1 = "SELECT * FROM account WHERE account = '$account'";
        $result1 = mysqli_query($con, $sql1);

        if(mysqli_num_rows($result1)== 1){

            $row1 = mysqli_fetch_array($result1);
            $balance = $row1['balance'];
           
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fname." ".$lname; ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/user_account_style.css">
</head>
<body>
<div class="header"><span id="head_logo">Online Banking</span><span id="header_home"><a href="#">Home</a></span>
<span id="header_logout"><a href="logout.php">Logout</a></span></div>
<div class="site_body">
<div class="left_side">
<div class="features">    
<span class="left_account"><a href="#">Account Services</a></span><hr>
<span class="left_account"><a href="transaction.php">Money Transfer</a></span><hr>
<span class="left_account"><a href="password.php">Password Management</a></span><hr>
<span class="left_account"><a href="MiniStat.PHP">Mini Statement</a></span><hr>
<span class="left_account"><a href="#">Settings</a></span>
</div>
</div>
<div class="main_body"><span id="main_name"><h1><?php echo $fname." ".$lname; ?></h1></span>
<table>
    <tr>
        <td>Account Number</td>
        <td>Total Balance</td>
</tr>
<tr>
    <td><?php echo $row['account']?></td>
    <td><?php echo $balance; ?></td>
</tr>
</table>
<span id="last_login"><h2>Last Login</h2><?php echo $row1['last_login']; ?></span>
</div>
<div class="right_side">Right</div>
</div>  
<div class="footer"></div>

    
</body>
</html>
<script>
    $var = "<?php echo $_SESSION['message']; ?>";
    if($var != ""){
        alert($var);
    }
</script>

<?php 

$_SESSION['message'] =""; 

?>

