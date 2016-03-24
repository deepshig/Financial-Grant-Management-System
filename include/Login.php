<?php
    session_start();
    require_once 'Db_connect.php'; 
    $db = new Db_connect();
    $conn = $db->connect();
 
?>





<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Financial Grant Management System</title>

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

                      if(isset($_SESSION['roll']))
                        {
                                ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>User is already Logged In.</p></h1>
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
                        <div class="col-sm-5">
                          
                          <div class="form-box">
                            <div class="form-top">
                              <div class="form-top-left">
                                <h3>Login</h3>
                                  <p>Enter email_id, password and role to log in:</p>

                      <?php
                                if($conn)
                                {  
                                  if(isset($_POST['login']))
                                  {
                                    if(isset($_POST['email_id']) && isset($_POST['password']) && isset($_POST['role']))
                                    {
                                      $email = $_POST['email_id'];
                                      $pass = $_POST['password'];
                                      $role = $_POST['role'];

                                      /*mysql_select_db('FinancialGrantManagementSystem');
                                      $query = "SELECT RollNumber from FinancialGrantManagementSystem.AllUsers where EmailId='$email' and Role = '$role'";
                                      $result = mysql_query($query) or die(mysql_error());*/

                                       require_once 'user.php';

                                       $obj = new user;

                                       $result = $obj->Login($email, $role);

                                      $count = mysql_num_rows($result); 
                                      if($count == 1)
                                      {
                                        $loginquery = "SELECT RollNumber, Name from FinancialGrantManagementSystem.AllUsers where EmailId='$email' and Password = '$pass' and Status = 'Registered' and Role = '$role'";
                                        $login = mysql_query($loginquery) or die(mysql_error());

                                        $logincount = mysql_num_rows($login);

                                        if($logincount == 1)
                                        {
                                          $_SESSION['email'] = $email;
                                          $_SESSION['password'] = $pass;
                                          $_SESSION['role'] = $role;

                                          $row = mysql_fetch_array($login);

                                          $name = $row['Name'];
                                          $roll = $row['RollNumber'];

                                          $_SESSION['name'] = $name;
                                          $_SESSION['roll'] = $roll;

                                          switch ($_SESSION['role'])
                                          {
                                              case 'Admin1':
                                                            header("location: http://localhost/SE/include/admin1_htm.php");
                                                            break;

                                              case 'Admin2':
                                                            header("location: http://localhost/SE/include/admin2_htm.php");
                                                            break;

                                              case 'Faculty':
                                                            header("location: http://localhost/SE/include/faculty_htm.php");
                                                            break;

                                              case 'PhD':
                                                            header("location: http://localhost/SE/include/phd_htm.php");
                                                            break;

                                              case 'MTech':
                                                            header("location: http://localhost/SE/include/mtech_htm.php");
                                                            break;
                                          
                                              default:
                                                            echo "<h3><strong>Error 404 : Page Not Found</strong></h3>";
                                                            break;

                                          }
                                        }
                                        else
                                          echo '<span style="color:#ff0000;text-align:center;">*User NOT Registered!</span>';
                                      }
                                      else
                                        echo '<span style="color:#ff0000;text-align:center;">*User does not exist.</span>';
                                    }
                                  }
                      ?>


                              </div>
                              <div class="form-top-right">
                                <i class="fa fa-key"></i>
                              </div>
                              </div>
                              <div class="form-bottom">
                            <form role="form" action="" method="post" class="login-form">
                                <div class="form-group">
                                  <label class="sr-only" for="form-email">Email</label>
                                  <input type="email" name="email_id" placeholder="Email..." class="form-email form-control" id="form-email">
                                </div>
                                <div class="form-group">
                                  <label class="sr-only" for="form-password">Password</label>
                                  <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
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
                                <button type="submit" name="login" class="btn"><b>Sign in!</b></button>
                            </form>
                          </div>
                        </div>
                          
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                          
                        <div class="col-sm-5">
                          
                          <div class="form-box">
                            <div class="form-top">
                              <div class="form-top-left">
                                <h3>New User? Register Here</h3>
                                  <p>Fill in the form below to get registered:</p>

                          <?php
                                  if(isset($_POST['register']))
                                  {
                                    if(isset($_POST['email_reg']) && isset($_POST['password_reg']) && isset($_POST['role_reg']) && isset($_POST['roll_reg']) && isset($_POST['name_reg']))
                                     {
                                        $email = $_POST["email_reg"];
                                        $name = $_POST["name_reg"];
                                        $password = $_POST["password_reg"];
                                        $roll = $_POST["roll_reg"];
                                        $role = $_POST["role_reg"];


                                        /*mysql_select_db('FinancialGrantManagementSystem');
                                        $check_query = "SELECT * from FinancialGrantManagementSystem.AllUsers where EmailId = '$email' and Role = '$role' and RollNumber = '$roll' and Status = 'Unregistered'";
                                        $check_result = mysql_query($check_query) or die(mysql_error());*/

                                        require_once 'user.php';
                                        $obj = new user;
                                        $check_result = $obj->Register($email, $role, $roll);


                                        if(mysql_num_rows($check_result) == 1)
                                        {
                                           $update_query = "UPDATE FinancialGrantManagementSystem.AllUsers SET Name = '$name',Status = 'Registered',Password = '$password' WHERE EmailId = '$email' and Role = '$role' and RollNumber = '$roll'";
                                           $update_result = mysql_query($update_query) or die(mysql_error());

                                            echo '<span style="color:#368BC1;text-align:center;"><b>Registered Successfully!</b></span>';
                                        }
                                        else
                                        {
                                           $exist_query = $check_query = "SELECT * from FinancialGrantManagementSystem.AllUsers where EmailId = '$email' and Role = '$role' and RollNumber = '$roll' and Status = 'Registered'";
                                           $exit_result = mysql_query($exist_query) or die(mysql_error());

                                           if(mysql_num_rows($exit_result) == 1)
                                              echo '<span style="color:#ff0000;text-align:center;">*User already registered!</span>';

                                           else
                                              echo '<span style="color:#ff0000;text-align:center;">*Invalid Details!</span>';
                                        }
                                           
                                     }
                                     else
                                        echo '<span style="color:#ff0000;text-align:center;">*Enter all the mandatory details!</span>';
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
                                <label class="sr-only" for="form-name">Name</label>
                                <input type="text" name="name_reg" placeholder="Name..." class="form-name form-control" id="form-name">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-email">Email</label>
                                <input type="email" name="email_reg" placeholder="Email..." class="form-email form-control" id="form-email">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-rollnumber">Roll Number</label>
                                <input type="text" name="roll_reg" placeholder="Roll Number..." class="form-rollnumber form-control" id="form-rollnumber">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="password_reg" placeholder="Password..." class="form-password form-control" id="form-password">
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="form-role">Role</label>
                                  <select class="form-control" id="sel1" name="role_reg">
                                    <option hidden >Role...</option>
                                    <option>Admin1</option>
                                    <option>Admin2</option>
                                    <option>Faculty</option>
                                    <option>PhD</option>
                                    <option>MTech</option>
                                  </select>
                              </div>
                              <button type="submit" name="register" class="btn"><b>Register me !</b></button>
                            </form>
                          </div>
                          </div>
                          
                        </div>
                    </div>
                    
                </div>
            <br>
            
        </div>

        <?php
      }
    else
      echo "<h3><strong>Database not found!</strong></h3>";

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

