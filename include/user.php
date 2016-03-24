<?php

//session_start();
require_once 'Db_connect.php'; 
$db = new Db_connect();
$conn = $db->connect();
    
if($conn)
{

 class user  
 {
	private $name, $emailid, $password, $role, $roll;
	         

	 public function SetDetails()
	 {
	 	$name = $_SESSION['name'];
	 	$emailid = $_SESSION['email'];
	 	$password = $_SESSION['password'];
	 	$role = $_SESSION['role'];
        $roll = $_SESSION['roll'];
	 }

     public function Login($email, $role)
     {
          mysql_select_db('FinancialGrantManagementSystem');
          $query = "SELECT RollNumber from FinancialGrantManagementSystem.AllUsers where EmailId='$email' and Role = '$role'";
          $result = mysql_query($query) or die(mysql_error());

          return $result; 
     }

     public function Logout()
     {
        unset($_SESSION['role']);
        unset($_SESSION['roll']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['grantid']);
        unset($_SESSION['password']);
        unset($_SESSION['accessroll']);

        header('Refresh: 1; URL = http://localhost/SE/include/Login.php');
     }

     public function Register($email, $role, $roll)
     {
        mysql_select_db('FinancialGrantManagementSystem');
        $check_query = "SELECT * from FinancialGrantManagementSystem.AllUsers where EmailId = '$email' and Role = '$role' and RollNumber = '$roll' and Status = 'Unregistered'";
        $check_result = mysql_query($check_query) or die(mysql_error());

        return $check_result;
     }
 }
}

?>