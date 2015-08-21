<?php
if(!isset($_SESSION))
{
 session_start();		
}
global $root, $con,$adminRoot, $defaultProfileImage, $date, $pagename, $default_tz;

$_SESSION['user_id'] = '2';	
$con = '';
//local database configuration ////////////
$DB_HOST     = 'localhost';
$DB_DATABASE = 'eyeask';
$DB_USER     = 'root';
$DB_PASSWORD = '';
$root        = "http://localhost/project/"; 
$adminRoot	 = "http://localhost/project/admin/";
$defaultProfileImage = "defaultavtar.jpg";
$pagename 		= basename($_SERVER['SCRIPT_NAME']);
date_default_timezone_set('UTC');
$date = date('Y-m-d H:i:s');
$default_tz = '+00:00:00';

?>