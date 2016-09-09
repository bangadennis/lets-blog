<?php
	
	$comment_post=NULL;
	$topic=null;
	
	require 'core.inc.php';
	require 'connect.inc.php';

	
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
						$query_post="SELECT topic_id, title,date_post,post, user_id from posts where theme_id='$theme' order by date_post desc";
			
						if($result_post=mysql_query($query_post))
							{
													
								$rows_post=mysql_num_rows($result_post);
													
								if($rows_post>0)
								{
									$k=1;
									$page=0;
									while($k<=$rows_post)
									{
										$row_post=mysql_fetch_row($result_post);
										echo $topic_name="<li><a href='lifestyle.php?page=$page'>$row_post[1]";
										$username=strtolower(userpost($row_post[4]));
										echo "&nbsp;by&nbsp; $username</a></li>";
										$page++;
										$k++;
															
									}
												
								}
								else
								{
													
									echo "No posts Posted<br>".mysql_error();
													
								}
													
												
							}
					}

//comments count
	function comment_count($topic)
	{
		$comments_count="select count(*) from comments where topic_id='$topic'";
	
		$result_count=mysql_query($comments_count);
		$rows=mysql_fetch_row($result_count);
		echo "<b>$rows[0] Comments</b>";
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
		$query1="Select title, post, topic_id, date_post,user_id  from posts where theme_id='Lifestyle' order by date_post desc Limit $start, $limit";
		
		$result1=mysql_query($query1) or die('Error, Could not run');
		
		while($row=mysql_fetch_row($result1))
		{
			echo "<div id='contentsize'><h3>$row[0]</h3><div id='content_display'>$row[1]</div></div>";
			$username=userpost($row[4]);
			echo $date_post="<br><em>Posted on $row[3] by &nbsp;$username</em><br>";
				
			$_SESSION['topic']=$row[2];
	
		}
		
		if($start>=$limit)
		{
			echo "<div id='pagenavigation'><a href=".$_SERVER['PHP_SELF']."?page=".($start-$limit).">Previous Page</a></div>";
			
		}
		if($start+$limit<$totalrows&& $start>=0)
		{
			echo "<div id='pagenavigation'><a href=" .$_SERVER['PHP_SELF']. "?page=" .($start+$limit). ">Next Page</a></div>";
		}
				

				//comments posted
		echo '<h3>Comments</h3>';
		comment_count($_SESSION['topic']);
		echo "<div id='commentpost'>";
		commentpost($_SESSION['topic']);
		echo "</div>";
	

	
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
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
/*function CommentPost()
{
	if(window.XMLHttpRequest)
	{		alert('HELLO KENYA');
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
		}
		
	}
		alert('HELLO KENYA');
		parameter=document.getElementById('commenting').value;
		alert(parameter);
		parameter='Kenya';
		xmlhttp.open("GET","test.php?q="+parameter, true);
		xmlhttp.send();
		/*xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');*/
		
	
}
</script>
</head>
<body>
<div id="background">
	<div id="page">
				<div id="header">
					<div id='logout'>
						<?php
					if(session())
							{	$user_name=user();
							
								echo "<div><span>$user_name</span>&nbsp;&nbsp;<a href='logout.inc.php'>Log Out</a></div>";
							}
						?>
						
					</div>
					<!--<div id="logo"><a href="index.php"><img src="images/logo1.png" alt="LOGO" height="70" width="90px"></a></div>-->
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
							<li class="selected">
							<a href="lifestyle.php">Lifestyle</a>
							</li>
							<li>
							<a href="#">About</a>
							</li>
							<li>
							<?php
							if(session())
							{
								echo "<a href='post.php'>Blog</a>";
							}
							else
							{
							echo "<a href='login.php'>Login</a>";
							}
							?>
                            </ul>
							
							
						</div>
				</div>
        
		 
		<div id="edupage">
		
			<div id="eduposts">
					<h3>Lifestyle blogs</h3>
					<h4>Topics</h4>
				<div>
					<img src="images/edu1.png" height="200" width="500">
				</div>
				<div id="educontent">
							
								<div>
									<?php
									
									page();
									?>
								</div>
										<!--commments-->
										
								<div id='message'>
								<?php
								echo $comment_post;
								?>
						
								</div>
							
								<div id='commentarea'>
									<span>Comment here<span><br>
									<form id="formcomment" method='post' action='<?php echo $currentfile; ?>' >
									<textarea id="commenting" name='comment'  rows="5" cols="8">
									
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
					
					themestories('Lifestyle');
					echo $_SESSION['topic'];
					?>
					
					
					
					</ul>
			</div>	
				
		</div>
		
	</div>	
	
	<div id="footer">
            
                 <footer>All Rights Reserved By BlogPost</footer>

	</div>
	
		 
</div>	

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/post.js"></script>
</body>
</html>

