<?php
	
require 'core.inc.php';
require 'connect.inc.php';

function blogpost($topic,$theme)
{
	$query_post="SELECT topic_name,date_post,post, user_id from posts where theme_id='$theme' and topic_id='$topic'";
			
		if($result_post=mysql_query($query_post))
		{
													
			$rows_post=mysql_num_rows($result_post);
													
				if($rows_post>0)
				{
				$k=1;
				while($k<=$rows_post)
				{
					$row_post=mysql_fetch_row($result_post);
					echo $topic_name="<h4>$row_post[0]</h4>";
					$username=userpost($row_post[3]);
					echo $post="$row_post[2] <br>";
					echo $date_post="<br>Posted on $row_post[1] by $username<br>";															

													
					$k++;
															
				}
													
				}
				else
				{
													
					echo "No posts Posted<br>".mysql_error();
													
				}
													
												
		}
}

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
			echo "<div id='dailypost1'>$row[0]<br />$row[1]</div>";	
			
		
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




?>

<!DOCTYPE html>
<!--my blogspot index page-->
<html>
<head>
<title>blogspot</title>
<link rel="stylesheet" href="blog.css" type="text/css">

</head>
<div id="background">
		<div id="page">
				<div id="header">
					<div id="logo"><a href="index.php"><img src="images/logo1.png" alt="LOGO" height="70" width="90px"></a></div>
						<div id="navigation">
							<ul>
							<li class="selected">
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
							<li>
							<a href="login.php">Login</a></li>
                            
                            </ul>
							
							
						</div>
					</div>
			
				
					
					<div id="slideshow"><img src="images/shiftimage1.png" alt="Img" height="200" width="852">
					
					</div>
				
			<div>
				<div>
                  <div id="content">
							<ul>
								<li id="contentpost">
									<h3>Education posts</h3>
									<p>
									<?php
										blogpost('4', 'Education');
									?>
									
									</p>
									<a href="#">continue</a>
								</li>
			
								<li id="contentpost">
									<h4>Government</h4>
									<h5><h5>
									<p>
									<?php
					
										blogpost('4', 'Education');
					
									?>	
									</p>
									<a href="#">continue</a>
									
								</li>
							
							</ul>
							</div>
			
							<div id="contentside">
								<ul>
									<li id="contentpost">
									<h4>Health</h4>
									<h5></h5>
									<p>
									<?php
					
										blogpost('5', 'Health');
									
									?>	
									
									</p>
									<a href="#">continue</a>
									</li>
			
									<li id="contentpost">
									<h4>Lifestyle<h4>
									<h5><h5>
									<p>
									<?php
					
										blogpost('4', 'Lifestyle');
					
									?>	
									
									</p>
									<a href="#">continue</a>
									</li>
								
								</ul>
							</div>
					
				</div>
	
		
		
			</div>
	
	</div>
				
	<div id="dailypost">
		<h3>Today's Daily Post</h3>
				<p>
					<?php
					
						page();
					
					?>	
											            
				</p>
				<a href="#">continue</a>
		<hr>
	</div>
	<div id="footer">
            
         <footer>All Rights Reserved By BlogPost</footer>

	</div>


</div>


</html>