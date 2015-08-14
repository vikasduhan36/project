<?php 
	require_once 'config/dbconnection.php';
	db_open();
	require_once('phpInclude/function.php');
?>
<html>
<head>
<script type="text/javacsript">
var root = "<?php echo $root;?>";
</script>
<script src="<?php echo $root;?>js/jquery.min.js"></script>
<script src="<?php echo $root;?>js/jquery-ui.min.js"></script>
<script src="<?php echo $root;?>js/main.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>css/jquery-ui.css" />

</head>
<body>
