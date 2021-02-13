<?php 

  // startin a session

    session_start();

    // checking if email is set or not
    
    if(!isset($_SESSION['email'])){
      header('location:login.php');
    }
    else{

      // Establishing database connection with checking if connection is established or not

      $con = mysqli_connect("localhost", "root", "", "banking") or die(mysqli_connect_error());

      // if database connection is established or not

      /*if(!$con){
        die("Connection failed: ".mysqli_connect_error());
      }*/

      // if send button is clicked

      if(isset($_POST['button3'])){

        // fetching amount to send and recieve

        $rec_account = $_POST['act'];
        $rec_amount = $_POST['amt'];
        $send_pwd= $_POST['pw'];
        $email = $_SESSION['email'];
        $account = $_SESSION['account'];
        $_SESSION['message1']="";

        // for insuring that sender and receiver account is not same

        if($account != $rec_account){

        // checking if password is correct or not

        $sql0 = " SELECT account FROM account WHERE account=$rec_account ";
        $res0 = mysqli_query($con, $sql0) or die(mysqli_error($con));

        if(mysqli_num_rows($res0)>0){

        $sql = " SELECT account FROM customer where email = '$email' && password = '$send_pwd' ";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result)==1){

          // fetching sender current balance

            
            $sql1 = " SELECT * FROM account WHERE account = $account ";
            $result1 = mysqli_query($con, $sql1);
            $row = mysqli_fetch_array($result1);
            $send_balance = $row['balance'];

            // if sender account balance is less than sending amount then send

            if($rec_amount <= $send_balance){

               // fetching receiver current balance

                $sql2 = " SELECT * FROM account WHERE account = $rec_account ";
                $result2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_array($result2);
                $rec_balance = $row2['balance'];

              // subtracting amount from senders account

                $temp1 = $send_balance - $rec_amount;
                $sql3 = " UPDATE account SET balance = $temp1 WHERE account = $account ";
                $result3 = mysqli_query($con, $sql3);

              // adding amount to receiver account

                $temp2 =$rec_balance + $rec_amount;
                $sql4 = " UPDATE account SET balance = $temp2 where account = $rec_account ";
                $result4 = mysqli_query($con, $sql4);

                if($result4 && $result3){
                    
                    $_SESSION['message'] = "Transaction Successful";

                    // updating last five transaction for sender

                    $sql5 = " SELECT * FROM statement WHERE account = $account ";
                    $res5 = mysqli_query($con, $sql5) or die(mysqli_error($con));
                    $row5 = mysqli_fetch_assoc($res5);
                    //$temp5 = $rec_amount;
                    $fifth = $row5['fifth'];
                    $fourth = $row5['fourth'];
                    $third = $row5['third'];
                    $second = $row5['second'];
                    $first = $row5['first'];

                    $fifth =  $fourth;
                    $fourth = $third;
                    $third = $second;
                    $second = $first;
                    $first = $rec_amount;

                    $sql7 = " UPDATE statement SET first=$first, second=$second, third=$third, fourth=$fourth, fifth=$fifth WHERE account=$account ";
                    $res7 = mysqli_query($con, $sql7) or die(mysqli_error($con));

                    // updating last five transaction for receiver

                    $sql6 = " SELECT * FROM statement WHERE account = $rec_account ";
                    $res6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
                    $row6 = mysqli_fetch_assoc($res6);
                    //$temp6 = $rec_amount;
                    $fifth1 = $row6['fifth'];
                    $fourth1 = $row6['fourth'];
                    $third1 = $row6['third'];
                    $second1 = $row6['second'];
                    $first1 = $row6['first'];

                    $fifth1 =  $fourth1;
                    $fourth1 = $third1;
                    $third1 = $second1;
                    $second1 = $first1;
                    $first1 = $rec_amount;

                    $sql8 = " UPDATE statement SET first=$first1, second=$second1, third=$third1, fourth=$fourth1, fifth=$fifth1 WHERE account=$rec_account ";
                    $res8 = mysqli_query($con, $sql8) or die(mysqli_error($con));

                    // for testing purpose

                   /* echo $first," ",$second," ",$third," ",$fourth," ",$fifth,"\n";

                    echo $first1," ",$second1," ",$third1," ",$fourth1," ",$fifth1,"\n";

                    echo "sender :",$account,"\n";
                    echo "receiver :",$rec_account,"\n";
                    echo "transfer amount :",$rec_amount,"\n"; */

                    $_SESSION['message'] = "Transaction Succesful";

                    header('location:user_account.php');
                }
                else{
                    $_SESSION['message'] = "Transaction Unsucessful";
                    header('location:user_account.php');
                }

            }
            else{
                //echo "Not availabel sufficient amount";
                $_SESSION['message1']="You don't have sufficient amount";
            header('location:transaction.php');
            }


        }
        else{

            //echo "Password is wrong";
            $_SESSION['message1']="Entered Password is wrong";
            header('location:transaction.php');
        }
      }
        else{

          $_SESSION['message1']="Account does not exist";
            header('location:transaction.php');

        }
      }
      else{

        //echo "Sender and receiver account no. cannot be same";
        $_SESSION['message1']="Sender and receiver account no. cannot be same";
            header('location:transaction.php');
        
      }

        
  

      }

    }
?>