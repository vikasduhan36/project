<?php
// Code For Open Data Base
function db_open()
{
	$DB_HOST     = 'localhost';
$DB_DATABASE = 'eyeask';
$DB_USER     = 'root';
$con = '';
	
	if(!isset($_SESSION))
	{
		session_start();		
	}
	if($con == NULL)
	{
			$con = @mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die(mysql_error());	
			mysql_select_db($DB_DATABASE);
	}
}
//Code For Close Data Base
function db_close($con)
	{
		if($con != NULL)
		{
			mysql_close($con);
    		$con = NULL;
		}
	}
?>