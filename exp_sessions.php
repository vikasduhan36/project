<?php 
	require_once('phpInclude/header.php');
	
	
	$sql = " SELECT s.session_datetime,u.fname,u.lname FROM sessions as s LEFT JOIN users as u ";
	$sql .= " ON(s.user_id = u.id) WHERE exp_applied_id='".$_SESSION['user_id']."' and s.status='2' ";

	$query = mysql_query($sql) or die(mysql_error());
	
	echo "<a href='".$root."exp_live.php'>Go to Session screen</a>";
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				echo "<div>".$fetch['session_datetime']." Client: ".$fetch['fname']." ".$fetch['lname']."</div>";
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

