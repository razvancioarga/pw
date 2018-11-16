<?php
	include_once('includes.php');
	
	$link = mysqli_connect($db_server, $db_user, $db_pass);

	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_select_db($link, $db_name) or die(mysqli_connect_error());

	$userid = $_GET['userid'];
	
	$user = array();
	$user['u_id'] = '';
	$user['u_first_name'] = '';
	$user['u_last_name'] = '';
	$user['u_email'] = '';

	if ($userid != '') {	
		if (!is_numeric($userid)) {
			print 'NOT NUMERIC';
			exit();
		}
		$q = sprintf("SELECT * FROM idusers WHERE u_id = %s", $userid);
		$res = mysqli_query($link, $q) or die(mysqli_error($link));
	
		if (mysqli_num_rows($res) > 0) {
			$user = mysqli_fetch_assoc($res);
		}
	}
	
	if (isset($_POST['issubmitted'])) {
		$issubmitted = $_POST['issubmitted'];
		if($issubmitted == '1') {
			// atunci vreau sa salvez
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$userid = $_POST['userid'];
			
			if ($userid != '') {
				$qU = sprintf("UPDATE idusers SET u_first_name = '%s', u_last_name = '%s', u_email = '%s', u_password = MD5('%s') WHERE u_id = %s", $first_name, $last_name, $email, $password, $userid);
				mysqli_query($link, $qU) or die(mysqli_error($link));
			} else {
				$qU = sprintf("INSERT INTO idusers (u_first_name, u_last_name, u_email, u_password) VALUES ('%s', '%s', '%s', '%s')", $first_name, $last_name, $email, $password);
				mysqli_query($link, $qU) or die(mysqli_error($link));
			}
			
			?>
				<script type="text/javascript">
					document.location = 'users.php';
				</script>
			<?php
			
			exit();
		}
	}
?>

<html>
	<head>
		<title><?php if ($userid == '') { print 'Utilizator nou'; } else { print $user['u_first_name'] . ' ' . $user['u_last_name']; } ?>
		</title>
	</head>
	
	<body>
		<form method="POST">
			<label for="first_name">Prenume</label><input type="text" name="first_name" id="first_name" value="<?php print $user['u_first_name']; ?>" /><br />
			<label for="last_name">Nume</label><input type="text" name="last_name" id="last_name" value="<?php print $user['u_last_name']; ?>" /><br />
			<label for="email">Email</label><input type="text" name="email" id="email" value="<?php print $user['u_email']; ?>" /><br />
			<label for="password">Parola</label><input type="password" name="password" id="password" value="" /><br />
			<input type="hidden" name="userid" value="<?php print $userid; ?>" />
			<input type="hidden" name="issubmitted" value="1" />
			<input type="submit" value="Salveaza"/>
		</form>
	</body>
	
</html>