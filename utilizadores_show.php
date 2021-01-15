<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&&isset($_SESSION['login']))
{		
		$utilizador=$_GET['utilizador'];
			if ($_SESSION['utilizador']!=$utilizador) {
				echo "Nao tem permição";
				exit;
			}
		$con=new mysqli("localhost","root","","filmes");
		if($con->connect_errno!=0)
		{
			echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
			exit;
		}
		else
		{
			if ($_SERVER['REQUEST_METHOD']=="GET") 
			{
				if (!isset($_GET['utilizador']) || !is_numeric($_GET['utilizador'])) {
					echo '<script>alert("Erro ao abrir utilizadores");</script>';
					echo "Aguarde um momento. A reecaminhar página";
					header("refresh:1;url=index_utilizadores.php");
					exit();		
				}	
				$ator=$_GET['utilizador'];
				$con=new mysqli("localhost","root","","filmes");

				if ($con->connect_errno!=0)
				{
					echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
					exit();
				}
				else
				{
					$sql='select * from utilizadores where id=?';
					$stm =$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$utilizador);
						$stm->execute();
						$res=$stm->get_result();
						$utilizador=$res->fetch_assoc();
						$stm->close();
					}
				else
				{
					echo "<br>";
					echo ($con->error);
					echo "<br>";
					echo "Aguarde um momento. A reencaminhar página";
					echo "<br>";
					header("refresh:1; url=index_utilizadores.php");
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
			<H1 style="color: darkblue">Detalhes do utilizador</H1>
			<?php
				if (isset($utilizador)) {
					echo "<br>";
					echo "<b>Nome:</b>";
					echo $utilizador['nome'];
					echo "<br>";
					echo "<b>User name:</b>";
					echo $utilizador['user_name'];
					echo "<br>";
					echo "<b>Password:</b>";
					echo $utilizador['password'];
					echo "<br>";
				}
				else
				{
					echo "<h2>Parece que o utilizador selecionado não existe.<br>Continue a sua seleção.</h2>";
					header('refresh:3;url=index_utilizadores.php');
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
?>
<br>