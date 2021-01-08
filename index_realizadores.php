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
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Realizadores</title>
			<link href="CSS/bootstrap.min.css" rel="stylesheet" >
			<link rel="stylesheet" href="CSS/jumbotrom.css">
			<link rel="stylesheet" href="CSS/all.min.css">
		</head>
		<body style="background: #BFFAF7">
			<h1 style="color: darkblue">Lista de Realizadores</h1>
			<br>
			<?php
				$stm=$con->prepare('select * from realizadores');
				$stm->execute();
				$res=$stm->get_result();
				while ($resultado=$res->fetch_assoc())
				{
					echo '<a href="edit_realizadores.php?realizador='.$resultado['id_realizador'].'"><i style="color:blue" class="fas fa-pen"></i>';
					echo '</a>'.' ';
					echo '<a style="color:black" href="realizadores_show.php?realizador='.$resultado['id_realizador'].'"><i style="color:blue" class="far fa-eye"></i>';
					echo '</a>'.' ';
					echo '<a href="delete_realizadores.php?realizador='.$resultado['id_realizador'].'"><i style="color:blue" class="fas fa-eraser"></i>';
					echo '</a>'.' ';
					echo '<b>'.$resultado['nome'].'</b>';
					echo "<br>";
				}
				$stm->close();
			?>
			<br>
			<a href="create_realizadores.php">Criar um novo registo</a>
		<br>
		
		<script src="JS/jquery-3.5.1.min.js"></script>
		<script src="JS/bootstrap.min.js"></script>
		<script src="JS/all.min.js"></script>
		</body>
		</html>


		<?php
			}//end if -if($con->connect_errno!=0)
		
}
else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:3;url=login.php');
}
?>
<br>
<a href="processa_logout.php">Sair</a>