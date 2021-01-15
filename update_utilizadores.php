<?php
session_start();
if (!isset($_SESSION['login'])) 
{
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&&isset($_SESSION['login']))
{
	if ($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$nome="";
		$user_name="";
		$password="";


		if (isset($_POST['nome']))
		{
			$nome=$_POST['nome'];
		}
		else
		{
			echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
		}
		if(isset($_POST['user_name']))
		{
			$user_name=$_POST['user_name'];
		}
		if(isset($_POST['password']))
		{
			$password=$_POST['password'];
			$passencriptada=password_hash($password, PASSWORD_DEFAULT);
		}


		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) 
		{
			echo "Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error;
			exit;
		}
		else
		{
			$sql="update utilizadores set nome=?,user_name=?,password=? where id=?";
			$stm=$con->prepare($sql);

			if($stm!=false)
			{	
				
				$x=$_SESSION['utilizador'];
				$stm->bind_param("sssi",$nome,$user_name,$passencriptada,$x);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Utilizadores alterado com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:1;url=index_utilizadores.php");
			}
			else
			{

			}
		}
	}
	else
	{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header("refresh:1;url=index_utilizadores.php");
	}
		
			}//end if -if($con->connect_errno!=0)

else
{
	echo 'Para entrar nesta página necessita efetuar <br><a href="login.php">login</a>';
	header('refresh:3;url=login.php');
}
?>