<?php
	include_once('includes.php');
	
	$link = mysqli_connect($db_server, $db_user, $db_pass);

	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_select_db($link, $db_name) or die(mysqli_connect_error());

	$users = array();
	
	$q = sprintf("SELECT * FROM idusers");
	$res = mysqli_query($link, $q) or die(mysqli_error($link));
	
	if (mysqli_num_rows($res) > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$users[] = $row;
		}
	}
?>

<html>
	<head>
		<title>Utilizatori</title>
	</head>
	
	<body>
		<a href="user.php?userid=">Adauga un utilizator nou </a>
		<?php
			if (count($users) > 0) {
				?>
					<table border="1">
						<tr>
							<th>ID</th>
							<th>Prenume</th>
							<th>Nume</th>
							<th>Email</th>
							<th>Ops</th>
							<th></th>
						</tr>
						<?php
							foreach($users as $k => $v) {
								print sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href="user.php?userid=%s" >Modifica</a></td><td><a href="" onclick="deleteuser(%s); return false;">Sterge</a></td></tr>', $v['u_id'], $v['u_first_name'], $v['u_last_name'], $v['u_email'], $v['u_id'], $v['u_id']);
							}
						?>
					</table>
				<?php
			} else {
				print 'Nu sunt utilizatori inregistrati in sistem';
			}
		?>
	<script type="text/javascript">
		function deleteuser(id) {
			if (!confirm("Doriti sa stergeti inregistrarea?")) {
				return;
			}
			
			document.location = 'delete.php?userid=' + id;
		}
	</script>
	</body>
</html>

