<?php
	
	require 'core.inc.php';
	require 'connect.inc.php';
	
	if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
	{
		if(isset($_POST['theme'])&&isset($_POST['topic'])&&isset($_POST['post'])&&!empty($_POST['theme'])&&!empty($_POST['topic'])&&!empty($_POST['post']))
		{
			$theme=htmlentities($_POST['theme']);
			$topic=htmlentities($_POST['topic']);
			$post=htmlentities($_POST['post']);
			$date=time();
			$date_post=date('Y-m-d',$date);
			$user_id=$_SESSION['user_id'];
			
			$query_post="Insert into posts(theme_id,topic_name,post, date_post, user_id) values('$theme', '$topic', '$post', '$date_post','$user_id')";
			
			if($result_post=mysql_query($query_post))
			{
				
				echo $post_query="Topic Posted";	
			}
			else
			{
				echo $post_query="Topic Not Posted".mysql_error();
			
			}
	
		}
	}
	else
	{
		echo 'Login To add a post';
	}
	


	function show_user_posts()
	{
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))
		{
			$user=$_SESSION['user_id'];
			
			$query_post="SELECT theme_id,topic_name,date_post from posts where user_id='$user'";
			
			if($result_post=mysql_query($query_post))
			{
				
				$rows_post=mysql_num_rows($result_post);
				
				if($rows_post>0)
				{
					$k=1;
					while($k<=$rows_post)
					{
						$row_post=mysql_fetch_row($result_post);
						echo "<br>Theme: $row_post[0]<br> ";
						echo "Topic: $row_post[1]<br>";
						echo "Posted on $row_post[2] <br>";
						echo "<hr>";
						$k++;
						
					}
				
				}
				else
				{
				
					echo "No posts Posted<br>".mysql_error();
				
				}
				
			
			}
			else
			{
				echo 'No posts'.mysql_error();
				
			}
		
		
		}
		else
		{
		
			echo "Login to Blog<br>";
		
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
					<div id="logo"><a href="index.php"><img src="images/logo1.png" alt="LOGO" height="70" width="90px"></a></div>
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
						
						<div>
							
							<div>
									
								<div id="postside">
									<div>
									<?php
									if(session())
									{
									echo $user_name=user();
						
									echo "<div id='logout'><a href='logout.inc.php'>Log Out</a></div>";
									
									echo '<hr>';
									}
									show_user_posts();
									?>
									</div>
									
									<div>
										
									</div>
								</div>
						
									<form method="post" action="post.php">
										<fieldset>
											<legend>Blogger's Spot Post</legend>
											<label>
												THEME:<br>
													<select name="theme">
															<option></option>
															<option>Education</option>
															<option>Lifestyle</option>
															<option>Health</option>
															<option>Government</option>
													</select>
											</label>
											<br>
											<label>
												Topic Name:<br>
													<input type="text" name="topic" /><br>
											</label>
											<label>
												POST:<br>
													<textarea name="post" cols="4" rows="30">
													</textarea>
											</label>
											<br>
											<hr>
											<input type="submit" value="POST" /> <br>
											<input type="reset" name="clear" value="Clear" />
										</fieldset>
									</form>
							</div>
							
							
							
						
						</div>
				
				</div>
				
				<hr>
		</div>
		
		<div id="footer">
			<footer>
			 All Rights Reserved By BlogPost
			</footer>
				
		</div>
				
	</div>
</body>
</html>