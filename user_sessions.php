<?php 
	require_once('phpInclude/header.php');
	
	echo "<h1>Scheduled</h1><hr>";
	
	$sql = " SELECT s.session_datetime,u.fname,u.lname,s.exp_applied_id FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.exp_applied_id = u.id) WHERE user_id='".$_SESSION['user_id']."' and s.status='2' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['session_datetime']." Expert: ".$fetch['fname']." ".$fetch['lname']."</div>";
				echo "<a href='".$root."user_live.php?id=".$fetch['exp_applied_id']."'>Go to Session screen</a>";
			}
		}
		else
		{
			echo "No session scheduled yet.";
		}
	}
	
	
	
	echo "<hr><h1>Open</h1><hr>";
	
	$sql = " SELECT s.exp_applied_id,s.id as s_id,s.user_reschedule,s.exp_reschedule,s.title,s.session_datetime,u.fname,u.lname,s.exp_applied_id FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.exp_applied_id = u.id) WHERE user_id='".$_SESSION['user_id']."' and s.status='1' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['title']." Expert: ".$fetch['fname']." ".$fetch['lname']."</div>";
				
				if($fetch['exp_applied_id'] == 0)
				{
					$sql1 = " SELECT id FROM session_time where session_id='".$fetch['s_id']."' GROUP BY user_id ";
					$query1 = mysql_query($sql1);
					$exp_applied = 0;
					if($query1)
					{
						$exp_applied = mysql_num_rows($query1);
					}
					echo "Request: ".$exp_applied." Replies";
				}
				else
				{
					if($fetch['exp_reschedule'] == 1)
					{
						echo "<a href='".$root."session_request.php?id=".$fetch['s_id']."'>Please Reschedule</a>";
					}
					else if($fetch['user_reschedule'] == 1)
					{
						echo "Waiting for reply.";
					}
					else if($fetch['exp_reschedule'] == 0 && $fetch['user_reschedule'] == 0)
					{
						echo "Waiting for reply.";
					}
				}
				
				
			}
		}
		else
		{
			echo "No session yet.";
		}
	}
	
	echo "<hr><h1>Closed</h1><hr>";
	
	$sql = " SELECT s.session_datetime,u.fname,u.lname,s.exp_applied_id FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.exp_applied_id = u.id) WHERE user_id='".$_SESSION['user_id']."' and s.status='0' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['session_datetime']." Expert: ".$fetch['fname']." ".$fetch['lname']."</div>";
				echo "<a href='".$root."user_live.php?id=".$fetch['exp_applied_id']."'>Go to Session screen</a>";
			}
		}
		else
		{
			echo "No session scheduled yet.";
		}
	}
	?>



<?php 
	require_once('phpInclude/footer.php');
?>

