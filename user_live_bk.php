<?php 
	require_once('phpInclude/header.php');
	require_once 'SDK/OpenTokSDK.php';
    require_once 'SDK/OpenTokArchive.php';
    require_once 'SDK/OpenTokSession.php';
	
	$userTimezone = getUserTimezone($_SESSION['LoginUserId']);
	$exp_id = $_GET['id'];
	$sql  = " SELECT s.session_datetime,s.duration,s.title,s.description,s.question,s.status, ";
	$sql .= " u.fname,u.lname,u.id,u.tokbox_id ";
	$sql .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id) ";
	$sql .= " WHERE s.exp_applied_id='".$exp_id."' and s.status='2' and s.user_id='".$_SESSION['LoginUserId']."' ";
	//$sql .= " and '".$date."' >= s.session_datetime and '".$date."' <= DATE_ADD(s.session_datetime, INTERVAL s.duration MINUTE)";
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if( mysql_num_rows($query) > 0 )
		{
			$fetch = mysql_fetch_assoc($query);
			//{
				$datetime = convertTimezone($fetch['session_datetime'],$default_tz,$userTimezone['timezone']);
				if($fetch['status'] == '3')
				{
					echo '<a href="javascript:void(0);" class="sess_btn">Your session has been completed.</a>';
				}
				else if(strtotime($date) < strtotime($fetch['session_datetime']))
				{
					
					
					echo '<h3>Your session will start at: '.$datetime.'</h3>';
				}
				else if(strtotime($date) > strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES "))
				{
					
					
					echo '<h3>Your session has been missed, session was scheduled at : '.$datetime.'</h3>';
				}
				else if((strtotime($date) >= strtotime($fetch['session_datetime']))&&(strtotime($date) <= strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES ")))
				{
				
					$field = " tokbox_id ";
					$table = " users ";
					$condition = " AND id = '".$exp_id."' ";
					$user_dt = getDetail($field,$table,$condition);
					
					$sessionId = $user_dt[0]['tokbox_id'];
					
					
					$apiObj = new OpenTokSDK($tokboxApi, $tokboxApiSecret);
					
					$tokenId=$apiObj->generate_token($sessionId, RoleConstants::PUBLISHER, null, 'expert'); 
					?>
					<script type="text/javascript" src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js" ></script> 	<!-- FOR OPENTOK WEBRTC --> 
					<script type="text/javascript">
						
					var type="user";

					var apiKey			 = "<?php echo $tokboxApi;?>";
					var apiSecret		 = "<?php echo $tokboxApiSecret;?>";
					var sessionId		 = "<?php echo $sessionId;?>";  												//tokbox id to start live session
					var token			 = "<?php echo $tokenId;?>";						
					var session			 = "";
					var publisher		 = "";
					var subscribers 	 = {};
					var cameras			 = "";
					var myCameraWidth 	 = 536;																				//Inset stram width
					var myCameraHeight 	 = 400;	
					var connections 	 = {};
					var connection_id;
					var streamcount 	 = null;
					var connectionCount  = 0;
					var VIDEO_HEIGHT	 = 154;
					var VIDEO_WIDTH 	 = 270;
						
						</script>
						<script src="<?php echo $root;?>js/exp_video.js"></script>
						<?php
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
	

<h3>Expert</h3>
	<div id="myCamera"></div>
<?php 
	require_once('phpInclude/footer.php');
?>

