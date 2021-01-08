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
				if (isset($_GET['filme'])&&is_numeric($_GET['filme'])) 
				{
					$idFilme=$_GET['filme'];
					$con=new mysqli("localhost","root","","filmes");

					if ($con->connect_errno!=0) 
					{
						echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
						exit();
					}	
					$sql="delete from filmes where id_filme=?";
					$stm=$con->prepare($sql);
					if ($stm!=false)
					{
						$stm->bind_param('i',$idFilme);
						$stm->execute();
						$stm->close();
						echo '<script>alert("Filme eliminado com sucesso");</script>';
						echo "Aguarde um momento. A reencaminhar página";
						header("refresh:1;url=index_filmes.php");
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