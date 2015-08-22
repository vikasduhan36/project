<?php 
	require_once('phpInclude/header.php');
	
	
$session_id = $_GET['id'];
$field = " *, (select GROUP_CONCAT(datetime) FROM session_time WHERE session_time.session_id=sessions.id) as time_request ";
$table = "sessions";
$condition = "and id='".$session_id."' ";
$session_detail = getDetail($field,$table,$condition);
?>
<form id="form_accept_session">
<input type="hidden" id="exp_id" name="exp_id" value="<?php echo $_SESSION['LoginUserId'];?>">
<?php
echo "<h3>".$session_detail[0]['title']."</h3>";
echo "<h4>".$session_detail[0]['description']."</h4>";


$time_request = explode(",",$session_detail[0]['time_request']);
echo "<h3>requested time</h3>";
foreach($time_request as $request)
{
	echo "<div><input type='checkbox' name='slot' value='".$request."'>".$request."</div>";
}
?>

<input type='button' id="alternative_dates" value='Alternative dates'>
<input type='button' id="alternative_dates_cancel" value='Cancel'>

<input type='button' name='accept_session' class="request_slot" value='Accept'>

Date:
<input type="text" name="date_schedule" id="request_schedule" readonly="readonly"  class="date_schedule" value=""/>
<div id="display_slot">
</div>
<input type="button" value="Request" class="request_slot">

<input type="hidden" name="type" value="accept">
<input type="hidden" name="action" value="submit_accept_session">
<input type="hidden" name="session_id" value="<?php echo $session_id;?>">
</form>
