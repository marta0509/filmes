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
			$sql="Select * from filmes where id_filme=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				$stm->bind_param("i",$idFilme);
				$stm->execute();
				$res=$stm->get_result();
				$filme=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar filme</title>
			</head>
			<body>
				<form action="update.php" method="post">
					<label>Título</label>
					<input type="text" name="titulo" required value="<?php echo $filme['titulo'];?>"><br>
					<label>Sínopse</label>
					<input type="text" name="sinopse" value="<?php echo $filme['sinopse'];?>"><br>
					<label>Quantidade</label>
					<input type="text" name="quantidade" value="<?php echo $filme['quantidade'];?>"><br>
					<label>Idioma</label>
					<input type="text" name="idioma" value="<?php echo $filme['idioma'];?>"><br>
					<label>Data Lançamento</label>
					<input type="date" name="data_lancamento" value="<?php echo $filme['data_lancamento'];?>"><br>
					<input type="hidden" name="id_filme" value="<?php echo $filme['id_filme'];?>"><br>
					<input type="submit" name="enviar"><br>
				</form>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:5;url=index.php");
				}
		}
	