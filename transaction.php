<?php
    include 'db_con.php';
    $error="";
    
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
            <span class="left_account"><a href="MiniStat.php">Mini Statement</a></span><hr>
            <span class="left_account"><a href="#">Settings</a></span>
            </div>
      </div>
      <form action="send.php" method="post" onsubmit="return validate()" id="login_form">
        <table>
          <tr>
            <td>Account</td>
            <td>
              <input
                type="number"
                id="act"
                name="act"
                autocomplete="off"
                class="inputt"
              /><br /><br />
            </td>
          </tr>
          
            <td>Amount</td>
            <td>
              <input type="number" id="amt" name="amt" class="inputt" />
              <br />
              <br />
            </td>
          </tr>
          <tr>
          <td>Password</td> 
          <td>
          <input
            type="password"
            id="pwd"
            name="pw"
            autocomplete="off"
            class="inputt"
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
            value="Send"
            id="button1"
            name="button3"
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
<script>

  // fetching all variables

  var act = document.getElementById('act');
  var amt = document.getElementById('amt');
  var pwd = document.getElementById('pwd');

  fieldfocus();

  function fieldfocus(){

    act.focus();

  }
  // setting up all event listener
  
  act.addEventListener("blur", actVerify, true);
  amt.addEventListener("blur", amtVerify, true);
  pwd.addEventListener("blur", pwdVerify, true);

  // validate function

  function validate(){

    if(act.value == ""){
      act.style.border = "2px red solid";
      error.textContent = "Account number is required";
      act.focus();
      return false;
  }
  if(amt.value == ""){
      amt.style.border = "2px red solid";
      error.textContent = "Amount is required";
      amt.focus();
      return false;
  }
  if(pwd.value == ""){
      pwd.style.border = "2px red solid";
      error.textContent = "password is required";
      pwd.focus();
      return false;
  }
  }

   //event handler function

   function actVerify() {
    if (act.value != "") {
      act.style.border = "1px black solid";
      error.innerHTML = "";
      return true;
    }
  }
   function amtVerify() {
    if (amt.value != "") {
      amt.style.border = "1px black solid";
      error.innerHTML = "";
      return true;
    }
  }
   function pwdVerify() {
    if (pwd.value != "") {
      pwd.style.border = "1px black solid";
      error.innerHTML = "";
      return true;
    }
  }

</script>
