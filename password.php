<?php
    session_start();
    
    if(!isset($_SESSION['email'])){
      header('location:login.php');
    }
    else{

      $con = mysqli_connect("localhost", "root", "", "banking");

      if(!$con){
        die("Connection failed: ".mysqli_connect_error());
      }


    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/transaction_style.css" />
    <title>Transaction</title>
  </head>
  <body>
    <div class="header"><span id="head_logo">Online Banking</span><span id="header_home"><a href="user_account.php">Home</a></span>
        <span id="header_logout"><a href="logout.php">Logout</a></span></div>
    <div class="site_body">
      <div class="left_side">
        <div class="features">    
            <span class="left_account"><a href="user_account.php">Account Services</a></span><hr>
            <span class="left_account"><a href="transaction.php">Money Transfer</a></span><hr>
            <span class="left_account"><a href="password.php">Password Management</a></span><hr>
            <span class="left_account"><a href="MiniStat.PHP">Mini Statement</a></span><hr>
            <span class="left_account"><a href="#">Settings</a></span>
            </div>
      </div>
      <form action="change.php" method="post" id="login_form">
        <table>
          <tr>
            <td>Current Password</td>
            <td>
              <input
                type="password"
                id="uname"
                name="cpwd"
                autocomplete="off"
                class="inputt" required
              /><br /><br />
            </td>
          </tr>
          
            <td>New Password</td>
            <td>
              <input type="password" id="amt" name="npwd" class="inputt" required/>
              <br />
              <br />
            </td>
          </tr>
          <tr>
          <td>Confirm Password</td> 
          <td>
          <input
            type="password"
            id="pwd"
            name="cnpwd"
            autocomplete="off"
            class="inputt" required
          /><br /><br />
        </td>
        </tr>
        <tr>
        <td colspan="2"><span id="error"><?php echo $_SESSION['message1']; ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
          <input
            type="submit"
            value="Change"
            id="button1"
            name="button4"
          /><br /><br />
        </td>
        </tr>
        </table>
      </form>
      <div class="right_side">right</div>
    </div>
    <div class="footer">footer</div>
  </body>
</html>
<?php
$_SESSION['message1']="";
?>