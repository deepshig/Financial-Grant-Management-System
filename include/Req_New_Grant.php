<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Request New Grant</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
                        if($role == 'Faculty')
                           $home = "http://localhost/SE/include/faculty_htm.php";

                        else if($role == 'MTech')
                           $home = "http://localhost/SE/include/mtech_htm.php";

                        else if($role == 'PhD')
                           $home = "http://localhost/SE/include/phd_htm.php";


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
                                    <h3>Request New Grant..!</h3>
                                    <p>Fill in the form to request a new grant:</p>
                                 </div>

                               </div>
                               <div class="form-bottom">
                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="registration-form">
                                    
                                        <div class="form-group">
                                            <label class="sr-only" for="form-role">Type of Grant</label>
                                                <select class="form-control" id="sel1" name="type">
                                                    <option hidden >Grant Type...</option>
                                                    <option>Resources</option>
                                                    <option>Travel Allowances</option>
                                                    <option>Medical</option>
                                                    <option>Others</option>
                                                </select>
                                        </div>                                    
                                        <div class="form-group">
                                            <label class="sr-only" for="form-rollnumber">Justification</label>
                                            <textarea class="form-control" rows="3" id="comment" name="justification" placeholder="Justification..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Amount Requested</label>
                                            <input type="number" name="amtrequested" placeholder="Amount Requested..." class="form-email form-control" id="form-email">
                                        </div>

                                        <?php

                                          if($role=='Faculty')
                                          {
                                            ?>
                                              <a href="#" title="Faculty" data-toggle="popover" data-trigger="hover" data-content="Resources : Rs. 1000000/- <br />Travel Allowances : Rs. 100000/- <br />Medical : Rs. 100000/- <br />Others : Rs. 50000/-" data-html="true">Grant Limits</a>
                                            <?php
                                          }
                                          if($role=='PhD')
                                          {
                                            ?>
                                              <a href="#" title="PhD" data-toggle="popover" data-trigger="hover" data-content="Resources : Rs. 700000/- <br />Travel Allowances : Rs. 20000/- <br />Medical : Rs. 100000/- <br />Others : Rs. 35000/-" data-html="true">Grant Limits</a>
                                            <?php
                                          }
                                          if($role=='MTech')
                                          {
                                            ?>
                                              <a href="#" title="MTech" data-toggle="popover" data-trigger="hover" data-content="Resources : Rs. 500000/- <br />Travel Allowances : Rs. 10000/- <br />Medical : Rs. 100000/- <br />Others : Rs. 10000/-" data-html="true">Grant Limits</a>
                                            <?php
                                          }

                                        ?>

                                        <br>

                           <?php

                                       if(isset($_POST['type']) && isset($_POST['justification']) && isset($_POST['amtrequested']))
                                       {
                                          $errors= array();
                                          $type = $_POST['type'];
                                          $justification = $_POST['justification'];
                                          $amtrequested = $_POST['amtrequested'];

                                          if($amtrequested < 0)
                                          {
                                             $errors[]="Amount should be positive";
                                             echo '<span style="color:#ff0000;text-align:center;">*Amount should be positive<br></span>';
                                          }

                                          if($type == "Grant Type...")
                                          {
                                             $errors[]="Select the Grant Type";
                                             echo '<span style="color:#ff0000;text-align:center;">*Select the Grant Type</span>';
                                          }

                                          if($type == "Resources")
                                          {
                                             if($role == "Faculty")
                                             {
                                                if($amtrequested > 1000000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 1000000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 1000000</span>';
                                                }
                                             }
                                             if($role == "PhD")
                                             {
                                                if($amtrequested > 700000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 700000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 700000</span>';
                                                }
                                             }
                                             if($role == "MTech")
                                             {
                                                if($amtrequested > 500000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 500000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 500000</span>';
                                                }
                                             }
                                          }

                                          if($type == "Travel Allowances")
                                          {
                                             if($role == "Faculty")
                                             {
                                                if($amtrequested > 100000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 100000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 100000.</span>';
                                                }
                                             }
                                             if($role == "PhD")
                                             {
                                                if($amtrequested > 20000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 20000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 20000</span>';
                                                }
                                             }
                                             if($role == "MTech")
                                             {
                                                if($amtrequested > 10000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 10000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 10000</span>';
                                                }
                                             }
                                          }

                                          if($type == "Medical")
                                          {
                                             if($amtrequested > 100000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 100000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 100000</span>';
                                                }
                                          }

                                          if($type == "Others")
                                          {
                                             if($role == "Faculty")
                                             {
                                                if($amtrequested > 50000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 50000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 50000</span>';
                                                }
                                             }
                                             if($role == "PhD")
                                             {
                                                if($amtrequested > 35000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 35000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 35000</span>';
                                                }
                                             }
                                             if($role == "MTech")
                                             {
                                                if($amtrequested > 10000)
                                                {
                                                   $errors[]="Amount should be less than Rs. 10000";
                                                   echo '<span style="color:#ff0000;text-align:center;">*Amount should be less than Rs. 10000</span>';
                                                }
                                             }
                                          }

                                          if(empty($errors) == true)
                                          {
                                             require_once 'InstitutePeople.php';

                                             if($role == 'Faculty')
                                                $obj = new InstitutePeople($roll, 1000000, 100000, 100000, 50000);
                                             else if($role == 'MTech')
                                                $obj = new InstitutePeople($roll, 500000, 10000, 100000, 10000);
                                             else if($role == 'PhD')
                                                $obj = new InstitutePeople($roll, 700000, 20000, 100000, 35000);

                                             $obj->RequestGrant($roll, $type, $justification, $amtrequested);
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
        <script>
            $(document).ready(function(){
                $('[data-toggle="popover"]').popover();   
            });
        </script>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>



