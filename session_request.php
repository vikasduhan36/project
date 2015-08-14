<?php 
	require_once('phpInclude/header.php');

$session_id = $_GET['id'];
$field = " *, (select GROUP_CONCAT(datetime) FROM session_time WHERE session_time.session_id=sessions.id) as time_request ";
$table = "sessions";
$condition 	= "and id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
?>
<form id="form_accept_session">
<?php
echo "<h3>".$session_detail[0]['title']."</h3>";
echo "<h4>".$session_detail[0]['description']."</h4>";


$time_request = explode(",",$session_detail[0]['time_request']);
echo "<h3>requested time</h3>";
foreach($time_request as $request)
{
	echo "<div>".$request."</div>";
}

if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['exp_applied_id'] == $_SESSION['user_id'])
{
?>
<a href="<?php echo $baseurl.'session_accept.php?id='.$session_id;?>">
<input type='button'  value='Accept'>
</a>
<input type='button' name='reject_session' id='reject_session' value='Reject'>
<?php
}
else if($session_detail[0]['type'] == 'schedule' && $session_detail[0]['user_id'] == $_SESSION['user_id'])
{
	?>
	
	<input type='button'  value='Waiting for reply'>
	
	<input type='button' name='cancel_session' id='cancel_session' value='Cancel'>

	<?php
}
?>
</form>
