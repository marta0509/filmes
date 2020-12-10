<?php
	if ($_SERVER['REQUEST_METHOD']=="GET") 
	{
		if (!isset($_GET['filme']) || !is_numeric($_GET['filme'])) {
			echo '<script>alert("Erro ao abrir Filme");</script>';
			echo "Aguarde um momento. A reecaminhar página";
			header("refresh:5;url=read/index.php");
			exit();		
		}	
		$idFilme=$_GET['filme'];
		$con=new mysli("localhost","root","","filmes");

		if ($con->connect_errno!=0)
		{
			echo 'Ocorreu um erro no acesso à base de dados. <br>'.$con->connect_error;
			exit();
		}
		else
		{
			$sql='select * from filmes where id_fime=?';
			$stm =$con->prepare($sql);
			if ($stm!=false)
			{
				$stm->bind_param('i',$idFilme);
				$stm->execute();
				$res=$res->fetchassoc();
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