


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

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">

                    <?php
                        session_start();
                        if(!isset($_SESSION['roll']))
                        {
                                ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>NO User is Logged In.</p></h1>
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
                    ?>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>User Successfully Logged OUT!!</strong></h1>
                    	</div>
                    </div>
                    

					<div class="row">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-8">
							<div class="form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h3>Name : <?php echo $_SESSION['name']?></h3>
									<h3>Roll Number : <?php echo $_SESSION['roll']?></h3>
									<h3>Email Id : <?php echo $_SESSION['email']?></h3>
									<h3>Role : <?php echo $_SESSION['role']?></h3>
								</div>
							</div>
							</div>
						</div>
						<div class="col-sm-2">
						</div>
					</div>
				</div>
			</div>
		</div>

					<?php

                            require_once 'user.php';
                            $obj = new user;
                            $obj->Logout();
                        }
					?>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        

    </body>

</html>