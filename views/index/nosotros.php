<?php

  /*require 'libs/connect.php';

  if (isset($_SESSION['uid'])) {
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="public/css/index/nosotros.css">
	  <link rel="stylesheet" href="public/css/index/header.css">
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">   
  	<title>Nosotros</title>
</head>
<body>
	<?php include "header.php"; ?>

	<section id="mid_container">
		<h1 class="title" id="nuestrahist">NUESTRA HISTORIA</h1>
		<p class="paragraph" id="parrafo1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
		</p>
		<img src="public/media/ancient.jpg" id="firstLocal" class="noselect">
		<i class="paragraph" id="firstLocalI">Nuestro primer local, inaugurado en 1963</i>

		
		<img src="public/media/team.png" id="partners" class="noselect">
		<i class="paragraph" id="partnersI" >Nuestro equipo de trabajo</i>
		<h1 class="noselect title" id="nuestrosobj">NUESTROS OBJETIVOS</h1>
		<p class="noselect paragraph" id="parrafo2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
		</p>
	</section>

	<?php include "footer.php"; ?>

	<script type="text/javascript" src="public/js/menu.js"></script>


</body>
</html>