<?php 
	require_once('phpInclude/header.php');
	$exp_id = $_GET['id'];
	$sql  = " SELECT s.session_datetime,s.duration,s.title,s.description,s.question, ";
	$sql .= " u.fname,u.lname,u.id ";
	$sql .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id) ";
	$sql .= " WHERE s.exp_applied_id='".$exp_id."' and s.status='2' and s.user_id='".$_SESSION['LoginUserId']."' ";
	$sql .= " and '".$date."' >= s.session_datetime and '".$date."' <= DATE_ADD(s.session_datetime, INTERVAL s.duration MINUTE)";
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if( mysql_num_rows($query) > 0 )
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				
			$endTime = date('Y-m-d H:i:s',strtotime($fetch['session_datetime'].' '.$fetch['duration'].' minutes'));
			$diff = daysRemaining($date,$endTime,true);		
 ?>
			<span class="gray" id="day_time_timer" style="display:<?php if(($diff['Days'] > 0) || ($diff['Hours'] > 0)){echo 'none';}else{echo 'block';}?>;">
			<span id="days" class="tim" style='display:none;'><?php echo $diff['Days'];?></span>
			<span id="hours" style='display:none;'><?php echo $diff['Hours'];?></span>
			<span id="minutes"><?php echo $diff['Minutes'];?></span> min
			<span id="seconds"><?php echo $diff['Seconds'];?></span> seconds remaining
			</span>
            <script type="text/javascript">
                var sec = parseInt(document.getElementById('seconds').innerHTML);
                var min = parseInt(document.getElementById('minutes').innerHTML);
                var hrs = parseInt(document.getElementById('hours').innerHTML);
                var myVar=setInterval(function(){userTimer()},1000);
            </script>
 <?php
				echo "<div>Scheduled at:".$fetch['session_datetime']."</div>";
				echo "<div>DURATION:".$fetch['duration']." minutes</div>";
				echo "<hr>";
	
			}
			
		}
		else
		{
			?>
			<h3>No scheduling.</h3>
			<?php
		}
	}
	
	
	
?>	
	


<?php 
	require_once('phpInclude/footer.php');
?>

