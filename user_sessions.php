<?php 
	require_once('phpInclude/header.php');
	
	
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
		
		}
	}
	
	?>

<h3>Scheduled</h3>


<?php 
	require_once('phpInclude/footer.php');
?>

