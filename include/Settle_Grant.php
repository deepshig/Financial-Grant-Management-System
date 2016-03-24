<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Settle Grant</title>

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
         
            <br><br>
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

                                 if(!isset($_SESSION['grantid']))
                                 {
                                    ?>
                                                  <div class="top-content">
                      
                                                      <div class="inner-bg">

                                                          <div class="container">

                                                              <div class="row">
                                                                  <div class="col-sm-8 col-sm-offset-2 text">
                                                                      <br><br><br>
                                                                      <h1>OOPS..!!<p>Select an Unsettled Grant to settle!</p></h1>
                                                                      <div class="form-box">
                                                                          <a href="http://localhost/SE/include/faculty_htm.php" class="btn btn-info" role="button"><strong><b>Home Page !</b></strong></a>
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
                                     $grantid = $_SESSION['grantid'];
                                     require_once 'Db_connect.php'; 
                                     $db = new Db_connect();
                                     $conn = $db->connect();

                                     if($conn)
                                     {
                                        mysql_select_db('FinancialGrantManagementSystem');
                                        $check_query = "SELECT GrantStatus from FinancialGrantManagementSystem.GrantDetails where GrantID = '".$grantid."'";
                                        $check_result = mysql_query($check_query) or die(mysql_error());
                                        $row = mysql_fetch_array($check_result);
                                        if($row["GrantStatus"] != 'Unsettled')
                                        {
                                          ?>
                                                  <div class="top-content">
                      
                                                      <div class="inner-bg">

                                                          <div class="container">

                                                              <div class="row">
                                                                  <div class="col-sm-8 col-sm-offset-2 text">
                                                                      <br><br><br>
                                                                      <h1>OOPS..!!<p>Select an Unsettled Grant to settle!</p></h1>
                                                                      <div class="form-box">
                                                                          <a href="http://localhost/SE/include/faculty_htm.php" class="btn btn-info" role="button"><strong><b>Home Page !</b></strong></a>
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

                                <div class="col-sm-1">
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-box">
                                     <a href="<?php echo $home ?>" class="btn btn-info" role="button"><b>Go Back to Home !</b></a>
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                  <div class="form-box">
                                  <div class="form-top">
                                     <div class="form-top-left">
                                        <h3>Settle Grant..!</h3>
                                        <p>Please upload a zip file of all your bills. <br>Maximum Size allowed = 2MB. <br>Name your zip file as <?php echo $grantid  ?>.zip <br> <br></p>
                                     

             <?php

                                     if(isset($_FILES['bills']))
                                        {
                                           $errors= array();
                                           $file_name = $_FILES['bills']['name'];
                                           $file_size = $_FILES['bills']['size'];
                                           $file_tmp = $_FILES['bills']['tmp_name'];
                                           $file_type = $_FILES['bills']['type'];
                                           $file_ext=strtolower(end(explode('.',$_FILES['bills']['name'])));

                                           $extensions= array("zip");

                                           $name = (string)$grantid.".zip";

                                           if($file_name != $name)
                                           {
                                              $errors[]="Keep the file name as ".$grantid.".zip.";
                                              echo '<span style="color:#ff0000;text-align:center;">*Keep the file name as ',$grantid,'.zip.<br></span>';
                                           }
                                              
                                           
                                           if(in_array($file_ext,$extensions) == false)
                                           {
                                              $errors[]="Extension not allowed, please choose a ZIP file.";
                                              echo '<span style="color:#ff0000;text-align:center;">*Extension not allowed, please choose a ZIP file.<br></span>';
                                           }
                                           
                                           if($file_size > 2097152)
                                           {
                                              $errors[]="Maximum File Size allowed is 2 MB.";
                                              echo '<span style="color:#ff0000;text-align:center;">*Maximum File Size allowed is 2 MB.<br></span>';
                                           }
                                           
                                           if(empty($errors) == true) 
                                           {
                                              move_uploaded_file($file_tmp,"/opt/lampp/htdocs/SE/testupload/". $file_name);

                                              mysql_select_db('FinancialGrantManagementSystem');
                                              $upload_query = "UPDATE FinancialGrantManagementSystem.GrantDetails SET GrantStatus='SettlementRequest' WHERE GrantID=$grantid";
                                              $upload_result = mysql_query($upload_query) or die(mysql_error());

                                              if($upload_result)
                                              {
                                                 
                                                 echo "<p>Sent File : ",$_FILES['bills']['name'], "<br>File size : ",$_FILES['bills']['size'], " Bytes<br>File type : ",$_FILES['bills']['type'], "</p>";
                                                 echo '<span style="color:#368BC1;text-align:center;"><b>File uploaded successfully!</b><br></span>';
                                                 echo '<span style="color:#368BC1;text-align:center;"><b>Settlement Request sent to admin.</b><br></span>';
                                              }
                                                 
                                           }
                                        }



                ?>

                                   </div>
                                   </div>
                                   <div class="form-bottom">
                                    <form role="form" action="" method="post" class="registration-form" enctype = "multipart/form-data">
                                            
                                        <input type = "file" name = "bills" />
                                        <br>
                                        <button type="submit" class="btn" name="upload"><b>Upload !</b></button>

                                    </form>
                                 </div>
                               </div>
                                </div>

                                <div class="col-sm-3">
                                </div>
                            </div>  
                    </div>
                </div>
                <br>
                
            </div>

    <?php
            }
        }
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



