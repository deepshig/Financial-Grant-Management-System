<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Send Notification</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- This is what you need -->
          <script src="dist/sweetalert-dev.js"></script>
          <link rel="stylesheet" href="dist/sweetalert.css">
        <!--.......................-->


        <link rel="shortcut icon" href="http://ww2.glance.net/wp-content/uploads/2015/01/glance-for-finance.jpg">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            
                <br>
                <div class="container">
                    
                    <?php
                        session_start();
                        if(!isset($_SESSION['role']))
                        {
                            ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>You need to Login!</p></h1>
                                                            <div class="form-box">
                                                                <a href="http://localhost/SE/include/Login.php" class="btn btn-info" role="button"><strong><b>Login !</b></strong></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                        }
                        else
                        {
                            $role = $_SESSION['role'];
                            
                            if($role == 'Admin1')
                                $home = "http://localhost/SE/include/admin1_htm.php";

                            else if($role == 'Admin2')
                                $home = "http://localhost/SE/include/admin2_htm.php";

                            if($role != 'Admin1' && $role != 'Admin2')
                            {
                                ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>Admin1 or Admin2 needs to Login first!</p></h1>
                                                            <div class="form-box">
                                                                <a href="http://localhost/SE/include/logout.php" class="btn btn-info" role="button"><strong><b>Logout !</b></strong></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                            }
                            else
                            {
                    ?>


                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-box">
                                <a href="<?php echo $home ?>" class="btn btn-info" role="button"><strong><b>Go Back to Home Page !</b></strong></a>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-6 text">
                            <h1><strong>Send Notification</strong></h1>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <?php

                                require_once 'Db_connect.php';
                                $db = new Db_connect();
                                $conn = $db->connect();

                                if($conn)
                                {
                                    $grantid = $_SESSION['grantid'];
                                    $to = "NULL";
                                    $subject = "NULL";

                                    if($grantid!=0)
                                    {
                                        mysql_select_db('FinancialGrantManagementSystem');
                                        $query1 = "SELECT RollNumber from FinancialGrantManagementSystem.GrantDetails where GrantID = $grantid";
                                        $query1_result = mysql_query($query1) or die(mysql_error());
                                        $count = mysql_num_rows($query1_result); 
                                        if($count == 1)
                                        {
                                            $row = mysql_fetch_array($query1_result);
                                            $roll = $row['RollNumber'];
                                        }
                                        else
                                            echo "Grant ID is not unique. Mail notification can not be sent. <br>";

                                        $query2 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$roll'";
                                        $query2_result = mysql_query($query2) or die(mysql_error());

                                        $count = mysql_num_rows($query2_result);
                                        if($count == 1)
                                        {
                                            $row = mysql_fetch_array($query2_result);
                                            $email = $row['EmailId'];
                                        }
                                        else
                                            echo "Roll Number not valid. Mail notification cannot be sent. <br>";

                                        $to = $email;
                                        $subject = "Regarding Grant ID : ".$grantid;
                                    }
                                    else
                                    {
                                        $accessroll = $_SESSION['accessroll'];
                                        mysql_select_db('FinancialGrantManagementSystem');
                                        $query3 = "SELECT Requester from FinancialGrantManagementSystem.AllUsers where RollNumber = '$accessroll'";
                                        $result3 = mysql_query($query3) or die(mysql_error());
                                        $row = mysql_fetch_array($result3);
                                        $requester_roll = $row['Requester'];

                                        $query4 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$requester_roll'";
                                        $result4 = mysql_query($query4) or die(mysql_error());

                                        $row = mysql_fetch_array($result4);
                                        $requester_email = $row['EmailId'];

                                        $to = $requester_email;
                                        $subject = "Regarding Recent Access Request";
                                    }                                
                                    

                    ?>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Message</h3>
                                        <p>From : <?php echo $_SESSION['email'] ?><br>To : <?php echo $to ?><br>Subject : <?php echo $subject ?></p>
                                        <p>Enter the message to send:</p>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="" method="post" class="login-form">
                                        <textarea class="form-control" rows="5" id="comment" name="message"></textarea>
                                        <br>
                                        <button type="submit" class="btn" name="send"><b>Send</b></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php

                            $role = $_SESSION ['role'];

                            if(isset($_POST['send']) && isset($_POST['message']))
                            {
                                $grantid = $_SESSION['grantid'];
                                $msg = $_POST['message'];

                                if($grantid!=0)
                                {
                                    mysql_select_db('FinancialGrantManagementSystem');
                                    $query1 = "SELECT RollNumber from FinancialGrantManagementSystem.GrantDetails where GrantID = $grantid";
                                    $query1_result = mysql_query($query1) or die(mysql_error());


                                    $count = mysql_num_rows($query1_result); 
                                    if($count == 1)
                                    {
                                        $row = mysql_fetch_array($query1_result);
                                        $roll = $row['RollNumber'];
                                    }
                                    else
                                        echo "Grant ID is not unique. Mail notification can not be sent. <br>";

                                   $query2 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$roll'";
                                   $query2_result = mysql_query($query2) or die(mysql_error());

                                    $count = mysql_num_rows($query2_result);
                                    if($count == 1)
                                    {
                                        $row = mysql_fetch_array($query2_result);
                                        $email = $row['EmailId'];
                                    }
                                    else
                                        echo "Roll Number not valid. Mail notification cannot be sent. <br>";

                                    $to = $email;
                                    $subject = "Regarding Grant ID : ".$grantid;

                                    if($role == "Admin1")
                                    {
                                        require_once 'admin1.php';
                                        $header = "From : ug201310003@iitj.ac.in";
                                        $obj = new admin1;
                                        $obj->SendNotification($to, $subject, $msg, $header);
                                        //die();
                                    }
                                    else if($role == "Admin2")
                                    {
                                        require_once 'admin2.php'; 
                                        $header = "From : ug201313008@iitj.ac.in";  
                                        $obj = new admin2;
                                        $obj->SendNotification($to, $subject, $msg, $header);
                                        //die();
                                    }
                                }
                                else
                                {
                                    require_once 'admin1.php';
                                    $header = "From : ug201310003@iitj.ac.in";
                                    $obj = new admin1;
                                    $obj->SendNotification($to, $subject, $msg, $header);
                                }

                                
                                //die();
                            }          
                        }
                    }
                }
                    

            ?>

                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>