<?php
	$post_query=NULL;
	$deleteinfo=NULL;
	$addpost=NULL;
	require 'core.inc.php';
	require 'connect.inc.php';
	
	//delete a topic
	
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$user=$_SESSION['user_id'];
			
			$query_post="SELECT user_role from bloginfo where user_id='$user'";
			
			if($result=mysql_query($query_post))
			{
				
				$row_post=mysql_fetch_row($result);
				
				if($row_post[0]==='admin')
				{
					if(isset($_POST['user'])&&isset($_POST['topic'])&&!empty($_POST['user'])&&!empty($_POST['topic']))
					{
						$user=$_POST['user'];
						$topic=$_POST['topic'];
						
						$query_delete="delete from posts where user_id=(Select user_id from bloginfo where email='$user') and title='$topic'";
						
						if($result=mysql_query($query_delete))
						{
						$deleteinfo='Query Deleted'.mysql_error();
						}
						else
						{
						$deleteinfo='could not delete post'.mysql_error();
						
						}
					
					}
				}
				else
				{
					header("Location:".$referer);
					
				
				}
		
			}
		}

//add a new topic
	
	if(isset($_POST['topic'])&&!empty($_POST['topic'])&&isset($_POST['theme'])&&!empty($_POST['theme']))
	{
			$topic=$_POST['topic'];
			$theme=$_POST['theme'];
			
			$query_post="insert into theme($theme) values('$topic')";
			
			if($result=mysql_query($query_post))
			{
				echo $addpost='Added successfully';		
					
			}
			else
			{
			
				echo $addpost='Error in adding the topic'.mysql_error();
			
			}
					
				
				
		
	}
	

		
		
		
		
		
		
		
	function user_emails()
	{
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$user=$_SESSION['user_id'];
			
			$query_post="SELECT user_role from bloginfo where user_id='$user'";
			
			if($result=mysql_query($query_post))
			{
				
				$row_post=mysql_fetch_row($result);
				
				if($row_post[0]==='admin')
				{
					$query_user="SELECT email from bloginfo";
					if($result_user=mysql_query($query_user))
					{
						$rows_user=mysql_num_rows($result_user);
				
						if($rows_user>0)
						{
							$k=1;
							while($k<=$rows_user)
							{
								$row_user=mysql_fetch_row($result_user);
								
								echo "<option>$row_user[0]</option>";
								$k++;
								
							}
						
						}
					
					
					
					}
					
				
				}
		
			}
	
	
	
		}
	
	
	
	}
	
	function user_title()
	{
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$user=$_SESSION['user_id'];
			
			$query_post="SELECT user_role from bloginfo where user_id='$user'";
			
			if($result=mysql_query($query_post))
			{
				
				$row_post=mysql_fetch_row($result);
				
				if($row_post[0]==='admin')
				{
					$query_user="SELECT title from posts";
					if($result_user=mysql_query($query_user))
					{
						$rows_user=mysql_num_rows($result_user);
				
						if($rows_user>0)
						{
							$k=1;
							while($k<=$rows_user)
							{
								$row_user=mysql_fetch_row($result_user);
								
								echo "<option>$row_user[0]</option>";
								$k++;
								
							}
						
						}
						
					}
					
				
				}
				else
				{
					header("Location:login.php");
				
				}
		
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Education</title>
<link href="blog.css" type="text/css" rel="stylesheet" />
	
</head>
<div id="background">
	<div id="page">
				<div id="header">	
					<div id='logout'>
						<?php
					if(session())
							{	$user_name=user();
							
								echo "<div>$user_name&nbsp;&nbsp;<a href='logout.inc.php'>Log Out</a></div>";
							}
						?>
						
					</div>				
					<div id="navigation">
							<ul>
							<li>
							<a href="index.php">Home</a>
							</li>
							<li>
							<a href="education.php">Education</a>
							</li>
							<li>
							<a href="#">Government</a></li>
							<li><a href="#">Politics</a> </li>
							<li>
							<a href="#">Lifestyle</a>
							</li>
							<li>
							<a href="#">About</a>
							</li>
							<li class="selected">
							<a href="post.php">Blog</a>
							</li>
						
							
						</div>
						
			</div>
			
			<div>
				<div id='admin'>
					<form action="admin.php" method="post">
					<h4>Post Delete</h4>
					<label>Users</label>
					<br />
						<select name='user'>
						<?php
						user_emails();
						?>
						</select>
						<br /><br><br/><br>
					<label>Posts</label>
					<br/>
						<select name='topic'>
						<?php
						user_title();
						?>
						</select>
					<br /><br/><br><br/><br>
					<input type="submit" value="Delete Post" />
					</form>
				<?php   
				
				echo $deleteinfo;
				?>
				
				</div>
				
				<div id='adminside'>
					<form method='post' action='admin.php'> 
					<h4>Post Delete</h4>
					<label>Themes</label>
					<br />
						<select name='theme'>
						<option>Education</option>
						<option>Politics</option>
						<option>Lifestyle</option>
						<option>Health</option>
						</select>
						<br /><br><br>
					<label>Topic to Add</label>
						<br>
					<input type="type" name="topic" />	
					<br />
					<input type="submit" value="Add Topic" />
					</form>
				</div>
			
			</div>
	</div>
	<div id="footer">
			<footer>
			 All Rights Reserved By BlogPost
			</footer>
				
	</div>
				

</div>
<script type="text/javascript" src="js/JQuery.js" ></script> 
<script type="text/javascript" src="js/script.js" ></script> 
</body>
</html>