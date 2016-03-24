<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MTech</title>

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
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8 text">
                            <h1><strong>Financial Grant Management System<br><br>MTech Home</strong></h1>
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
                            if($role != 'MTech')
                            {
                                ?>
                                        <div class="top-content">
            
                                            <div class="inner-bg">

                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-8 col-sm-offset-2 text">
                                                            <br><br><br>
                                                            <h1>OOPS..!!<p>MTech needs to Login first!</p></h1>
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

                        <div class="col-sm-2">
                            <br><br>
                            <div class="form-box">
                                 <a href="http://localhost/SE/include/logout.php" class="btn btn-info" role="button"><strong><b>Logout !</b></strong></a>
                            </div>
                        </div>
                    </div>
                    

					<div class="row">
					<div class="col-sm-6">
						<div class="form-box">
						<div class="form-top">
							<div class="form-top-left">
								<p>Successfully Logged in!!</p>
								<h3>Name : <?php echo $_SESSION['name']?></h3>
								<h3>Roll Number : <?php echo $_SESSION['roll']?></h3>
								<h3>Email Id : <?php echo $_SESSION['email']?></h3>
								<h3>Role : <?php echo $_SESSION['role']?></h3>
                                <a href="http://localhost/SE/include/change_password.php" ><u>Change Password</u></a>
							</div>
						</div>
						</div>
					</div>
					</div>

                    <div class="row">

                        <div class="col-sm-6">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Request New Grant</h3>
	                            		<p>View form to fill for new grant request:</p>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="http://localhost/SE/include/Req_New_Grant.php" method="post" class="login-form">
				                        <button type="submit" class="btn"><b>Request New Grants</b></button>
				                    </form>
			                    </div>
		                    </div>
	                    </div>
                        <div class="col-sm-6">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>View all Grants</h3>
                                        <p>View all grants requested by the user:</p>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="http://localhost/SE/include/View_Your_Grants.php" method="post" class="login-form">
                                        <button type="submit" class="btn"><b>View all Grants</b></button>
                                    </form>
                                </div>
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
        

    </body>

</html>