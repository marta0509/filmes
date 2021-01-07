<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$titulo="";
	$sinopse="";
	$idioma="";
	$data_lancamento="";
	$quantidade=0;

	if (isset($_POST['titulo']))
	{
		$titulo=$_POST['titulo'];
	}
	else
	{
		echo '<script>alert("É obrigatório o preenchimento do título.");</script>';
	}
	if (isset($_POST['sinopse'])) 
	{
		$sinopse=utf8_decode($_POST['sinopse']);
	}
	if (isset($_POST['quantidade'])&&is_numeric($_POST['quantidade']))
	{
		$quantidade=$_POST['quantidade'];
	}
	if(isset($_POST['idioma']))
	{
		$idioma=$_POST['idioma'];
	}
	if(isset($_POST['data_lancamento']))
	{
		$data_lancamento=$_POST['data_lancamento'];
	}

	$con = new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}

	else
	{
		$sql='insert into filmes(titulo,sinopse,idioma,quantidade,data_lancamento) values(?,?,?,?,?)';
		$stm=$con->prepare($sql);
		if($stm!=false)
		{
			$stm->bind_param('sssis',$titulo,$sinopse,$idioma,$quantidade,$data_lancamento);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Filme adcionado com sucesso");</script>';
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
		<title>Adicionar filmes</title>
		<link href="CSS/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="CSS/jumbotrom.css">
		<link rel="stylesheet" href="CSS/all.min.css">
	</head>
	<body style="background: #BFFAF7">
		<h1 style="color: darkblue">Adicionar filmes</h1>
		<form action="create.php" method="post">
			<label><b>Título</b></label>
			<input class="form-control" type="text" name="titulo" required=""><br>
			<label><b>Sínopse</b></label>
			<input class="form-control" type="text" name="sinopse"><br>
			<label><b>Quantidade</b></label>
			<input class="form-control" type="text" name="quantidade"><br>
			<label><b>Idioma</b></label>
			<input class="form-control" type="text" name="idioma"><br>
			<label><b>Data Lançamento</b></label>
			<input class="form-control" type="date" name="data_lancamento"><br>
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