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
			$sql="Select * from atores where id_ator=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				$stm->bind_param("i",$ator);
				$stm->execute();
				$res=$stm->get_result();
				$ator=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar ator</title>
			</head>
			<body>
				<form action="update_atores.php" method="post">
					<label>Nome</label>
					<input type="text" name="nome" required value="<?php echo $ator['nome'];?>"><br>
					<label>data_nascimento</label>
					<input type="text" name="data_nascimento" value="<?php echo $ator['data_nascimento'];?>"><br>
					<label>nacionalidade</label>
					<input type="text" name="nacionalidade" value="<?php echo $ator['nacionalidade'];?>"><br>
					<input type="hidden" name="id_ator" value="<?php echo $ator['id_ator'];?>"><br>
					<input type="submit" name="enviar"><br>
				</form>
			</body>
			</html>
			<?php 
				}
				else
				{
					echo('<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos será reencaminhado!</h1>');
					header("refresh:5;url=index_atores.php");
				}
		}
	