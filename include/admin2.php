<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin2</title>

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

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>




<?php

require_once 'Db_connect.php';
$db = new Db_connect();
$conn = $db->connect();
mysql_select_db('FinancialGrantManagementSystem');

if($conn)
{
    class admin2
	{
		function __construct ()
		{

		}

		function __destruct ()
		{

		}

		public function ViewNewRequest()
		{
            if(isset($_POST['noti']) || isset($_POST['verify']) || isset($_POST['reject']))
               {
                    $grantid = $_POST['grantid'];

                    if(isset($_POST['noti']))
                    {  
                        $_SESSION['grantid'] = $grantid;
                        header('Location: http://localhost/SE/include/Send_Notification.php');
                        die();
                    }

                    else if(isset($_POST['verify']))
                    {
                        //$obj = new admin2;
                        $this->Verify($grantid);
                    }

                    else if(isset($_POST['reject']))
                    {
                        //$obj1 = new admin2;
                        $this->Reject($grantid);
                    }
               }

               //mysql_select_db('FinancialGrantManagementSystem');

               $newRequest_query = "SELECT RollNumber, Type, Justification, AmountRequested, RequestDate, GrantID from FinancialGrantManagementSystem.GrantDetails where GrantStatus = 'Pending'";
               $newRequest_result = mysql_query($newRequest_query) or die(mysql_error());

               $count = mysql_num_rows($newRequest_result); 
               if($count >= 1)
                {

    ?>

                    <div class="top-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-box">
                                            <a href="http://localhost/SE/include/admin2_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-6 text">
                                        <h1><strong>All New Requests</strong></h1>
                                    </div>
                                    <div class="col-sm-3">   
                                    </div>
                                </div>
                                
                            </div>    
                    </div>
                    <br>
                    <div class="container">
                    <div class="row">

    <?php
                    while($row = mysql_fetch_array($newRequest_result))
                    {

                        $grantid = $row['GrantID'];
?>

                        <div class="col-sm-7">
                                <div class="form-top">
                                    <form role="form" action="" method="post" class="login-form">
                                        <h3>Grant ID : <input  name="grantid" type="text" value="<?php echo $row["GrantID"]; ?>"readonly/></h3>
                                        <p>Roll Number : <?php echo $row["RollNumber"]; ?><br>
                                        Type of Grant Requested : <?php echo $row["Type"]; ?><br>
                                        Justification Given : <?php echo $row["Justification"]; ?><br>
                                        Amount Requested : Rs. <?php echo $row["AmountRequested"]; ?><br>
                                        Date of Request : <?php echo $row["RequestDate"]; ?></p>
                                            <button type="submit" class="btn" name="noti"><b>Send Notification</b></button>
                                            <button type="submit" class="btn" name="verify"><b>Verify</b></button>
                                            <button type="submit" class="btn" name="reject"><b>Reject</b></button>
                                    </form>

                                </div>
                                <br>
                        </div>
            <?php   } ?>

        </div>
    </div>

    <?php                
                }   
               else
               {
    ?>
                <div class="top-content">
                        <div class="inner-bg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 text">
                                        <h1><strong>No Requests!</strong></h1>
                                    </div>
                                </div>
                                <div class="form-box">
                                    <a href="http://localhost/SE/include/admin2_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php           }
               
		}

		public function Verify($grantid)
		{
			$verify_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='Admin2_Approved' WHERE GrantID=$grantid";
            $verify_result = mysql_query($verify_query) or die(mysql_error());

            if($verify_result)
            {
                        ?>
                                <script>
                                    swal({
                                          title: "Grant Forwarded to Admin1 for Final Verification.",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                        <?php
            }
            else
            {
                        ?>
                                <script>
                                    swal({
                                          title: "Grant could not be verified!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                        <?php
            }

		}

        public function Accept_Bills($grantid)
        {
            $accept_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='Settled' ,SettlementDate=CURDATE() WHERE GrantID=$grantid";
            $accept_result = mysql_query($accept_query) or die(mysql_error());

            if($accept_result)
            {
                ?>
                                <script>
                                    swal({
                                          title: "Grant Settled",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                <?php

                $query1 = "SELECT RollNumber from FinancialGrantManagementSystem.GrantDetails where GrantID = $grantid";
                $query1_result = mysql_query($query1) or die(mysql_error());


                $count = mysql_num_rows($query1_result); 
                if($count == 1)
                {
                    $row = mysql_fetch_array($query1_result);
                    $roll = $row['RollNumber'];
                }
                else
                    echo "<h1><strong>Grant ID is not unique. Mail notification can not be sent.</strong></h1> <br>";
                $query2 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$roll'";
                $query2_result = mysql_query($query2) or die(mysql_error());

                $count = mysql_num_rows($query2_result);
                if($count == 1)
                {
                    $row = mysql_fetch_array($query2_result);
                    $email = $row['EmailId'];
                }
                else
                    echo "<h1><strong>Roll Number not valid. Mail notification cannot be sent.</strong></h1> <br>";

                $to = $email;
                $subject = "Grant Settled";
                $message = "This is to inform you that your grant number " . $grantid . " has been settled. Your bills have been accepted.";
                $header = "From : ug201313008@iitj.ac.in";

                $this->SendNotification($to, $subject, $message, $header);
            }
            else
                echo "<h1><strong>Grant could not be settled!</strong></h1>";

        }

		public function Reject($grantid)
		{
			$reject_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='Admin2_Rejected' WHERE GrantID=$grantid";
            $reject_result = mysql_query($reject_query) or die(mysql_error());

            if($reject_result)
            {
                
                ?>
                                <script>
                                    swal({
                                          title: "Grant Rejected!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                <?php

                $query1 = "SELECT RollNumber from FinancialGrantManagementSystem.GrantDetails where GrantID = $grantid";
                $query1_result = mysql_query($query1) or die(mysql_error());


               $count = mysql_num_rows($query1_result); 
               if($count == 1)
                {
                    $row = mysql_fetch_array($query1_result);
                    $roll = $row['RollNumber'];
                }
                else
                    echo "<h1><strong>Grant ID is not unique. Mail notification can not be sent.</strong></h1> <br>";

                $query2 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$roll'";
                $query2_result = mysql_query($query2) or die(mysql_error());

                $count = mysql_num_rows($query2_result);
                if($count == 1)
                {
                    $row = mysql_fetch_array($query2_result);
                    $email = $row['EmailId'];
                }
                else
                    echo "<h1><strong>Roll Number not valid. Mail notification cannot be sent.</strong></h1> <br>";

                $to = $email;
                $subject = "Grant Rejected";
                $message = "This is to inform you that your grant number " . $grantid . " has been rejected.";
                $header = "From : ug201313008@iitj.ac.in";

                $this->SendNotification($to, $subject, $message, $header);
            }
            else
                echo "<h1><strong>Grant could not be rejected!</strong></h1>";
		}

		public function SendNotification($to, $subject, $message, $header)
		{
?>
            <div class="col-sm-6">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sent Message</h3>
                            <p><?php echo $header ?><br>To : <?php echo $to ?><br>Subject : <?php echo $subject ?></p>
                            <p>Message :<?php echo $message ?></p>

                            <?php
                                $retval = mail ($to,$subject,$message,$header);
         
                                if( $retval == true ) 
                                    echo '<span style="color:#368BC1;text-align:center;"><b>Message sent successfully...!!</b></span>';
            
                                else 
                                    echo '<span style="color:#ff0000;text-align:center;">*Message could not be sent...!</span>';
                            ?>

                        </div>
                    </div>
                </div>
                
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
            
<?php
            
        }

        public function ViewSettlementRequest()
        {
            if(isset($_POST['noti']) || isset($_POST['verify']) || isset($_POST['link']))
               {
                    $grantid = $_POST['grantid'];

                    if(isset($_POST['noti']))
                    {  
                        $_SESSION['grantid'] = $grantid;
                        header('Location: http://localhost/SE/include/Send_Notification.php');
                        die();
                    }

                    else if(isset($_POST['verify']))
                    {
                        //$obj = new admin2;
                        $this->Accept_Bills($grantid);
                    }

                    else if(isset($_POST['link']))
                    {
                        $var_1 = $_POST['link'];  
                        $dir = "/opt/lampp/temp/testupload/";                        
                        $file = $dir . $var_1;
                        
                        if (file_exists($file))
                        {
                            header('Content-Description: File Transfer');
                            header('Content-Type: application/octet-stream');
                            header('Content-Disposition: attachment; filename='.basename($file));
                            header('Expires: 0');
                            header('Cache-Control: must-revalidate');
                            header('Pragma: public');
                            header('Content-Length: ' . filesize($file));
                            ob_clean();
                            flush();
                            readfile($file);
                            exit;
                        }
                    }
                }

               $settlementRequest_query = "SELECT RollNumber, Type, Justification, AmountRequested, AmountApproved, ApprovalDate, RequestDate, GrantID from FinancialGrantManagementSystem.GrantDetails where GrantStatus = 'SettlementRequest'";
               $settlementRequest_result = mysql_query($settlementRequest_query) or die(mysql_error());

               $count = mysql_num_rows($settlementRequest_result); 
               if($count >= 1)
                {

    ?>

                    <div class="top-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-box">
                                            <a href="http://localhost/SE/include/admin2_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-6 text">
                                        <h1><strong>All Settlement Requests</strong></h1>
                                    </div>
                                    <div class="col-sm-3">   
                                    </div>
                                </div>
                                
                            </div>    
                    </div>
                    <br>
                    <div class="container">
                    <div class="row">

    <?php

                    while($row = mysql_fetch_array($settlementRequest_result))
                    {

                        $grantid = $row['GrantID'];
                        $amtapproved = $row['AmountApproved'];
                        $link = "http://localhost/SE/testupload/".$grantid.".zip";
    ?>

                        <div class="col-sm-7">
                                <div class="form-top">
                                    <form role="form" action="" method="post" class="login-form">
                                        <h3>Grant ID : <input  name="grantid" type="text" value="<?php echo $row["GrantID"]; ?>"readonly/></h3>
                                        <p>Roll Number : <?php echo $row["RollNumber"]; ?><br>
                                        Type of Grant Requested : <?php echo $row["Type"]; ?><br>
                                        Justification Given : <?php echo $row["Justification"]; ?><br>
                                        Amount Requested : Rs. <?php echo $row["AmountRequested"]; ?><br>
                                        Amount Approved : Rs. <?php echo $row["AmountApproved"]; ?><br>
                                        Date of Request : <?php echo $row["RequestDate"]; ?><br>
                                        Date of Approval : <?php echo $row["ApprovalDate"]; ?></p>
                                            <a href='<?php echo $link ?>'>Download bills here</a><br><br>
                                            <button type="submit" class="btn" name="noti"><b>Send Notification</b></button>
                                            <button type="submit" class="btn" name="verify"><b>Verify</b></button>
                                    </form>

                                </div>
                                <br>
                        </div>
            <?php   } ?>
        </div>
        </div>
       
<?php                
                }   
               else
               {
?>
                    <div class="top-content">
                        <div class="inner-bg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 text">
                                        <h1><strong>No Requests!</strong></h1>
                                    </div>
                                </div>
                                <div class="form-box">
                                    <a href="http://localhost/SE/include/admin2_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php           }

            
        }
	}
}
?>