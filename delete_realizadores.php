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
			$sql="delete from realizadores where id_realizador=?";
			$stm=$con->prepare($sql);
			if ($stm!=false)
			{
				$stm->bind_param('i',$realizador);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Realizador eliminado com sucesso");</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header("refresh:1;url=index_realizadores.php");
			}
			
		}
	}	
?>