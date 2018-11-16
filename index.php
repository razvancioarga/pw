<html>
	<head>
		<title><?php print "PW"; ?></title>
		
	</head>
	
	<body>
		<form action="code.php" method="POST" >
			<label for="u">Username:</label>
			<input type="text" name="u" id="u"/>
			<label for="p">Password: </label>
			<input type="password" name="p" id="p"/>
			
			<input type="submit" value="Login" />
		</form>
	</body>
</html>