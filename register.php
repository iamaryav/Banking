<?php
    session_start();

    //database connection object oriented

    $con = new mysqli("localhost", "root", "", "banking");

    // check connection

    if($con->connect_error)
    { 
      die("Failed to connect:" .$con->connect_error); 
    }

//fetching data for states 

$name_error="";

$sql1 = "SELECT state from states"; 
$result1 =mysqli_query($con, $sql1) or die(mysqli_error($con)); 
$num1 =mysqli_num_rows($result1); 

//checking if submit button pressed or not

if(isset($_POST['button2']))
{ 
  //fetching all form data 

  $fname =  check_input($_POST['fname']); 
  $lname = check_input($_POST['lname']); 
  $email =  check_input($_POST['email']); 
  $pass = check_input($_POST['pwdc']); 
  $mobile =  check_input($_POST['mobile']); 
  $gender = check_input($_POST['gender']); 
  $add1 = check_input($_POST['add1']); 
  $add2 = check_input($_POST['add2']); 
  $add3 = check_input($_POST['add3']); 
  $add4 = check_input($_POST['add4']); 
  $states = check_input($_POST['states']); 
  $country = check_input($_POST['country']);
  $aadhar = check_input($_POST['aadhar']); 
  $dob = check_input($_POST['dob']); 

  // check if email, phone, aadhar is already taken or not

  $sql_e = " SELECT * FROM customer WHERE email ='$email' ";
  $sql_m = " SELECT * FROM customer WHERE mobile ='$mobile' ";
  $sql_a = " SELECT * FROM customer WHERE aadhar ='$aadhar' ";

  $res_e = mysqli_query($con, $sql_e) or die(mysqli_error($con));
  $res_m = mysqli_query($con, $sql_m) or die(mysqli_error($con));
  $res_a = mysqli_query($con, $sql_a) or die(mysqli_error($con));

  if(mysqli_num_rows($res_e)>0){

    $name_error ="Sorry.. email is already taken";

  }else if(mysqli_num_rows($res_m)>0){

    $name_error ="Sorry.. phone is already present";

  }else if(mysqli_num_rows($res_a)>0){

    $name_error ="Sorry.. aadhar is already present";
    
  }else{

// sql query for inserting data if query not executed then die with printing message

$sql = "INSERT INTO customer (fname, lname, email, password, mobile, dob, gender, aadhar) VALUES ('$fname', '$lname', '$email', '$pass', $mobile,'$dob','$gender', $aadhar)";
$result = $con->query($sql) or die(mysqli_error($con)); 

$sql1 = " INSERT INTO address (email, house, city, district, state, country, pin) VALUES ('$email', '$add1', '$add2', '$add3', '$states', '$country', $add4) "; 
$result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));  

// check if data is inserted or not 

  if($result === true && $result === true)
  { 
    $name_error="";

    echo "Account created";
    header('location:./user_account.php');

  } 
  else
  { 

    echo "Error :".$sql ."<br />".$con->error;

  } 
}

} 

// for triming and removing extracharacters from input data

function check_input($data){
  $data= trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return $data;
}

//closing the database

$con->close(); 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/register_style.css" />
    <title>Register Here</title>
  </head>
  <body>
    <div class="header"><span id="head_logo">Online Banking</span></div>
    <div class="site_body">
      <div class="left_side">left</div>
      <form
        action="register.php"
        method="POST"
        onsubmit="return validate()"
        id="reg_form"
      >
        <span id="error"> <?php echo $name_error; ?> </span>
        <input
          type="text"
          id="fname"
          name="fname"
          placeholder="First Name"
          class="inputtt"
        />
        <input
          type="text"
          id="lname"
          name="lname"
          placeholder="Last Name"
          class="inputtt"
        />
        <input
          type="Email"
          id="email"
          name="email"
          placeholder="Email"
          class="inputtt"
        />
        <input
          type="password"
          id="pwd"
          name="pwd"
          placeholder="Create password"
          class="inputtt"
        />
        <input
          type="password"
          id="pwdc"
          name="pwdc"
          placeholder="Confirm password"
          class="inputtt"
        />
        <input
          type="number"
          id="mobile"
          name="mobile"
          placeholder="Mobile No"
          class="inputtt"
        /><br />
        <input type="date" id="dob" name="dob" class="inputtt" /><br />
        <select id="gender" name="gender" class="inputtt">
          <option>Gender</option>
          <option>Male</option>
          <option>Female</option>
          <option>Other</option> </select
        ><br />
        <input
          type="text"
          name="add1"
          id="add1"
          placeholder="Enter House/building/Road_no"
          class="inputtt"
        /><br />
        <input
          type="text"
          name="add2"
          id="add2"
          placeholder="Enter village or city name"
          class="inputtt"
        /><br />
        <input
          type="text"
          name="add3"
          id="add3"
          placeholder="Enter District Name"
          class="inputtt"
        /><br />
        <input
          type="text"
          name="add4"
          id="add4"
          placeholder="Enter Pincode"
          class="inputtt"
        /><br />
        <select id="states" name="states" class="inputtt">
          <option>State</option>
          <?php
            for($i=1;$i<=$num1;$i++){
                $row1 = mysqli_fetch_array($result1); 
            ?>
          <option><?php echo $row1['state']; ?></option>
          <?php 
                } 
            ?>
        </select>
        <select id="country" name="country" class="inputtt">
          <option>country</option>
          <option>India</option>
          <option>United States</option>
          <option>United Kingdom</option> </select
        ><br />
        <input
          type="number"
          name="aadhar"
          id="aadhar"
          placeholder="Enter Aadhar Number"
          class="inputtt"
        /><br />
        <input
          type="submit"
          name="button2"
          id="button2"
          value="Register"
        /><br />
        <a href="login.php" id="link2">Already have an account?sign in</a>
      </form>
      <div class="right_side">right</div>
    </div>
    <!-- <div class="footera">footer</div> -->
  </body>
</html>
<script>

  // fetching all html element

  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var pass = document.getElementById("pwd");
  var cpass = document.getElementById("pwdc");
  var phone = document.getElementById("mobile");
  var gender = document.getElementById("gender");
  var add1 = document.getElementById("add1");
  var add2 = document.getElementById("add2");
  var add3 = document.getElementById("add3");
  var add4 = document.getElementById("add4");
  var states = document.getElementById("states");
  var country = document.getElementById("country");
  var aadhar = document.getElementById("aadhar");
  var dob = document.getElementById("dob");
  var error = document.getElementById("error");

  // on start focus on fname

  fieldfocus();

  function fieldfocus() {
    fname.focus();
  }

  // function for register form validation

  function validate() {
    var date = document.getElementById("dob");
    var date1 = new Date(date.value);
    var date2 = new Date();

    //fname validation

    if (fname.value.trim() == "") {
      fname.style.border = "1px red solid";
      error.textContent = "First Name is required";
      fname.focus();
      return false;
    }

    // lname validation

    if (lname.value.trim() == "") {
      lname.style.border = "1px red solid";
      error.textContent = "Last Name is required";
      lname.focus();
      return false;
    }
    if (fname.value.trim().length <= 1 || lname.value.trim().length <= 1) {
      alert("Name must contains more than one character");
      fname.focus();
      fname.style.border = "1px red solid";
      return false;
    }

    //email validation

    if (email.value == "") {
      email.style.border = "1px red solid";
      error.textContent = "Email is required";
      email.focus();
      return false;
    }
    //password validation

    if (pass.value.trim() == "") {
      pass.style.border = "1px red solid";
      error.textContent = "password  is required";
      pass.focus();
      return false;
    }
    if (cpass.value.trim() == "") {
      cpass.style.border = "1px red solid";
      error.textContent = "Confirm your password";
      cpass.focus();
      return false;
    }
    if (cpass.value.trim().length < 8 || pass.value.trim().length < 8) {
      cpass.style.border = "1px red solid";
      pass.style.border = "1px red solid";
      alert("Password must have more than eight character");
      pass.focus();
      return false;
    }

    if (pass.value.trim() != cpass.value.trim()) {
      pass.style.border = "1px red solid";
      cpass.style.border = "1px red solid";
      error.textContent = "The two password do not match";
      pass.focus();
      return false;
    }

    if (phone.value == "") {
      phone.style.border = "1px red solid";
      error.textContent = "Mobile no. is required";
      phone.focus();
      return false;
    }
    if (phone.value.length != 10) {
      phone.style.border = "1px red solid";
      alert("Mobile no. must have ten digit");
      phone.focus();
      return false;
    }
    if (date.value == "") {
      date.style.border = "1px red solid";
      error.textContent = "Date of birth is required";
      date.focus();
      return false;
    }

    if (date2.getFullYear() - date1.getFullYear() < 13) {
      date.style.border = "1px red solid";
      error.textContent = "You are under 13";
      date.focus();
      return false;
    }
    if (gender.value == "Gender") {
      gender.style.border = "1px red solid";
      error.textContent = "Gender is required";
      gender.focus();
      return false;
    }
    if (add1.value == "") {
      add1.style.border = "1px red solid";
      error.textContent = "House no. is required";
      add1.focus();
      return false;
    }
    if (add2.value == "") {
      add2.style.border = "1px red solid";
      error.textContent = "City name is required";
      add2.focus();
      return false;
    }
    if (add3.value == "") {
      add3.style.border = "1px red solid";
      error.textContent = "District name is required";
      add3.focus();
      return false;
    }
    if (add4.value == "") {
      add4.style.border = "1px red solid";
      error.textContent = "Pin no. is required";
      add4.focus();
      return false;
    }
    if (add4.value.length != 6) {
      add4.style.border = "1px red solid";
      error.textContent = "Pin no. must contain only six digit";
      add4.focus();
      return false;
    }
    if (states.value == "State") {
      states.style.border = "1px red solid";
      error.textContent = "State name is required";
      states.focus();
      return false;
    }
    if (country.value == "country") {
      country.style.border = "1px red solid";
      error.textContent = "Country name is required";
      country.focus();
      return false;
    }
    if (aadhar.value == "") {
      aadhar.style.border = "1px red solid";
      error.textContent = "Aadhar no. is required";
      aadhar.focus();
      return false;
    }
    if(aadhar.value.length != 12){
      aadhar.style.border = "1px red solid";
      error.textContent = "Must contains only 12 digit";
      aadhar.focus();
      return false;
    }
  }
</script>
