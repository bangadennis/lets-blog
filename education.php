<?php
	$comment_post=NULL;
	
	$topic_name=null;
	$date_post=null;
	$post=null;
	
	
	
	
	require 'core.inc.php';
	require 'connect.inc.php';
	global $topic;
	$topic=4;
	
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
					echo $topic_name="<h4>$row_post[0]</h4>";
					$username=userpost($row_post[3]);
					echo $post="$row_post[2] <br>";
					echo $date_post="<br>Posted on $row_post[1] by $username<br>";
													
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
		$query_post="select * from comments where topic_id=$topic";
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
	$limit=1;
	if(isset($_GET['start']))
	{
		$start=$_GET['start'];	
	}
	else
	{
		$start=0;
	
	}
	
	$query="Select count(*) from posts";
	
	$result=mysql_query($query);
	$rows=mysql_fetch_row($result);
	
	$totalrows=$rows[0];
	
	if(($totalrows>0)&&($start<$totalrows))
	{
		$query1="Select topic_name, post from posts where user_id=6 Limit $start, $limit";
		
		$result1=mysql_query($query1) or die('Error, Could not run');
		
		while($row=mysql_fetch_row($result1))
		{
			echo "<div class='contentsize'>$row[0]<br />$row[1]</div>";	
			
		
		}
		
		if($start>=$limit)
		{
			echo "<a href=".$_SERVER['PHP_SELF']."?start=".($start-$limit).">Previous Page</a>                    <>";
			
		}
		if($start+$limit<$totalrows&& $start>=0)
		{
			echo "<a href=" .$_SERVER['PHP_SELF']. "?start=" .($start+$limit). ">Next Page</a>";
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

<script type="text/javascript">

function Comment()
{

var comment=document.getElementById('comment').value;

document.getElementById('postcomment').innerHTML="<ul> <li>"+comment+"</li><br></ul>";




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
							<li>
							<a href="#">Lifestyle</a>
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
								<h3>Comments</h3>
								<div id="commentpost">
				
										<?php
											
											commentpost($topic)
											
										?>
								</div>
					
								<div>
									<span>comments<span><br>
									<form  method="post"action="<?php  echo $currentfile; ?>">
									<textarea name="comment" rows="5" cols="7">
									<?php echo "$comment_post" ?>
									</textarea>
									<br>
				
									<input type="submit" value="Comment" />
									<input type="reset" name="clear" value="Clear" />
									</form>
									
								</div>
				
			
				</div>
				

			</div>
		
			<div id="edusidebar">
					<h3>Stories<h3>
					<ul>
					
					<?php
					
					themestories('Education');
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
		<hr>
	</div>	
	
	<div id="footer">
            
                 <footer>All Rights Reserved By BlogPost</footer>

	</div>
	
		 
</div>	 
</body>
</html>
