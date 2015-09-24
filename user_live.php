<?php 
	require_once('phpInclude/header_live.php');
	require_once('phpInclude/function.php');
	require_once 'SDK/OpenTokSDK.php';
    require_once 'SDK/OpenTokArchive.php';
    require_once 'SDK/OpenTokSession.php';
	?>

	 <div class="screenotr"><!-- ALL SCREEN OUTER -->
        <div class="MainVideoCont">
                <div id="mainvideo"></div><!-- Main Video -->
            </div>
			
	<?php
	$userTimezone = getUserTimezone($_SESSION['LoginUserId']);
	$id = $_GET['id'];
	$sql  = " SELECT s.time_requested,s.session_datetime,s.duration,s.title,s.description,s.question,s.status,s.exp_applied_id, ";
	$sql .= " u.fname,u.lname,u.id,u.tokbox_id ";
	$sql .= " FROM sessions as s LEFT JOIN users as u ON(s.user_id = u.id) ";
	$sql .= " WHERE s.id='".$id."' and s.user_id='".$_SESSION['LoginUserId']."' ";
	//$sql .= " and '".$date."' >= s.session_datetime and '".$date."' <= DATE_ADD(s.session_datetime, INTERVAL s.duration MINUTE)";
	
	$query = mysql_query($sql) or die(mysql_error());
	if($query)
	{
		if( mysql_num_rows($query) > 0 )
		{
			$fetch = mysql_fetch_assoc($query);
			$datetime = convertTimezone($fetch['session_datetime'],$default_tz,$userTimezone['timezone']);
			if($fetch['status'] == '3')
			{
				
				?>
			
			<div class="SessionMsg" style="display:table;"><!-- Session Message -->
            	<div class="sessiontext">
                	
                	<p>Your session has been completed.<a href="<?php echo $root?>user_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>
			<?php
			}
			else if(strtotime($date) < strtotime($fetch['session_datetime']))
			{
				
				?>
			
			<div class="SessionMsg" style="display:table;"><!-- Session Message -->
            	<div class="sessiontext">
                	
                	<p>Your session will start at: <?php echo formatDate($datetime);?><a href="<?php echo $root?>user_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>
			<?php
				
			}
			else if(strtotime($date) > strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES "))
			{
				
				
				?>
			
			<div class="SessionMsg" style="display:table;"><!-- Session Message -->
            	<div class="sessiontext">
                	
                	<p>Your session time has been passed.<br><a href="<?php echo $root?>user_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>
			<?php
			}
			else if(($fetch['time_requested'] == '1') || ((strtotime($date) >= strtotime($fetch['session_datetime']))&&(strtotime($date) <= strtotime($fetch['session_datetime']."+".$fetch['duration']." MINUTES "))))
			{
		$field = " tokbox_id ";
					$table = " users ";
					$condition = " AND id = '".$fetch['exp_applied_id']."' ";
					$user_dt = getDetail($field,$table,$condition);
					
					$sessionId = $user_dt[0]['tokbox_id'];
					
    $apiObj = new OpenTokSDK($tokboxApi, $tokboxApiSecret);
    
	$tokenId=$apiObj->generate_token($sessionId, RoleConstants::PUBLISHER, null, $_SESSION['LoginUserId']); 
	
	
			?>
			<div class="SmallVideoCont">
                <div id="smallvideo"></div><!-- Small Video -->
            </div>
			<div id="exp_id"><?php echo $fetch['exp_applied_id'];?></div>
				<script type="text/javascript">
var root = "<?php echo $root;?>";	
var type="user";
var s_id = "<?php echo $id;?>";
var apiKey			 = "<?php echo $tokboxApi;?>";
var apiSecret		 = "<?php echo $tokboxApiSecret;?>";
var sessionId		 = "<?php echo $sessionId;?>";  												//tokbox id to start live session
var token			 = "<?php echo $tokenId;?>";	
var my_id = "<?php echo $_SESSION['LoginUserId'];?>";					
var session			 = "";
var publisher		 = "";
var subscribers 	 = {};
var cameras			 = "";
var myCameraWidth 	 = '100%';																				//Inset stram width
var myCameraHeight 	 = '100%';	
var connections 	 = {};
var connection_id;
var streamcount 	 = null;
var connectionCount  = 0;
var VIDEO_HEIGHT	 = '100%';
var VIDEO_WIDTH 	 = '100%';
var newTimer 		 = '';	
    </script>
	 <script type="text/javascript" src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js" ></script> 	<!-- FOR OPENTOK WEBRTC --> 
	<script src="<?php echo $root;?>js/user_video.js"></script>
	
			<script>
			$(document).ready(function(){
				
				$(".session_nav,.sess_timer").fadeIn();
				
			});
			</script>
			 </div><!-- ALL SCREEN OUTER -->
        <?php
					$endTime = date('Y-m-d H:i:s',strtotime($fetch['session_datetime'].' '.$fetch['duration'].' minutes'));
					$diff = daysRemaining($date,$endTime,true);		
		 ?>
					<span class="gray" id="day_time_timer" style="display:none;">
					<span id="days" class="tim" style='display:none;'><?php echo $diff['Days'];?></span>
					<span id="hours" style='display:none;'><?php echo $diff['Hours'];?></span>
					<span id="minutes"><?php echo $diff['Minutes'];?></span> min
					<span id="seconds"><?php echo $diff['Seconds'];?></span> seconds remaining
					</span>
					<script type="text/javascript">
						var sec = parseInt(document.getElementById('seconds').innerHTML);
						var min = parseInt(document.getElementById('minutes').innerHTML);
						var hrs = parseInt(document.getElementById('hours').innerHTML);
						document.getElementById('seconds_hd').innerHTML = preced_zero(sec);
						document.getElementById('minutes_hd').innerHTML = preced_zero(min);
						document.getElementById('hours_hd').innerHTML = preced_zero(hrs);
						var myVar=setInterval(function(){myTimer('hd')},1000);
					</script>
    </div>
	
		
			<div class="OtherUserList ">
    	<a href="javascript:void(0);" class="closebtn">X</a>
        <div class="vlist_otr">
        <div class="content blkheight user_online_detail " id="scrollbar">
		
		 <h2 id="no_user">
				No other user is online.
				</h3>
			</div>
        </div>
    </div>
			<?php
			
			
		}
		else
		{
			?>
			
			<div class="SessionMsg" style="display:table;"><!-- Session Message -->
            	<div class="sessiontext">
                	
                	<p>No scheduled session found.<a href="<?php echo $root?>user_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>
			<?php
		}
	}
	}
	
	
?>


	
<?php 
	require_once('phpInclude/footer_live.php');
?>

