<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Request Access</title>

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

                  <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Financial Grant Management System</strong></h1>
                        </div>
                    </div>

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
                        $home = "http://localhost/SE/include/faculty_htm.php";                      


                        if($role != 'Faculty')
                        {
                                ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>Faculty needs to Login first!</p></h1>
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
                           require_once 'Db_connect.php'; 
                           $db = new Db_connect();
                           $conn = $db->connect();

                           if($conn)
                           {

                              $email = $_SESSION["email"];
                              $role = $_SESSION ["role"];
                              $roll = $_SESSION['roll'];
                              $name = $_SESSION['name'];
                                    
                  ?>

                    
                    
                        <div class="row">

                            <div class="col-sm-1">
                            </div>

                            <div class="col-sm-2">
                              <div class="form-box">
                                 <a href="<?php echo $home ?>" class="btn btn-info" role="button"><b>Go Back !</b></a>
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-box">
                              <div class="form-top">
                                 <div class="form-top-left">
                                    <h3>Request Access Permission..!</h3>
                                    <p>Fill in the form to request access permission:</p>
                                 </div>

                               </div>
                               <div class="form-bottom">
                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="registration-form">

                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Roll Number of your fellow</label>
                                            <input type="text" name="accessroll" placeholder="Roll Number of your fellow..." class="form-email form-control" id="form-email">
                                        </div>
                                                                       
                                        <div class="form-group">
                                            <label class="sr-only" for="form-rollnumber">Justification</label>
                                            <textarea class="form-control" rows="3" id="comment" name="justification" placeholder="Justification..."></textarea>
                                        </div>

                           <?php

                                       if(isset($_POST['accessroll']) && isset($_POST['justification']))
                                       {
                                          $errors= array();
                                          $accessroll = $_POST['accessroll'];
                                          $justification = $_POST['justification'];

                                          mysql_select_db('FinancialGrantManagementSystem');

                                          $query1 = "SELECT Role, Status from FinancialGrantManagementSystem.AllUsers where RollNumber = '$accessroll'";
                                          $result1 = mysql_query($query1) or die(mysql_error());
                                          $count = mysql_num_rows($result1); 
                                          $row = mysql_fetch_array($result1);
                                          if($count == 0)
                                          {
                                            $errors[]="Enter a valid Roll Number!";
                                            echo '<span style="color:#ff0000;text-align:center;">*Enter a valid Roll Number!<br></span>';
                                          }

                                          else if($row['Status'] == "Unregistered")
                                          {
                                            $errors[]="This Roll Number is not registered!";
                                            echo '<span style="color:#ff0000;text-align:center;">*This Roll Number is not registered!<br></span>'; 
                                          }

                                          else
                                          {
                                            //$row = mysql_fetch_array($result1);
                                            $accessrole = $row['Role'];

                                            if($accessrole!="MTech" && $accessrole!="PhD")
                                            {
                                              $errors[]="Roll Number should be of M.Tech or PhD only!";
                                              echo '<span style="color:#ff0000;text-align:center;">*Roll Number should be of M.Tech or PhD only!<br></span>';
                                            }
                                          }


                                          if(empty($errors) == true)
                                          {
                                            $query2 = "UPDATE FinancialGrantManagementSystem.AllUsers SET Requester='$roll', Justification='$justification' WHERE RollNumber='$accessroll'";
                                            $result2 = mysql_query($query2) or die(mysql_error());

                                            if($result2)
                                              echo '<span style="color:#368BC1;text-align:center;"><b>Request forwarded to Admin1.</b><br></span>';
                                            else
                                              echo '<span style="color:#ff0000;text-align:center;">*Request cannot be made!<br></span>';
                                          }

                                       }
                           ?>

                                        <br>
                                        
                                    <button type="submit" class="btn" name="sub"><b>Submit !</b></button>
                                </form>
                             </div>
                           </div>
                            </div>

                            <div class="col-sm-3">
                            </div>
                        </div>  
                </div>
            </div>
            
        </div>

<?php

      }
   }
}          
?>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>



