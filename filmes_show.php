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
				if (!isset($_GET['filme']) || !is_numeric($_GET['filme'])) {
					echo '<script>alert("Erro ao abrir Filme");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index.php");
					exit();		
				}	
				$idFilme=$_GET['filme'];
				$con=new mysqli("localhost","root","","filmes");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from filmes where id_filme=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idFilme);
						$stm->execute();
						$res=$stm->get_result();
						$filme=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index.php");
				}
			}
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Detalhes</title>
			<link href="CSS/bootstrap.min.css" rel="stylesheet" >
			<link rel="stylesheet" href="CSS/jumbotrom.css">
			<link rel="stylesheet" href="CSS/all.min.css">
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes do filme</H1>
			<?php
				if (isset($filme)) {
					echo "<br>";
					echo "<b>Ttulo:</b>";
					echo $filme['titulo'];
					echo "<br>";
					echo "<b>Sinopse:</b>";
					echo utf8_encode($filme['sinopse']);
					echo "<br>";
					echo "<b>Data de Lançamento:</b>";
					echo $filme['data_lancamento'];
					echo "<br>";
					echo "<b>Idioma:</b>";
					echo $filme['idioma'];
					echo "<br>";
					echo "<b>Quantidade:</b>";
					echo $filme['quantidade'];
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que o filme selecionado não existe.<br>Continue a sua seleção.</h2>";
				}
			?>

			<script src="JS/jquery-3.5.1.min.js"></script>
			<script src="JS/bootstrap.min.js"></script>
			<script src="JS/all.min.js"></script>
		</body>
		</html>	

<?php
		}
		
			}//end if -if($con->connect_errno!=0)

else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:3;url=login.php');
}
?>
<br>