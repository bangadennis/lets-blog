<?php		
		
		$host="localhost";
		$database="blog";
		$db_user="root";
		$db_password="1234pass";
		$db_table="bloginfo";
		
		if(!(@mysql_connect("$host", "$db_user", "$db_password"))||!(@mysql_select_db("$database")))
		{
			die('Unable to Connect');
		
		}
		
?>