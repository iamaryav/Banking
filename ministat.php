<?php

  // starting the login session

  session_start();

  // checking if email is still set or not

  if(!isset($_SESSION['email'])){
    header('location:login.php');
  }
  else{

    // establishing connectio with database

    $con = mysqli_connect("localhost", "root", "", "banking") or die(mysqi_error($con));
    $email = $_SESSION['email'];

    // fetching the statement table data

    $sql1 = " SELECT * FROM statement WHERE email = '$email' ";
    $result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
    $num = mysqli_num_rows($result1);
    $row1 = mysqli_fetch_assoc($result1);
    
    $first0 = $row1['first'];    
    $second0 = $row1['second'];    
    $third0 = $row1['third'];    
    $fourth0 = $row1['fourth'];    
    $fifth0 = $row1['fifth'];


  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=\, initial-scale=1.0" />
    <title>Mini Statement</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/transaction_style.css" />
    <link rel="stylesheet" href="./css/ministat_style.css" />
  </head>
  <body>
    <div class="header">
      <span id="head_logo">Online Banking</span
      ><span id="header_home"><a href="user_account.php">Home</a></span>
      <span id="header_logout"><a href="logout.php">Logout</a></span>
    </div>
    <div class="site_body">
      <div class="left_side">
        <div class="features">
          <span class="left_account"
            ><a href="user_account.php">Account Services</a></span
          >
          <hr />
          <span class="left_account"
            ><a href="transaction.php">Money Transfer</a></span
          >
          <hr />
          <span class="left_account"
            ><a href="password.php">Password Management</a></span
          >
          <hr />
          <span class="left_account"
            ><a href="MiniStat.php">Mini Statement</a></span
          >
          <hr />
          <span class="left_account"><a href="#">Settings</a></span>
        </div>
      </div>
      <div class="main_body">
        <h2>Mini Statement</h2>
        <table>
          <tr>
            <td>sl no.</td><td>Transaction</td>
          </tr>
            <tr>
            <td>1</td><td><?php echo $first0; ?></td>
          </tr>
            <tr>
            <td>2</td><td><?php echo $second0; ?></td>
          </tr>
            <tr>
            <td>3</td><td><?php echo $third0; ?></td>
          </tr>
            <tr>
            <td>4</td><td><?php echo $fourth0; ?></td>
          </tr>
            <tr>
            <td>5</td><td><?php echo $fifth0; ?></td>
          </tr>
        </table>
      </div>
      <div class="right_side">right</div>
    </div>
    <div class="footer">footer</div>
  </body>
</html>
