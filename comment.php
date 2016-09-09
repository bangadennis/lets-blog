<?php

	if(isset($_POST['comment'])&&!empty($_POST['comment']))
	{
		$comment=htmlentities($_POST['comment']);
	
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{

			$date=time();
			$time=date('Y-m-d',$date);
			$user_id=$_SESSION['user_id'];
			
			$query_comment="INSERT INTO comments(comment,comment_time,user_id, topic_id) values('$comment' ,'$time','$user_id', $topic)";
			
		if(mysql_query($query_comment))
		{
	
	
		$comment_post='Comment posted';
		
		}
		else
			{
			
			$comment_post='encountered an error';
			}
		}
		else
		{
		
			
			
			$comment_post='login to post a comment';

		}
	
		
		
		
	
	
	
	}
	









?>


