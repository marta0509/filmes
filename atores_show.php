<?php
	if ($_SERVER['REQUEST_METHOD']=="GET") 
	{
		if (!isset($_GET['ator']) || !is_numeric($_GET['ator'])) {
			echo '<script>alert("Erro ao abrir Atores");</script>';
			echo "Aguarde um momento. A reecaminhar página";
			header("refresh:5;url=index_atores.php");
			exit();		
		}	
		$ator=$_GET['ator'];
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0)
		{
			echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
			exit();
		}
		else
		{
			$sql='select * from atores where id_ator=?';
			$stm =$con->prepare($sql);
			if ($stm!=false)
			{
				$stm->bind_param('i',$ator);
				$stm->execute();
				$res=$stm->get_result();
				$ator=$res->fetch_assoc();
				$stm->close();
			}
		else
		{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar página";
			echo "<br>";
			header("refresh:5; url=index_atores.php");
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
<body>
	<H1>Detalhes do ator</H1>
	<?php
		if (isset($ator)) {
			echo "<br>";
			echo $ator['nome'];
			echo "<br>";
			echo ($ator['data_nascimento']);
			echo "<br>";
			echo $ator['nacionalidade'];
			echo "<br>";
		}
		else
		{
			echo "<h2>Parece que o ator selecionado não existe.<br>Continue a sua seleção.</h2>";
		}
	?>
</body>
</html>