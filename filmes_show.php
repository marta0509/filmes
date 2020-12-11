<?php
	if ($_SERVER['REQUEST_METHOD']=="GET") 
	{
		if (!isset($_GET['filme']) || !is_numeric($_GET['filme'])) {
			echo '<script>alert("Erro ao abrir Filme");</script>';
			echo "Aguarde um momento. A reecaminhar página";
			header("refresh:5;url=index.php");
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
			header("refresh:5; url=index.php");
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
	<H1>Detalhes do filme</H1>
	<?php
		if (isset($filme)) {
			echo "<br>";
			echo $filme['titulo'];
			echo "<br>";
			echo utf8_encode($filme['sinopse']);
			echo "<br>";
			echo $filme['data_lancamento'];
			echo "<br>";
			echo $filme['idioma'];
			echo "<br>";
			echo $filme['quantidade'];
			echo "<br>";
		}
		else
		{
			echo "<h2>Parece que o filme selecionado não existe.<br>Continue a sua seleção.</h2>";
		}
	?>
</body>
</html>