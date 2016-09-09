<?php

ob_start();
session_start();
$currentfile=$_SERVER['SCRIPT_NAME'];
$referer=$_SERVER['HTTP_REFERER'];

function session()
	{
	if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
	{

		return true;

	}
	else
	{
		return false;

	}
}

function user()
{

	$user=$_SESSION['user_id'];
	$query="select fname from bloginfo where user_id='$user'";

	if($query_run=mysql_query($query))
	{
		if($result=mysql_result($query_run,0,'fname'))
		{
			return $result;
	
		}
	

	}

}

function userpost($user)
{
	$query="select fname from bloginfo where user_id='$user'";

	if($query_run=mysql_query($query))
	{
		if($result=mysql_result($query_run,0,'fname'))
		{
			return $result;
	
		}
	

	}

}




?>