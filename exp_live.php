<?php 
	require_once('phpInclude/header.php');
	
	$sql  = " SELECT s.session_datetime,s.duration,s.title,s.description,s.question, ";
	$sql .= " u.id,u.fname,u.lname ";
	$sql .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id) ";
	$sql .= " WHERE s.exp_applied_id='".$_SESSION['LoginUserId']."' and s.status='2' ";
	$sql .= " and '".$date."' >= s.session_datetime and '".$date."' <= DATE_ADD(s.session_datetime, INTERVAL s.duration MINUTE)";
	
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if( mysql_num_rows($query) > 0 )
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				
				echo "<div>USER: ".$fetch['fname']." ".$fetch['lname']."</div>";
				echo "<div>DURATION:".$fetch['duration']."</div>";
				echo "<div>Scheduled at:".$fetch['session_datetime']."</div>";
				$endTime = date('Y-m-d H:i:s',strtotime($fetch['session_datetime'].' '.$fetch['duration'].' minutes'));
				$diff = daysRemaining($date,$endTime,true);		
				?>
				<span class="gray" id="day_time_timer_<?php echo $fetch['id'];?>" style="display:<?php if(($diff['Days'] > 0) || ($diff['Hours'] > 0)){echo 'none';}else{echo 'block';}?>;">
				<span id="days_<?php echo $fetch['id'];?>" class="tim" style='display:none;'><?php echo $diff['Days'];?></span>
				<span id="hours_<?php echo $fetch['id'];?>" style='display:none;'><?php echo $diff['Hours'];?></span>
				<span id="minutes_<?php echo $fetch['id'];?>"><?php echo $diff['Minutes'];?></span> min
				<span id="seconds_<?php echo $fetch['id'];?>"><?php echo $diff['Seconds'];?></span> seconds remaining
				</span>
				<script type="text/javascript">
					var user_id = "<?php echo $fetch['id'];?>";
					var sec = parseInt(document.getElementById('seconds_'+user_id).innerHTML);
					var min = parseInt(document.getElementById('minutes_'+user_id).innerHTML);
					var hrs = parseInt(document.getElementById('hours_'+user_id).innerHTML);
					var myVar=setInterval(function(){userTimer()},1000);
				</script>
 <?php
				
				echo "<hr>";
				
			}
			
		}
		else
		{
			?>
			<h3>No user has scheduled yet.</h3>
			<?php
		}
	}
	
	
	
?>	
	


<?php 
	require_once('phpInclude/footer.php');
?>

