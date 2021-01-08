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
					$sql="delete from atores where id_ator=?";
					$stm=$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$ator);
						$stm->execute();
						$stm->close();
						echo '<script>alert("Ator eliminado com sucesso");</script>';
						echo "Aguarde um momento. A reencaminhar página";
						header("refresh:1;url=index_atores.php");
					}
					
				}
			}	
		?>

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