<?php
	if ($_SERVER['REQUEST_METHOD']=="GET")
	{
		if (isset($_GET['realizador'])&&is_numeric($_GET['realizador'])) 
		{
			$realizador=$_GET['realizador'];
			$con=new mysqli("localhost","root","","filmes");

			if ($con->connect_errno!=0) 
			{
				echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_errnor."</h1>";
				exit();
			}	
			$sql="Select * from realizadores where id_realizador=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				echo "<h1 style='color:darkblue'>Editar realizadores</h1>";
				$stm->bind_param("i",$realizador);
				$stm->execute();
				$res=$stm->get_result();
				$realizador=$res->fetch_assoc();
				$stm->close();
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Editar realizador</title>
				<link href="CSS/bootstrap.min.css" rel="stylesheet" >
				<link rel="stylesheet" href="CSS/jumbotrom.css">
				<link rel="stylesheet" href="CSS/all.min.css">
			</head>
			<body style="background: #BFFAF7">
				<form action="update_realizadores.php" method="post">
					<label><b>Nome</b></label>
					<input class="form-control" type="text" name="nome" required value="<?php echo $realizador['nome'];?>"><br>
					<label><b>Data Nascimento</b></label>
					<input class="form-control" type="text" name="data_nascimento" value="<?php echo $realizador['data_nascimento'];?>"><br>
					<label><b>Nacionalidade</b></label>
					<input class="form-control" type="text" name="nacionalidade" value="<?php echo $realizador['nacionalidade'];?>"><br>
					<input class="form-control" type="hidden" name="id_realizador" value="<?php echo $realizador['id_realizador'];?>"><br>
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
					header("refresh:1;url=index_realizadores.php");
				}
		}
	