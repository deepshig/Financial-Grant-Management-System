<?php
require_once 'InstitutePeople.php';
require_once 'Db_connect.php';
$db = new Db_connect();
$conn = $db->connect();

if($conn)
{
	class Faculty extends InstitutePeople
	{
		//private $ResearchFellows;

		function __construct($roll)
		{
			parent :: __construct($roll, 1000000, 50000, 100000, 50000);
			//$this->ResearchFellows = $resfellow;
		}

		function __destruct()
		{

		}

		function AccessPermission()
		{

		}

		function AccessGrants()
		{
			$email = $_SESSION["email"];
            $role = $_SESSION ["role"];
            $roll = $_SESSION['roll'];
            $name = $_SESSION['name'];

            $home = "http://localhost/SE/include/faculty_htm.php";

	        mysql_select_db('FinancialGrantManagementSystem');

	        $query1 = "SELECT RollNumber from FinancialGrantManagementSystem.AllUsers where Accessor = '$roll'";
            $result1 = mysql_query($query1) or die(mysql_error());
            $count = mysql_num_rows($result1);

            if($count>=1)
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
		                

		<?php

            	while($row1 = mysql_fetch_array($result1))
            	{
            		$input = $row1['RollNumber'];
            		$query2 = "SELECT Type, Justification, AmountRequested, AmountApproved, RequestDate, ApprovalDate, SettlementDate, GrantStatus, GrantID, RollNumber from FinancialGrantManagementSystem.GrantDetails where RollNumber='$input'";
			       	$result2 = mysql_query($query2) or die(mysql_error());

			       	$count1 = mysql_num_rows($result2);


		            
			        if($count1 >= 1)
			            {


		                while($row = mysql_fetch_array($result2))
		                {

		?>
							<div class="container">
		                	<div class="row">
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

		                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><b>Print</b></button>
		                                            <div class="container">
		                                              <div class="modal fade" id="myModal" role="dialog">
		                                                <div class="modal-dialog">
		                                                  <div class="modal-content">
		                                                    <div class="modal-body">
		                                                       
		                                                                <h3>Printing the Grant..!!</h3>
		                                                         
		                                                    </div>
		                                                  </div> 
		                                                </div>
		                                              </div>  
		                                            </div>
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
		      } ?>

		        <br>

		<?php
            	}

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
		<?php 

            	
			}
		}
   }
}

?>