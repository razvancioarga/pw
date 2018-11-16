<?php
	$username = $_POST['u'];
	$password = $_POST['p'];
	
	include_once('includes.php');
	
	$link = mysqli_connect($db_server, $db_user, $db_pass);
	
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	print "Connected successfully";
	
	mysqli_select_db($link, $db_name) or die(mysqli_connect_error());
	
	print "Database selected successfully";
	
	$q = sprintf("SELECT * FROM idusers WHERE u_email = '%s' AND u_password  = MD5('%s')", $username, $password);
	$res = mysqli_query($link, $q) or die(mysqli_error($link));
	
	if (mysqli_num_rows($res) > 0) {
		print "User logged in";
	} else {
		print "User NOT logged in";
	}
?>
	<img src="<?php print "\images\asdasd.png"; ?>" />
	