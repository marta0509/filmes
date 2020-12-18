<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$nome="";
	$data_nascimento="";
	$nacionalidade="";

	if (isset($_POST['nome']))
	{
		$nome=$_POST['nome'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if(isset($_POST['data_nascimento']))
	{
		$data_nascimento=$_POST['data_nascimento'];
	}
	if (isset($_POST['nacionalidade']))
	{
		$nacionalidade=$_POST['nacionalidade'];
	}

	$con = new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into atores(nome,data_nascimento,nacionalidade) values(?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('sss',$nome,$data_nascimento,$nacionalidade);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Ator adcionado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:5;url=index_atores.php");
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
		<title>Adicionar Atores</title>
		<link href="CSS/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="CSS/jumbotrom.css">
		<link rel="stylesheet" href="CSS/all.min.css">
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar atores</h1>
		<form action="create_atores.php" method="post">
			<label><b>Nome</b></label>
			<input class="form-control" type="text" name="nome" required=""><br>
			<label><b>Data Nascimento</b></label>
			<input class="form-control" type="text" name="data_nascimento"><br>
			<label><b>Nacionalidade</b></label>
			<input class="form-control" type="text" name="nacionalidade"><br>
		
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