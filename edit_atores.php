<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&&isset($_SESSION['login']))
{
		$con=new mysqli("localhost","root","","filmes");
		if($con->connect_errno!=0)
		{
			echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
			exit;
		}
		else
		{
	?>
			<?php
	if ($_SERVER['REQUEST_METHOD']=="GET")
	{
		if (isset($_GET['ator'])&&is_numeric($_GET['ator'])) 
		{
			$ator=$_GET['ator'];
			$con=new mysqli("localhost","root","","filmes");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from atores where id_ator=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar atores</h1>";
				$stm->bind_param("i",$ator);
				$stm->execute();
				$res=$stm->get_result();
				$ator=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar ator</title>
				<link href="CSS/bootstrap.min.css" rel="stylesheet" >
				<link rel="stylesheet" href="CSS/jumbotrom.css">
				<link rel="stylesheet" href="CSS/all.min.css">
			</head>
			<body style="background: #BFFAF7">
				<form action="update_atores.php" method="post">
					<label><b>Nome</b></label>
					<input class="form-control" type="text" name="nome" required value="<?php echo $ator['nome'];?>"><br>
					<label><b>Data Nascimento</b></label>
					<input class="form-control" type="text" name="data_nascimento" value="<?php echo $ator['data_nascimento'];?>"><br>
					<label><b>Nacionalidade</b></label>
					<input class="form-control" type="text" name="nacionalidade" value="<?php echo $ator['nacionalidade'];?>"><br>
					<input class="form-control" type="hidden" name="id_ator" value="<?php echo $ator['id_ator'];?>"><br>
					<input type="submit" name="enviar"><br>
				</form>

				<script src="JS/jquery-3.5.1.min.js"></script>
				<script src="JS/bootstrap.min.js"></script>
				<script src="JS/all.min.js"></script>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index_atores.php");
				}
		}
	}
		
			}//end if -if($con->connect_errno!=0)
		
else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:3;url=login.php');
}
?>
<br>
<!--<a href="processa_logout.php">Sair</a>-->