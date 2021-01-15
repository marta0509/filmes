<!DOCTYPE html>
<html>
  <head>
  <title>Index</title>
  <link rel="stylesheet" type="text/css" href="CSS/slick.css"/>
  <link rel="stylesheet" type="text/css" href="CSS/slick-theme.css"/>
  </head>
  <body>

  <div class="single-item" >
    <div><img src="IMG/dois.jpg"></div>
    <div><img src="IMG/tres.jpg"></div>
    <div><img src="IMG/quatro.jpg"></div>
 	<div><img src="IMG/um.jpg"></div>

  </div>
  	<a href="index_filmes.php">Filmes</a><br>
	<a href="index_atores.php">Atores</a><br>
	<a href="index_realizadores.php">Realizadores</a><br>
	<a href="index_utilizadores.php">Utilizadores</a><br>
	<br>
	<br>
	<a href="login.php">Login</a>
	<a href="processa_logout.php">Sair</a>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/slick.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.single-item').slick(
      	{	
      		infinite: true,
  			slidesToShow: 1,
 			slidesToScroll: 1,
 			adaptiveHeight:false,
 			autoplay:true
      	});
    });
  </script>

  </body>
</html>