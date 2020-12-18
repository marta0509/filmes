<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$nome="";
		$data_nascimento="";
		$nacionalidade="";
		$id_ator="";


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
		if(isset($_POST['nacionalidade']))
		{
			$nacionalidade=$_POST['nacionalidade'];
		}
		if(isset($_POST['id_ator']))
		{
			$id_ator=$_POST['id_ator'];
		}

		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) 
		{
			echo "Ocorreu um erro no acesso à base de dados. <br>".$con->connect_error;
			exit;
		}
		else
		{
			$sql="update atores set nome=?,data_nascimento=?,nacionalidade=? where id_ator=?";
			$stm=$con->prepare($sql);

			if($stm!=false)
			{
				$stm->bind_param("sssi",$nome,$data_nascimento,$nacionalidade,$id_ator);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Atores alterado com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:5;url=index_atores.php");
			}
			else
			{

			}
		}
	}
	else
	{
		echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
		header("refresh:5;url=index_atores.php");
	}