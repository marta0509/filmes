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
				echo "<h1 style='color:darkblue'>Editar filmes</h1>";
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
				<link href="CSS/bootstrap.min.css" rel="stylesheet" >
				<link rel="stylesheet" href="CSS/jumbotrom.css">
				<link rel="stylesheet" href="CSS/all.min.css">
			</head>
			<body style="background: #BFFAF7">
				<form action="update.php" method="post">
					<label><b>Título</b></label>
					<input class="form-control" type="text" name="titulo" required value="<?php echo $filme['titulo'];?>"><br>
					<label><b>Sínopse</b></label>
					<input class="form-control" type="text" name="sinopse" value="<?php echo $filme['sinopse'];?>"><br>
					<label><b>Quantidade</b></label>
					<input class="form-control" type="text" name="quantidade" value="<?php echo $filme['quantidade'];?>"><br>
					<label><b>Idioma</b></label>
					<input class="form-control" type="text" name="idioma" value="<?php echo $filme['idioma'];?>"><br>
					<label><b>Data Lançamento</b></label>
					<input class="form-control" type="date" name="data_lancamento" value="<?php echo $filme['data_lancamento'];?>"><br>
					<input class="form-control" type="hidden" name="id_filme" value="<?php echo $filme['id_filme'];?>"><br>
					<input type="submit" name="enviar"><br>
				</form>

				<script src="JS/jquery-3.5.1.min.js"></script>
				<script src="JS/bootstrap.min.js"></script>
				<script src="JS/all.min.js"></script>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:1;url=index.php");
				}
		}
	