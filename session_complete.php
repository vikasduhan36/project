<?php 
	require_once('phpInclude/header_live.php');
	require_once('phpInclude/function.php');
	if(isset($_GET['id']))
	{
		$sql = " UPDATE sessions SET status = '3' WHERE id='".$_GET['id']."' and user_id='".$_SESSION['LoginUserId']."' ";
		$query = mysql_query($sql);
	}
	?>

	 <div class="screenotr"><!-- ALL SCREEN OUTER -->
        <div class="MainVideoCont">
                <div id="mainvideo"></div><!-- Main Video -->
            </div>
			<div class="SessionMsg" style="display:table;"><!-- Session Message -->
            	<div class="sessiontext">
                	
                	<p>Your session has been completed successfully. <br>Thanks for your participation.<br><a href="<?php echo $root?>user_sessions.php?tab=schedule">Return to dashboard</a></p>	
                </div>
            </div><!-- Session Message -->
             </div><!-- ALL SCREEN OUTER -->
        
    </div>

	
<?php 
	require_once('phpInclude/footer_live.php');
?>

