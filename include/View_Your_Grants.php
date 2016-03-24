<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Grants</title> -->

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
      if($role != 'MTech' && $role != 'Faculty' && $role != 'PhD')
      {
          ?>
                  <div class="top-content">

                      <div class="inner-bg">

                          <div class="container">

                              <div class="row">
                                  <div class="col-sm-8 col-sm-offset-2 text">
                                      <br><br><br>
                                      <h1>OOPS..!!<p>Faculty or PhD or MTech needs to Login first!</p></h1>
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
                    require_once 'InstitutePeople.php';

                    $obj = new InstitutePeople($_SESSION['roll'], 1000000, 100000, 100000, 50000);
                    $obj->ViewYourGrants();
                }
            }
        }
    ?>

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

</div>
</div>
</body>
</html>