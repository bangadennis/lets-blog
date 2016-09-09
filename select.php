<?php
	
function page()
{
	if(isset($_GET['page']))
	{
		$start=$_GET['page'];
	}
	else
	{
		$start=0;
	
	}

	$limit=1;
	
	$query="Select count(*) from posts";
	
	$result=mysql_query($query);
	$rows=mysql_fetch_row($result);
	
	$totalrows=rows[0];
	
	if(($totalrows>0)&&($start<$totalrows))
	{	
		$time=time();
		$date=date('Y:m:d', $time);
		
		$query1="Select * from posts where date_post='$date' Limit '$start', '$limit'";
		
		$result1=mysql_query($query1) or die('Error, Could not run');
		
		while($row=mysql_fetch_row($result1))
		{
			echo "$row[0],$row[1],$row[2],$row[3]<br />";	
			
		
		}
		
		if($start>=$limit)
		{
			echo "<a href=".$_SERVER['PHP_SELF']."?start=".($start-$limit).">Previous Page</a>&nbps;&nbps;&nbps;&nbps;&nbps;&nbps;";
			
		}
		if(($start+$limit)<=$totalrows&& $start>0)
		{
			echo "<a href=".$_SERVER['PHP_SELF']."?start=".($start+$limit).">Next Page</a>&nbps;&nbps;&nbps;&nbps;&nbps;&nbps;";
		}
		
	
	
	
	}
	
	
	






}	




?>