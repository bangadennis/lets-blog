<?php
	
if(isset($_POST['email'])&& isset($_POST['password']))
{
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	if(!empty($email)&&!empty($password))
	{					
		$query="SELECT user_id, email, password FROM $db_table where email='".mysql_real_escape_string($email)."' and password='".mysql_real_escape_string($password)."'";
	
		if($result=mysql_query($query))
		{	
			$row_run=mysql_num_rows($result);
			
			if($row_run>0)
			{
				$result_run=mysql_fetch_row($result);
				$user_id=$result_run[0];
				$_SESSION['user_id']=$user_id;
				header('Location: post.php');	
			}
			else
				{
		
					$signup='Wrong Password or Combination!!!';
		
				}
																
		}
		
			
		mysql_close();
	}
}



?>