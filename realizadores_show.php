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
				if (!isset($_GET['realizador']) || !is_numeric($_GET['realizador'])) {
					echo '<script>alert("Erro ao abrir Realizadores");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index_realizadores.php");
					exit();		
				}	
				$realizador=$_GET['realizador'];
				$con=new mysqli("localhost","root","","filmes");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from realizadores where id_realizador=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$realizador);
						$stm->execute();
						$res=$stm->get_result();
						$realizador=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index_realizador.php");
				}
			}
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Detalhes</title>
		</head>
		<body style="background: #BFFAF7">
			<H1 style="color: darkblue">Detalhes do realizador</H1>
			<?php
				if (isset($realizador)) {
					echo "<br>";
					echo $realizador['nome'];
					echo "<br>";
					echo ($realizador['data_nascimento']);
					echo "<br>";
					echo $realizador['nacionalidade'];
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que o realizador selecionado não existe.<br>Continue a sua seleção.</h2>";
				}
			?>
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