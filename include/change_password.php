<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password</title>

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

      if($role == 'Faculty')
         $home = "http://localhost/SE/include/faculty_htm.php";

      else if($role == 'MTech')
         $home = "http://localhost/SE/include/mtech_htm.php";

      else if($role == 'PhD')
         $home = "http://localhost/SE/include/phd_htm.php";

      else if($role == 'Admin1')
         $home = "http://localhost/SE/include/admin1_htm.php";

      else if($role == 'Admin2')
         $home = "http://localhost/SE/include/admin2_htm.php";

      {
?>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Financial Grant Management System</strong></h1>
                        </div>
                    </div>
                    
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
                                    <h3>Change Password..</h3>
                                    <p>Fill in the form to change your password:</p>

                        <?php
                                 require_once 'Db_connect.php'; 
                                 $db = new Db_connect();
                                 $conn = $db->connect();

                                 if($conn)
                                 {
                                    $roll = $_SESSION['roll'];
                                    mysql_select_db('FinancialGrantManagementSystem');
                                    $check_query = "SELECT Password from FinancialGrantManagementSystem.AllUsers where RollNumber = '$roll'";
                                    $check_result = mysql_query($check_query) or die(mysql_error());
                                    $row = mysql_fetch_array($check_result);
                                    $password = $row['Password'];                          
    
                                  if(isset($_POST['new']) && isset($_POST['old']))
                                  {
                                    $new = $_POST["new"];
                                    $old = $_POST["old"];
                                    if($old != $password)
                                      echo '<span style="color:#ff0000;text-align:center;">*Your Old Password does not match.<br></span>';
                                    else
                                    {
                                      $update_query = "UPDATE FinancialGrantManagementSystem.AllUsers SET Password='$new' WHERE RollNumber='$roll'";
                                      $update_result = mysql_query($update_query) or die(mysql_error());

                                      if($update_result)
                                        echo '<span style="color:#368BC1;text-align:center;"><b>Password updated successfully!</b><br></span>';

                                      else
                                        echo '<span style="color:#ff0000;text-align:center;">*Sorry! Could not change password!.<br></span>';
                                    }
                                  }

                        ?> 

                                 </div>
                                 <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                 </div>
                               </div>
                               <div class="form-bottom">
                                <form role="form" action="" method="post" class="registration-form">
                                    
                                        <div class="form-group">
                                            <label class="sr-only" for="form-rollnumber">Old Password</label>
                                            <input type="password" name="old" placeholder="Old Password..." class="form-rollnumber form-control" id="form-rollnumber">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">New Password</label>
                                            <input type="password" name="new" placeholder="New Password..." class="form-email form-control" id="form-email">
                                        </div>
                                  
                                        <br>
                                        
                                    <button type="submit" class="btn"><b>Update !</b></button>
                                </form>
                             </div>
                           </div>
                            </div>

                            <div class="col-sm-3">
                            </div>
                        </div>  


                    
                </div>
                <br>
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
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>