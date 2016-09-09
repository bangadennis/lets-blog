<?php
	
	$comment_post=NULL;
	//$topic_name=null;
	//$date_post=null;
	//$post=null;
	$topic=null;
	
	require 'core.inc.php';
	require 'connect.inc.php';
	
	
	//comment posting
/*	
if(isset($_POST['comment'])&&!empty($_POST['comment']))
	{
		echo $_GET['start'];
		$comment=htmlentities($_GET['comment']);
	
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$date=time();
			$time=date('Y-m-d',$date);
			$user_id=$_SESSION['user_id'];
			$topic=$_SESSION['topic'];
			$query_comment="INSERT INTO comments(comment,comment_time,user_id, topic_id) values('$comment' ,'$time','$user_id', '$topic')";
			
		if(mysql_query($query_comment))
		{
	
	
		echo $comment_post='Comment posted';
		header('Location:'.$referer);

		
		}
		else
			{
			$topic;
			$comment_post='encountered an error'.mysql_error();
			//header('Location:'.$referer);
			}
		}
		else
		{
		
			$comment_post='login to post a comment';
				//header('Location:'.$referer);
			

		}
	
	}
	*/
	
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
							echo "<div id='comment'>$comment_row[1]<br>";
							$userpost=strtolower(username($comment_row[3]));
							$date_post=$comment_row[2];
							echo "<br><span>Posted By $userpost on $date_post<span><br></div>";

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
	$current_post=NULL;
	$limit=1;
	if(isset($_GET['page']))
	{
		$start=$_GET['page'];	
	}
	else
	{
		$start=0;
	
	}
	
	$query="Select count(*) from posts where theme_id='Lifestyle'";
	
	$result=mysql_query($query);
	$rows=mysql_fetch_row($result);
	
	$totalrows=$rows[0];
	
	if(($totalrows>0)&&($start<$totalrows))
	{
		$query1="Select topic_name, post, topic_id, date_post,user_id  from posts where theme_id='Lifestyle' Limit $start, $limit";
		
		$result1=mysql_query($query1) or die('Error, Could not run');
		
		while($row=mysql_fetch_row($result1))
		{
			echo "<div id='contentsize'><h3>$row[0]</h3><br />$row[1]</div>";
			$username=userpost($row[4]);
			echo $date_post="<br>Posted on $row[3] by $username<br></div>";
			//comments posted
			echo '<h3>Comments</h3>';
			echo "<div id='commentpost'>";
			commentpost($row[2]);
			echo "</div>";
				
			$_SESSION['topic']=$row[2];
			
			/*//comment message
			echo "<div id='message'>";
			echo "comment_post";
			echo "</div>";
			
			
			
			echo "<form action='' method='post'>";
			echo "<textarea id='commenting' name='comment' row='5' cols='8'>";					
			echo"</textarea>";
			echo"<br>";
			echo "<input type='submit' value='Comment' />";
			echo "<input type='reset' name='clear' />";
			echo "</form>";
			*/
					
			
		
		}
		
		if($start>=$limit)
		{
			echo "<a href=".$_SERVER['PHP_SELF']."?page=".($start-$limit).">Previous Page &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;</a>";
			
		}
		if($start+$limit<$totalrows&& $start>=0)
		{
			echo "<a href=" .$_SERVER['PHP_SELF']. "?page=" .($start+$limit). ">Next Page</a>";
		}
		

	}
	
		
}
	
include 'comment.php';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Education</title>
<link href="blog.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/JQuery.js"></script>
<script type="text/javascript">
function CommentPost()
{
	if(window.XMLHttpRequest)
	{		
		xmlhttp=new XMLHttpRequest();

	}
	else
	{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	xmlhttp.onreadystatechange= function ()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('message').innerHTML=xmlhttp.requestText;	
			var alert=xmlhttp.requestText
			alert(alert);
		}
		
	}
		
		parameter=document.getElementById('commenting').value;
		xmlhttp.open("GET","comment.php?comment="+parameter, true);
		//xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send();
	
}
</script>
</head>
<body>
<div id="background">
	<div id="page">
				<div id="header">
					<div id="logo"><a href="index.php"><img src="images/logo1.png" alt="LOGO" height="70" width="90px"></a></div>
						<div id="navigation">
							<ul>
							<li>
							<a href="index.php">Home</a>
							</li>
							<li class="selected">
							<a href="education.php">Education</a>
							</li>
							<li>
							<a href="#">Government</a></li>
							<li><a href="#">Politics</a> </li>
							<li class="selected">
							<a href="lifestyle.php">Lifestyle</a>
							</li>
							<li>
							<a href="#">About</a>
							</li>
							<li>
							<a href="login.php">Login</a></li>
                            </ul>
							
							
						</div>
				</div>
        
		 
		<div id="edupage">
		
			<div id="eduposts">
					<h3>Education blogs</h3>
					<h4>Topics</h4>
				<div>
					<img src="images/edu1.png" height="200" width="500">
				</div>
				<div id="educontent">
							
								<div>
									<p>
									<?php
									
									page();
									?>
									</p>
								</div>
										<!--commments-->
										
								<div id='message'>
								<?php echo "$comment_post" ?>
								</div>
							
								<div id='commentarea'>
									<span>Comment here<span><br>
									<form method='post' action='<?php echo $currentfile; ?>' id="formcomment">
									<textarea id="commenting" name='comment' row="5" cols="8">
									
									</textarea>
									<br>
				
									<input type="submit" value="Comment"   />
									<input type="reset" name="clear" value="Clear" />
									</form>
									
								</div>
			
			
				</div>
				

			</div>
		
			<div id="edusidebar">
					<h3>Stories<h3>
					<ul>
					
					<?php
					
					themestories('Lifestyle');
					echo $_SESSION['topic'];
					?>
						<!--<li><a href="#">How To Manage Time Effectively</a></li>
						<li><a href="#">How Succeeded in Exams</a></li>
						<li><a href="#">How To Avoid Procrastination</a></li>
						<li><a href="#">Am Giant For Sure</a></li>
						<li><a href="#">Positive Effects of Social Media to students</a></li>
						<li><a href="#">Do nothing for nothing</a></li>
						-->
					
					
					
					</ul>
			</div>	
				
		</div>
		
	</div>	
	
	<div id="footer">
            
                 <footer>All Rights Reserved By BlogPost</footer>

	</div>
	
		 
</div>	


</body>
</html>

