<?php
	
	
	//function username
	function username($user_id)
	{
	$query="select fname from bloginfo where user_id='$user_id'";

	if($query_run=mysql_query($query))
	{
		if($result=mysql_result($query_run,0,'fname'))
		{
			return $result;
	
		}
	

	}

}

//function blogpost

	function blogpost($topic)
	{
			$query_post="SELECT topic_name,date_post,post, user_id from posts where theme_id='Education' and topic_id='$topic'";
			
		if($result_post=mysql_query($query_post))
		{
													
				$rows_post=mysql_num_rows($result_post);
													
			if($rows_post>0)
			{
					$row_post=mysql_fetch_row($result_post);
					echo $topic_name="<div class='contentsize'><h4>$row_post[0]</h4>";
					$username=userpost($row_post[3]);
					echo $post="$row_post[2] <br>";
					echo $date_post="<br>Posted on $row_post[1] by $username<br></div>";
													
			}
			else
			{
													
				echo "No posts Posted<br>".mysql_error();
													
			}
													
												
		}
												
	}
	//function commentpost						
	function commentpost($topic)
	{	
		$query_post="select * from comments where topic_id='$topic'";
			if($result_comment=mysql_query($query_post))
			{
				$rows=mysql_num_rows($result_comment);

					if($rows>0)
					{	
						$k=1;
						while($k<=$rows)
						{
							$comment_row=mysql_fetch_row($result_comment);
							echo "$comment_row[1]<br>";
							$userpost=strtolower(username($comment_row[3]));
							$date_post=$comment_row[2];
							echo "<br><span>Posted By $userpost on $date_post<span><br>";

							$k++;
						}

					}
													

			}
	}
	
	//themestories
				function themestories($theme)
					{
						$query_post="SELECT topic_id, topic_name,date_post,post, user_id from posts where theme_id='$theme'";
			
						if($result_post=mysql_query($query_post))
							{
													
								$rows_post=mysql_num_rows($result_post);
													
								if($rows_post>0)
								{
									$k=1;
									while($k<=$rows_post)
									{
										$row_post=mysql_fetch_row($result_post);
										echo $topic_name="<li><a href='select.php'>$row_post[1]";
										$username=strtolower(userpost($row_post[4]));
										echo "by $username</a></li>";

										$k++;
															
									}
												
								}
								else
								{
													
									echo "No posts Posted<br>".mysql_error();
													
								}
													
												
							}
					}


//Page Function	
function page()
{
	global $limit;
	$limit=1;
	if(isset($_GET['start']))
	{
		$start=$_GET['start'];	
	}
	else
	{
		$start=0;
	
	}
	
	$query="Select count(*) from posts where theme_id='Education'";
	
	$result=mysql_query($query);
	$rows=mysql_fetch_row($result);
	
	$totalrows=$rows[0];
	
	if(($totalrows>0)&&($start<$totalrows))
	{
		$query1="Select topic_name, post, topic_id from posts where theme_id='Education' Limit $start, $limit";
		
		$result1=mysql_query($query1) or die('Error, Could not run');
		
		while($row=mysql_fetch_row($result1))
		{
			echo "<h3>$row[0]</h3><br />$row[1]";
			echo '<h3>Comments</h3>';
			echo "<div id='commentpost'>";
			commentpost($row[2]);
			echo "</div>";
				
			$topic1=$row[2];				
										
		
		}
		
		if($start>=$limit)
		{
			echo "<a href=".$_SERVER['PHP_SELF']."?start=".($start-$limit).">Previous Page &nbsp;&nbsp;&nbsp;</a>";
			
		}
		if($start+$limit<$totalrows&& $start>=0)
		{
			echo "<a href=" .$_SERVER['PHP_SELF']. "?start=" .($start+$limit). ">Next Page</a>";
		}
		

	}
	
		
}
				

	
//comment posting function

	if(isset($_POST['comment'])&&!empty($_POST['comment']))
	{
		
		$comment=htmlentities($_POST['comment']);
	
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$topic=$GLOBALS['topic1'];
			$date=time();
			$time=date('Y-m-d',$date);
			$user_id=$_SESSION['user_id'];
			$query_comment="INSERT INTO comments(comment,comment_time,user_id, topic_id) values('$comment' ,'$time','$user_id', '$topic')";
			
		if(mysql_query($query_comment))
		{
	
	
		$comment_post='Comment posted';
		//header('Location:'.$referer);

		
		}
		else
			{
			
			$comment_post='encountered an error'.mysql_error();
			//header('Location:'.$referer);
			}
		}
		else
		{
		
			echo $comment_post='login to post a comment';
			//header('Location:'.$referer);
			

		}
	}


?>