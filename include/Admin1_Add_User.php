<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add User</title>

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
      if($role != 'Admin1')
      {
        ?>
                  <div class="top-content">

                      <div class="inner-bg">

                          <div class="container">

                              <div class="row">
                                  <div class="col-sm-8 col-sm-offset-2 text">
                                      <br><br><br>
                                      <h1>OOPS..!!<p>Admin1 needs to Login first!</p></h1>
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
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Financial Grant Management System</strong></h1>
                        </div>
                    </div>
                    
                        <div class="row">

                            <div class="col-sm-1">
                            </div>

                            <div class="col-sm-2">
                              <div class="form-box">
                                 <a href="http://localhost/SE/include/admin1_htm.php" class="btn btn-info" role="button"><b>Go Back !</b></a>
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-box">
                              <div class="form-top">
                                 <div class="form-top-left">
                                    <h3>Add New User..</h3>
                                    <p>Fill in the form to add a new user to database:</p>

                        <?php

                                  require_once 'admin1.php'; 
    
                                  if(isset($_POST['email']) && isset($_POST['role']) && isset($_POST['roll']))
                                  {
                                    $email = $_POST["email"];
                                    $roll = $_POST["roll"];
                                    $role = $_POST["role"];

                                    if($role == "Role...")
                                    {
                                      echo '<span style="color:#ff0000;text-align:center;">*Select a valid role.</span>';
                                    }
                                    else
                                    {
                                        $obj = new admin1;

                                        $obj->AddUser($email, $role, $roll);
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
                                            <label class="sr-only" for="form-rollnumber">Roll Number</label>
                                            <input type="text" name="roll" placeholder="Roll Number..." class="form-rollnumber form-control" id="form-rollnumber">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="email" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-role">Role</label>
                                                <select class="form-control" id="sel1" name="role">
                                                    <option hidden >Role...</option>
                                                    <option>Admin1</option>
                                                    <option>Admin2</option>
                                                    <option>Faculty</option>
                                                    <option>PhD</option>
                                                    <option>MTech</option>
                                                </select>
                                        </div>
                                        <br>
                                        
                                    <button type="submit" class="btn"><b>Add User !</b></button>
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