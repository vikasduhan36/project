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
		
		$field = " tokbox_id ";
	$table = " users ";
	$condition = " AND id = '".$_SESSION['LoginUserId']."' ";
	$user_dt = getDetail($field,$table,$condition);
	
	$sessionId = $user_dt[0]['tokbox_id'];
    
    $apiObj = new OpenTokSDK($tokboxApi, $tokboxApiSecret);
    
	$tokenId=$apiObj->generate_token($sessionId, RoleConstants::PUBLISHER, null, 'exp'); 
	
	
			?>
				<script type="text/javascript">
	
var type="exp";

var apiKey			 = "<?php echo $tokboxApi;?>";
var apiSecret		 = "<?php echo $tokboxApiSecret;?>";
var sessionId		 = "<?php echo $sessionId;?>";  												//tokbox id to start live session
var token			 = "<?php echo $tokenId;?>";						
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
	
    </script>
	 <script type="text/javascript" src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js" ></script> 	<!-- FOR OPENTOK WEBRTC --> 
	<script src="<?php echo $root;?>js/exp_video.js"></script>
	
			<script>
			$(document).ready(function(){
				$(".SessionInner").addClass("opened_userlist");
				$(".session_nav").fadeIn();
			});
			</script>
			 </div><!-- ALL SCREEN OUTER -->
        
    </div>
	<div class="OtherUserList userlist_opened">
    	<a href="javascript:void(0);" class="closebtn">X</a>
        <div class="vlist_otr">
        <div class="content blkheight " id="scrollbar">
		
                <h2 id="no_user">
				No user is online.
				</h3>
			
			<?php
			
			while($fetch = mysql_fetch_assoc($query))
			{
			
				$endTime = date('Y-m-d H:i:s',strtotime($fetch['session_datetime'].' '.$fetch['duration'].' minutes'));
				$diff = daysRemaining($date,$endTime,true);		
				?>
				
				
				
			
        	<div class="v_blk_otr" style="display:none;">
            	<div class="v_blk_innr" id="user_<?php echo $fetch['id']?>" ></div>
                <h6><?php echo $fetch['fname']." ".$fetch['lname'];?></h6>
                <span class="time_es" id="timer_<?php echo $fetch['id'];?>"></span>
				
				<span style="display:none;">
				<span id="days_<?php echo $fetch['id'];?>" class="tim" style='display:none;'><?php echo $diff['Days'];?></span>
				<span id="hours_<?php echo $fetch['id'];?>" ><?php echo $diff['Hours'];?></span>:
				<span id="minutes_<?php echo $fetch['id'];?>"><?php echo $diff['Minutes'];?></span>: 
				<span id="seconds_<?php echo $fetch['id'];?>"><?php echo $diff['Seconds'];?></span>
				
				</span>
				
				<script type="text/javascript">
					var user_id = "<?php echo $fetch['id'];?>";
					
					var sec = parseInt(document.getElementById('seconds_'+user_id).innerHTML);
					var min = parseInt(document.getElementById('minutes_'+user_id).innerHTML);
					var hrs = parseInt(document.getElementById('hours_'+user_id).innerHTML);
					
					document.getElementById('seconds_'+user_id).innerHTML = preced_zero(sec);
					document.getElementById('minutes_'+user_id).innerHTML = preced_zero(min);
					document.getElementById('hours_'+user_id).innerHTML = preced_zero(hrs);
					
					userTimer(user_id);
				</script>
            </div>
    
				<?php
			}
			?>
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
                	
                	<p>No user has scheduled at this moment.<a href="<?php echo $root?>exp_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>
			<?php
		}
	}
	
?>


	
<?php 
	require_once('phpInclude/footer_live.php');
?>

