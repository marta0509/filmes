<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Login</title>
</head>
<body>
	<H1>Login</H1>
	<form method="post" action="processa_login.php">
		<label>Nome de utilizador</label><input type="text" name="user_name" required><br>
		<label>Palavra-passe</label><input type="password" name="password" required><br>
		<input type="submit" name="login">
	</form>
</body>
</html>