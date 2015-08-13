<?php
global $root, $con,$adminRoot ,$date;

//local database configuration ////////////
$DB_HOST     = 'localhost';
$DB_DATABASE = 'eyeask';
$DB_USER     = 'root';
$DB_PASSWORD = '';
$root        = "http://localhost/donow/donow/"; 
$adminRoot	 = "http://localhost/donow/donow/admin/";
$adminRecordsPerPage = 10;
$defaultProfileImage = "defaultavtar.jpg";
date_default_timezone_set('Australia/Melbourne');
$date = date("Y-m-d H:i:s");


?>