<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$nome="";
	$user_name="";
	$password="";

	if (isset($_POST['nome']))
	{
		$nome=$_POST['nome'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['user_name'])) 
	{
		$user_name=utf8_decode($_POST['user_name']);
	}
	if(isset($_POST['password']))
	{
		$passsword=$_POST['password'];
		$passencriptada=password_hash($password, PASSWORD_DEFAULT);
	}
	

	$con = new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into utilizadores(nome,user_name,password) values(?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('sss',$nome,$user_name,$passencriptada);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Utilizador adcionado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:1;url=index.php");
		}
	}
}
else
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Adicionar Utilizadores</title>
		<link href="CSS/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="CSS/jumbotrom.css">
		<link rel="stylesheet" href="CSS/all.min.css">
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar utilizador</h1>
		<form action="create_utilizadores.php" method="post">
			<label><b>Nome</b></label>
			<input class="form-control" type="text" name="nome" required=""><br>
			<label><b>User Name</b></label>
			<input class="form-control" type="text" name="user_name"><br>
			<label><b>Password</b></label>
			<input class="form-control" type="text" name="password"><br>
			<input type="submit" name="enviar"><br>
		</form>

		<script src="JS/jquery-3.5.1.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/all.min.js"></script>
	</body>
	</html>

	<?php
		}
	?>