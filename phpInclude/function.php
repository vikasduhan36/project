<?php
function convertTimezone($dateTime,$from_tz,$to_tz)
{
		if($from_tz > 0)
		{
			$from_tz = "+".$from_tz;
		}
		if($to_tz > 0)
		{
			$to_tz = "+".$to_tz;
		}
		$from_tz = substr($from_tz,0,6);
		$to_tz = substr($to_tz,0,6);
		$sql = " SELECT CONVERT_TZ('".$dateTime."','".$from_tz."','".$to_tz."') as dateTime ";
		$result = mysql_fetch_assoc(mysql_query($sql));
		return $datetime = $result['dateTime'];
}

function getDetail($field,$table,$condition)
{
	$result = array();
	$sql = " SELECT ".$field." FROM ".$table." WHERE 1=1 ".$condition;
	$query = mysql_query($sql);
	if($query)
	{
		if(mysql_num_rows($query) > 0)
		{
			while($fetch = mysql_fetch_assoc($query))
			{
				$result[] = $fetch;
			}
		}
	}
	return $result;
}

function default_availability()
{
	$result = array();

	for($i = 0; $i < 24; $i++)
	{
		$result[] = date("H:i:s", strtotime("$i:00"));
	}
	return $result;
}	
	
function getUserTimezone($user_id)
{
	$sql = " SELECT t.* FROM timezone as t inner join users as u ON(t.id=u.timezone_id) WHERE u.id='".$user_id."' ";
	$query = mysql_query($sql);
	$result = array();
	if($query)
	{
		$result = mysql_fetch_assoc($query);
	}
	return $result;
}
function getWeekday($selected = null)
{
	$day_name = array("1"=>"Monday","2"=>"Tuesday","3"=>"Wednesday","4"=>"Thursday","5"=>"Friday","6"=>"Saturday","7"=>"Sunday");
	foreach($day_name as $key => $value)
	{
		echo "<option value='".$key."' ";
		if(!empty($selected) && $key == $selected)
		{
			echo " selected='selected' ";
		}
		echo " >".$value."</option>";
	}
}

function daysRemaining($currentDate,$end,$out_in_array=false){
 
    $intervalo = date_diff(date_create($currentDate), date_create($end));
    $out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
    if(!$out_in_array)
        return $out;
    $a_out = array();
    array_walk(explode(',',$out),
            function($val,$key) use(&$a_out){
        $v=explode(':',$val);
        $a_out[$v[0]] = $v[1];
    });
    return $a_out;
}
?>