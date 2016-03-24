<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin1</title>

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

if($conn)
{
	class admin1  
	{
		function __construct ()
		{

		}

		function __destruct ()
		{

		}

		public function ViewAllRequests()
		{
			if(isset($_POST['noti']) || isset($_POST['accept']) || isset($_POST['reject']))
               {
                    $grantid = $_POST['grantid'];
                    $amtapproved = $_POST['amtapproved'];
                    if(isset($_POST['noti']))
                    {   
                        $_SESSION['grantid'] = $grantid;
                        header('Location: http://localhost/SE/include/Send_Notification.php');
                        die();
                    }

                    else if(isset($_POST['accept']) && $_POST['amtapproved']!=NULL)
                    {
                        $obj = new admin1;
                        $obj->ApproveRequest($grantid, $amtapproved);
                    }

                    else if(isset($_POST['reject']))
                    {
                        $obj1 = new admin1;
                        $obj1->RejectRequest($grantid);
                    }
               }

               mysql_select_db('FinancialGrantManagementSystem');

               $allRequest_query = "SELECT RollNumber, Type, Justification, AmountRequested, RequestDate, GrantID from FinancialGrantManagementSystem.GrantDetails where GrantStatus = 'Admin2_Approved'";
               $allRequest_result = mysql_query($allRequest_query) or die(mysql_error());

               $count = mysql_num_rows($allRequest_result); 
               if($count >= 1)
                {

    ?>

                    <div class="top-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-box">
                                            <a href="http://localhost/SE/include/admin1_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-6 text">
                                        <h1><strong>All Grant Requests</strong></h1>
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

                    while($row = mysql_fetch_array($allRequest_result))
                    {
                        $grantid = $row['GrantID'];
?>
                        
                        <div class="col-sm-7">
                                <div class="form-top">
                                    <form role="form" action="" method="post" >
                                        <h3>Grant ID : <input  name="grantid" type="text" value="<?php echo $row["GrantID"]; ?>"readonly/></h3>
                                        <p>Roll Number : <?php echo $row["RollNumber"]; ?><br>
                                        Type of Grant Requested : <?php echo $row["Type"]; ?><br>
                                        Justification Given : <?php echo $row["Justification"]; ?><br>
                                        Amount Requested : Rs. <?php echo $row["AmountRequested"]; ?><br>
                                        Date of Request : <?php echo $row["RequestDate"]; ?></p>
                                        <h3>Approved Amount : <input  class="form-control" name="amtapproved" type="number" placeholder="Enter approved amount..." min='1' max=<?php echo $row["AmountRequested"]; ?>></h3>
                                            <button type="submit" class="btn" name="noti"><b>Send Notification</b></button>
                                            <button type="submit" class="btn" name="accept"><b>Accept</b></button>
                                            <button type="submit" class="btn" name="reject"><b>Reject</b></button>
                                    </form>
                                </div>
                                <br>
                        </div>
               
                   <?php } ?>
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
                                    <a href="http://localhost/SE/include/admin1_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<?php           }


        }

        public function ViewAllAccessRequests()
        {
            if(isset($_POST['noti']) || isset($_POST['accept']) || isset($_POST['reject']))
               {
                    $accessroll = $_POST['accessroll'];
                    if(isset($_POST['noti']))
                    {   
                        $_SESSION['grantid'] = 0;
                        $_SESSION['accessroll'] = $accessroll;
                        header('Location: http://localhost/SE/include/Send_Notification.php');
                        die();
                    }

                    else if(isset($_POST['accept']))
                    {
                        ?>
                                <script>
                                    swal({
                                          title: "Access Request Accepted!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                        <?php
                        mysql_select_db('FinancialGrantManagementSystem');

                        $query3 = "SELECT Requester from FinancialGrantManagementSystem.AllUsers where RollNumber = '$accessroll'";
                        $result3 = mysql_query($query3) or die(mysql_error());
                        $row = mysql_fetch_array($result3);
                        $requester_roll = $row['Requester'];

                        $update_query = "UPDATE FinancialGrantManagementSystem.AllUsers SET Accessor='$requester_roll', Requester=NULL, Justification=NULL WHERE RollNumber='$accessroll'";
                        $update_result = mysql_query($update_query) or die(mysql_error());

                        if($update_result)
                        {
                            $query4 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$requester_roll'";
                            $result4 = mysql_query($query4) or die(mysql_error());

                            $row = mysql_fetch_array($result4);
                            $requester_email = $row['EmailId'];

                            $subject = "Recent Access Request Approved";
                            $message = "Your Request to access the grant log of ".$accessroll." has been approved. You can now access it.";
                            $header = "From : ug201310003@iitj.ac.in";

                            $this->SendNotification($requester_email, $subject, $message, $header);
                        }
                        else
                        {
                            ?>
                                <script>
                                    sweetAlert("Access Request cannot be Approved!");
                                </script>

                            <?php
                        }

                    }

                    else if(isset($_POST['reject']))
                    {
                        mysql_select_db('FinancialGrantManagementSystem');

                        $query3 = "SELECT Requester from FinancialGrantManagementSystem.AllUsers where RollNumber = '$accessroll'";
                        $result3 = mysql_query($query3) or die(mysql_error());
                        $row = mysql_fetch_array($result3);
                        $requester_roll = $row['Requester'];
                        
                        $reject_query = "UPDATE FinancialGrantManagementSystem.AllUsers SET Requester=NULL, Justification=NULL WHERE RollNumber='$accessroll'";
                        $reject_result = mysql_query($reject_query) or die(mysql_error());

                        if($reject_result)
                        {
                            ?>
                                <script>
                                    swal({
                                          title: "Access Request Rejected!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                            <?php
                            $query4 = "SELECT EmailId from FinancialGrantManagementSystem.AllUsers where RollNumber = '$requester_roll'";
                            $result4 = mysql_query($query4) or die(mysql_error());

                            $row = mysql_fetch_array($result4);
                            $requester_email = $row['EmailId'];

                            $subject = "Recent Access Request Rejected";
                            $message = "Your Request to access the grant log of ".$accessroll." has been rejected.";
                            $header = "From : ug201310003@iitj.ac.in";

                            $this->SendNotification($requester_email, $subject, $message, $header);
                        }
                        else
                        {
                            ?>
                                <script>
                                    sweetAlert("Access Request cannot be Rejected!");
                                </script>

                            <?php
                        }
                    }
               }

               mysql_select_db('FinancialGrantManagementSystem');

               $query = "SELECT RollNumber, Name, Justification, Role, Accessor, Requester from FinancialGrantManagementSystem.AllUsers where Requester IS NOT NULL";
               $result = mysql_query($query) or die(mysql_error());

               $count = mysql_num_rows($result); 
               if($count >= 1)
                {

    ?>

                    <div class="top-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-box">
                                            <a href="http://localhost/SE/include/admin1_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-6 text">
                                        <h1><strong>All Access Requests</strong></h1>
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

                    while($row = mysql_fetch_array($result))
                    {
                        $accessroll = $row['RollNumber'];
?>
                        
                        <div class="col-sm-7">
                                <div class="form-top">
                                    <form role="form" action="" method="post" >
                                        <h3>Roll Number of Fellow : <input  name="accessroll" type="text" value="<?php echo $row["RollNumber"]; ?>"readonly/></h3>
                                        <p> Name of Fellow : <?php echo $row["Name"]; ?><br>
                                            Role of Fellow : <?php echo $row["Role"]; ?><br>
                                            Requester : <?php echo $row["Requester"]; ?><br>                                            
                                            Justification Given : <?php echo $row["Justification"]; ?><br>
                                            Current Accessor : <?php echo $row["Accessor"]; ?></p>
                        
                                            <button type="submit" class="btn" name="noti"><b>Send Notification</b></button>
                                            <button type="submit" class="btn" name="accept"><b>Accept</b></button>
                                            <button type="submit" class="btn" name="reject"><b>Reject</b></button>
                                    </form>
                                </div>
                                <br>
                        </div>
               
                   <?php } ?>
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
                                    <a href="http://localhost/SE/include/admin1_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<?php           }


        }

	

		public function ApproveRequest($grantid, $amtapproved)
		{
            $approve_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET AmountApproved=$amtapproved, ApprovalDate=CURDATE(), GrantStatus='Unsettled' WHERE GrantID=$grantid";
            $approve_result = mysql_query($approve_query) or die(mysql_error());

            if($approve_result)
            {
                ?>
                                <script>
                                    swal({
                                          title: "Grant Approved Successfully.!",
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
                $subject = "Grant Approved";
                $message = "This is to inform you that your grant number " . $grantid . " has been approved for amount of Rs. " . $amtapproved . ".";
                $header = "From : ug201310003@iitj.ac.in";

                $this->SendNotification($to, $subject, $message, $header);
            }
            else
                echo "Grant could not be approved!";
		}

		public function RejectRequest($grantid)
		{ 
            $reject_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='Admin1_Rejected' WHERE GrantID=$grantid";
            $reject_result = mysql_query($reject_query) or die(mysql_error());

            if($reject_result)
            {
                    ?>
                                <script>
                                    swal({
                                          title: "Grant Rejected Successfully.!",
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
                    $subject = "Grant Rejected";
                    $message = "This is to inform you that your grant number " . $grantid . " has been rejected.";
                    $header = "From : ug201310003@iitj.ac.in";


                    $this->SendNotification($to, $subject, $message, $header);
            }
            else
                echo "Grant could not be rejected!";
		}



		public function AddUser($email, $role, $roll)
		{
				mysql_select_db('FinancialGrantManagementSystem');

    			$check_query = "SELECT * from FinancialGrantManagementSystem.AllUsers where RollNumber='$roll' or EmailId='$email'";
    			$check_result = mysql_query($check_query) or die(mysql_error());

    			if(mysql_num_rows($check_result) > 0)
                    echo '<span style="color:#ff0000;text-align:center;">*User already exists!</span>';
    			else
    			{
    				$insert_query = "INSERT INTO FinancialGrantManagementSystem.AllUsers(RollNumber, Name, EmailId, Role, Status, Password) VALUES ('$roll', NULL, '$email', '$role', 'Unregistered',NULL)";
        			$insert_result = mysql_query($insert_query);

        			if(!$insert_result)
        				die('Could not enter data: ' . mysql_error());
        			else
                        echo '<span style="color:#368BC1;text-align:center;"><b>User Added Successfully!!</b></span>';
			    }
		}

		public function DeleteUser($email, $role, $roll)
		{
			mysql_select_db('FinancialGrantManagementSystem');

    		$check_query = "SELECT * from FinancialGrantManagementSystem.AllUsers where RollNumber='$roll' and EmailId='$email' and Role='$role'";
    		$check_result = mysql_query($check_query) or die(mysql_error());

    		if(mysql_num_rows($check_result) == 0)
                echo '<span style="color:#ff0000;text-align:center;">*User does not exist!</span>';

    		else
    			{
    				$delete_query = "DELETE FROM FinancialGrantManagementSystem.AllUsers where RollNumber='$roll' and EmailId='$email' and Role='$role'";
        			$delete_result = mysql_query($delete_query);

        			if(!$delete_result)
        				die('Could not delete user ' . mysql_error());
        			else
                        echo '<span style="color:#368BC1;text-align:center;"><b>User Deleted Successfully!!</b></span>';
    			}

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
	}
}

?>
