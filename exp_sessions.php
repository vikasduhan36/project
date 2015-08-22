<?php 
	require_once('phpInclude/header.php');
	
	echo "<h1>Scheduled</h1><hr>";
	$sql = " SELECT s.title,s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['user_id']."' and s.status='2' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			echo "<a href='".$root."exp_live.php'>Go to Session screen</a>";
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['title']." ".$fetch['session_datetime']." Client: ".$fetch['fname']." ".$fetch['lname']."</div>";
				
				
				
			}
		}
		else
		{
			echo "<div>No session scheduled yet.</div>";
		}
	}
	
	echo "<hr><h1>Open</h1><hr>";
	
$sql = " SELECT s.id as s_id,s.exp_reschedule,s.user_reschedule,s.title,s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['user_id']."' and s.status='1' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['title']." Client: ".$fetch['fname']." ".$fetch['lname']."</div>";
				
				if($fetch['exp_reschedule'] == 1)
				{
					echo "Waiting for reply.";
				}
				else if($fetch['user_reschedule'] == 1)
				{
					echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."'>Reshcedule Request</a>";
				}
				else if($fetch['exp_reschedule'] == 0 && $fetch['user_reschedule'] == 0)
				{
					echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."'>Booking Request</a>";
				}
				
			}
		}
		else
		{
		
		}
	}
	
	
	echo "<hr><h1>Closed</h1><hr>";
	
	$sql = " SELECT s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['user_id']."' and s.status='0' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			echo "<a href='".$root."exp_live.php'>Go to Session screen</a>";
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['session_datetime']." Client: ".$fetch['fname']." ".$fetch['lname']."</div>";
			}
		}
		else
		{
		
		}
	}
	


	require_once('phpInclude/footer.php');
?>

