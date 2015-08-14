<?php 
	require_once('phpInclude/header.php');
	
?>

<form id="form_add_avail">
	<div class="availability_outer">
	<div class="availability">
	Date
	
	<input type="text" name="date_avail[]" readonly="readonly"  class="date_pick" value=""/>
	
	
	Time From
	<select name="timefrom[]" class="time_from">
	
	<?php
	$availability = default_availability();
	foreach($availability as $avail)
	{
		echo "<option value='".$avail."' ";
		if($avail == '09:00:00')
		{
			echo " selected='selected' ";
		}
		echo " >".date('h:i a',strtotime($avail))."</option>";
	}
	?>
	</select>
	Time To
	<select name="timeto[]" class="time_to">
	
	<?php
	$availability = default_availability();
	foreach($availability as $avail)
	{
		echo "<option value='".$avail."' ";
		if($avail == '17:00:00')
		{
			echo " selected='selected' ";
		}
		echo " >".date('h:i a',strtotime($avail))."</option>";
	}
	?>
	</select>
	
	</div>
	</div>
	<input type="button" value="+add more" id="add_more_avail">
	<input type="hidden" name="action" value="submit_add_avail" >
	<input type="button"  value="submit" id="submit_add_avail">
	

</form>
