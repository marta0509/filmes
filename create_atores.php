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
	</head>
	<body>
		<h1>Adicionar atores</h1>
		<form action="create_atores.php" method="post">
			<label>Nome</label>
			<input type="text" name="nome" required=""><br>
			<label>Data Nascimento</label>
			<input type="text" name="data_nascimento"><br>
			<label>Nacionalidade</label>
			<input type="text" name="nacionalidade"><br>
		
			<input type="submit" name="enviar"><br>
		</form>
	</body>
	</html>

	<?php
		}
	?>