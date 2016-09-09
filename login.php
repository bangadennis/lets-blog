<?php

$signup=NULL;
$login=NULL;
$login_user=NULL;

require 'core.inc.php';
require 'connect.inc.php';

if(session())
	{
		$login="User Logged in'<a href='logout.inc.php'>Log Out</a> <br>";
		$login_user=user();
	
	}
	
	


include 'register.inc.php';
include 'loginvalidate.php';


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
							<a href="blog.html">Home</a>
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
							<?php
							if(session())
							{
							header("Location: post.php");
							}
							else
							{
							echo "<a href='login.php'>Login</a>";
							}
							?>
							</li>
						
							
						</div>
				</div>
			
				<div>
						
						<div>
							
							<div>
									<div id="login">
											<p>
										<?php
										echo "$login<br>";
										echo "$login_user<br>";
										echo "$signup;<br>";
										echo "<a href='post.php'>Post A blog</a>'";
										?>
											</p>
							
									</div>
							
									
									<form method="post" action="<?php echo $currentfile; ?>">
										<fieldset>
											<legend>Blogger's Spot Form</legend>
											<label>
												FirstName:<br>
													<input type="text" name="fname" /><br>
											</label>
											<label>
												Surname:<br>
													<input type="text" name="surname" /><br>
											</label>
											<label>
												Email:<br>
													<input type="email" name="email"><br>
											</label>
											<label>
												Gender:<br>
												<input type="radio" name="gender" value="male">Male <br>
												<input type="radio" name="gender" value="female">Female<br>
											</label>
											<label>
												Date Of Birth:<br>
												<input type="date" name="dateofbirth"><br>
											</label>
											<label>
												Password:<br>
												<input type="password" name="password"><br>
											</label>
											<input type="submit" name="Submit" />
											
										</fieldset>
									</form>
											
							
						
						
							
							
							
							</div>
							
							<div>
								<form method="post" action="<?php echo $currentfile; ?>">
									<fieldset>
									<legend>Login Form</legend>
									<br>
									<label>
										Email:<br>
										<input type="email" name="email" /> <br>
										Password:<br>
										<input type="password" name="password"><br>
										<br>
										<input type="submit" name="Login">
									</label>
								
								
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