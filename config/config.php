<?php
if(!isset($_SESSION))
{
 session_start();		
}
global $root, $con,$adminRoot, $defaultProfileImage, $date, $pagename, $default_tz ,$fromMail, $default_tz_name,$is_expert, $tokboxApi, $tokboxApiSecret;

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
$default_tz_name = 'GMT';
$fromMail = "sricky555@gmail.com";
$tokboxApi = 45331532;
$tokboxApiSecret = '1216ee36e813250d5d3ad1a94c81fdb14946bbb6';

#### TWITTER Authentication ####
define('YOUR_CONSUMER_KEY', 'HLRGHrhYdKE6lW9QDvf5EVI0f');
define('YOUR_CONSUMER_SECRET', 'pERV0hWVL7mFr2fKMftUkVC0tB6CnjnVy207TUgb3LHj6qfVDY');


?>