<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Institute People</title>

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
require_once 'Limits.php';
require_once 'user.php';

require_once 'Db_connect.php';
$db = new Db_connect();
$conn = $db->connect();

if($conn)
{

	class InstitutePeople extends user
	{
		var $RollNumber;
		var $limit;

		function __construct($roll, $res, $ta, $med, $oth)
		{
			$this->limit = new Limits($res, $ta, $med, $oth);
			$this->RollNumber = $roll;
		}

		function __destruct()
		{

		}

		function RequestGrant($roll, $type, $justification, $amtrequested)
		{
			mysql_select_db('FinancialGrantManagementSystem');

            $grant_query = "INSERT INTO FinancialGrantManagementSystem.GrantDetails (RollNumber, Type, Justification, AmountRequested, AmountApproved, RequestDate, ApprovalDate, SettlementDate, GrantStatus) VALUES ('$roll', '$type', '$justification', '$amtrequested', NULL, CURDATE(), NULL, NULL, 'Pending')";
            $grant_result = mysql_query($grant_query);

            if(!$grant_result)
                die('Could not enter data: ' . mysql_error());
            else
                echo '<span style="color:#368BC1;text-align:center;"><b>Grant Requested Successfully!!</b></span>';
		}

		function ViewYourGrants()
		{
				$email = $_SESSION["email"];
                $role = $_SESSION ["role"];
                $roll = $_SESSION['roll'];
                $name = $_SESSION['name'];

                if($role == 'Faculty')
                    $home = "http://localhost/SE/include/faculty_htm.php";

                else if($role == 'MTech')
                    $home = "http://localhost/SE/include/mtech_htm.php";

                else if($role == 'PhD')
                    $home = "http://localhost/SE/include/phd_htm.php";

                if(isset($_POST['print']) || isset($_POST['cancel']) || isset($_POST['settle']))
                {
                    $grantid = $_POST['grantid'];
                    $_SESSION['grantid'] = $grantid;    

                    if(isset($_POST['cancel']))
                    {   

                        mysql_select_db('FinancialGrantManagementSystem');

                        $cancel_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='Cancelled' WHERE GrantID=$grantid";
                        $cancel_result = mysql_query($cancel_query) or die(mysql_error());

                        if(!$cancel_result)
                            die('Could not cancel the grant : ' . mysql_error());
                        else
                        {
                            ?>
                                <script>
                                    swal({
                                          title: "Grant Successfully Cancelled..!!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                            <?php
                        }
                        
                    }

                    else if(isset($_POST['settle']))
                    {   
                        header('Location: http://localhost/SE/include/Settle_Grant.php');
                        die();
                    }
                    else if(isset($_POST['print']))
                    {
                        ?>
                                <script>
                                    swal({
                                          title: "Printing the grant..!!",
                                          timer: 2000,
                                          showConfirmButton: false,
                                          html: true
                                        });
                                    
                                </script>

                        <?php
                    }
               }

    	       mysql_select_db('FinancialGrantManagementSystem');

    	       $allgrants_query = "SELECT Type, Justification, AmountRequested, AmountApproved, RequestDate, ApprovalDate, SettlementDate, GrantStatus, GrantID, RollNumber from FinancialGrantManagementSystem.GrantDetails where RollNumber = '$roll'";
    	       $allgrants_result = mysql_query($allgrants_query) or die(mysql_error());

    	       $count = mysql_num_rows($allgrants_result); 
               if($count >= 1)
                {

    ?>

                    <div class="top-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-box">
                                            <a href="<?php echo $home ?>" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-6 text">
                                        <h1><strong>All Requests</strong></h1>
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
                    while($row = mysql_fetch_array($allgrants_result))
                    {

    ?>

                        <div class="col-sm-7">
                                <div class="form-top">
                                    <form role="form" action="" method="post" class="form-horizontal">
                                        <h3>Grant ID : <input  name="grantid" type="text" value="<?php echo $row["GrantID"]; ?>"readonly/></h3>
                                        <p>Roll Number : <?php echo $row["RollNumber"]; ?><br>
                                        Type of Grant Requested : <?php echo $row["Type"]; ?><br>
                                        Justification Given : <?php echo $row["Justification"]; ?><br>
                                        Amount Requested : Rs. <?php echo $row["AmountRequested"]; ?><br>
                                        Amount Approved : Rs. <?php echo $row["AmountApproved"]; ?><br>
                                        Date of Request : <?php echo $row["RequestDate"]; ?><br>
                                        Date of Approval : <?php echo $row["ApprovalDate"]; ?></br>
                                        Date of Settlement : <?php echo $row["SettlementDate"]; ?></br>
                                        Grant Status : <?php echo $row["GrantStatus"]; ?></p>
                    <?php
                                                if($row['GrantStatus'] == 'Pending')
                                                {

                    ?>
                                                    <button type="submit" class="btn" name="cancel"><b>Cancel Grant</b></button>
                    <?php
                                                }
                    
                                                else if($row['GrantStatus'] == 'Unsettled')
                                                {
                    ?>
                                                    <button type="submit" class="btn" name="settle"><b>Settle Grant</b></button>
                    <?php
                                                } 
                    ?>                        
                                                
                                                <button type="submit" class="btn" name="print"><b>Print</b></button>
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
                                        <h1><strong>No Grants!</strong></h1>
                                    </div>
                                </div>
                                <div class="form-box">
                                    <a href="<?php echo $home ?>" class="btn btn-info" role="button"><b>Go Back !</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php           } ?>

            <br>

<?php

        }
 
	}
}
?>