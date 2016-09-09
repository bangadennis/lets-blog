<?php
 require 'connect.inc.php';
if(empty($_SESSION['user_id'])&&!isset($_SESSION['user_id']))
{
if(isset($_POST['fname'])&& isset($_POST['surname'])&& isset($_POST['email'])&& isset($_POST['gender'])&& isset($_POST['dateofbirth'])&& 
isset($_POST['password']))
{
	$fname=strtoupper($_POST['fname']);
	$surname=strtoupper($_POST['surname']);
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	$dob=$_POST['dateofbirth'];
	$password=md5($_POST['password']);


	if(!empty($fname)&&!empty($surname)&&!empty($email)&&!empty($gender)&&!empty($dob)&&!empty($password))
	{
		
			$query="INSERT INTO bloginfo(fname,surname,email,gender,DoB,password) VALUES('$fname','$surname','$email','$gender','$dob','$password')";
			
			if(@mysql_query($query))
			{
				$time=time();
				$date=date("d:m:Y @ H:m:s",$time);
			
			$signup="successful Signed Up at $date <br> <b>Can Login Now </b>";
			
			}
			else
			{
			$signup='ERROR'.mysql_error();
			
			}
		
		mysql_close();	
	
	}

	else
	{
	
	$signup="Kindly Fill All The Details To SignUp";
	
	}
}
}
else
{
	
$signup="Kindly Logout to Register";
}

?>

