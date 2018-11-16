<?php
	include_once('includes.php');
	
	$link = mysqli_connect($db_server, $db_user, $db_pass);

	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_select_db($link, $db_name) or die(mysqli_connect_error());

	$userid = $_GET['userid'];
	
	if ($userid != '') {
		$qD = sprintf("DELETE FROM idusers WHERE u_id = %s", $userid);
		mysqli_query($link, $qD) or die(mysqli_error($link));
	}
	
	?>
		<script type="text/javascript">
			document.location = 'users.php';
		</script>
