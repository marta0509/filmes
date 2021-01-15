<?php
session_start();

if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login']))
{
	
	if($_SERVER['REQUEST_METHOD']=="GET")
	{

		if (isset($_GET['utilizador'])&&is_numeric($_GET['utilizador'])) 
		{
			$utilizador=$_GET['utilizador'];
			if ($_SESSION['utilizador']!=$utilizador) {
				echo "Nao tem permição";
				exit;
			}
			$con=new mysqli("localhost","root","","filmes");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from utilizadores where id=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar utililizadores</h1>";
				$stm->bind_param("i",$utilizador);
				$stm->execute();
				$res=$stm->get_result();
				$utilizador=$res->fetch_assoc();
				$stm->close();
			}
	?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Editar Utilizadores</title>
			<link href="CSS/bootstrap.min.css" rel="stylesheet" >
			<link rel="stylesheet" href="CSS/jumbotrom.css">
			<link rel="stylesheet" href="CSS/all.min.css">
		</head>
		<body style="background: #BFFAF7">
			<form action="update_utilizadores.php" method="post">
				<label><b>Nome</b></label>
					<input class="form-control" type="text" name="nome" required value="<?php echo $utilizador['nome'];?>"><br>
					<label><b>User Name</b></label>
					<input class="form-control" type="text" name="user_name" value="<?php echo $utilizador['user_name'];?>"><br>
					<label><b>Password</b></label>
					<input class="form-control" type="text" name="password" value="<?php echo $utilizador['password'];?>"><br>
				<input type="submit" name="enviar"><br>
			</form>

			<script src="JS/jquery-3.5.1.min.js"></script>
			<script src="JS/bootstrap.min.js"></script>
			<script src="JS/all.min.js"></script>
		</body>
		</html>

<?php
}//if (isset($_GET['utilizador'])&&is_numeric($_GET['utilizador'])) 
	} //if($_SERVER['REQUEST_METHOD']=="GET")

} //if($_SESSION['login']=="correto" && isset($_SESSION['login']))

