<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="public/css/index/nosotros.css">
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">   
  	<title>Nosotros</title>
</head>
<body>
	<section id="container_big">  
		<nav class="noselect">
			<div id="toggle-menu" class="toggle-menu">
			<img src="public/media/menu.png">
			</div>
			<ul class="main-menu" id="main-menu">
			<li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        	<li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
        	<li><a href="<?php echo constant('URL'); ?>carrito/market">PRODUCTOS</a></li>
        	<li>NOTICIAS</li>
        	<li>CARRITO</li>
        	<li>CONTACTO</li>
				
			<li>|&nbsp;&nbsp;&nbsp;LOGIN</li>
			</ul>
		</nav>
	</section>

	<section id="mid_container">
		<div id="ourHistory">
		<h1 class="title noselect">NUESTRA HISTORIA</h1>
		<p class="noselect paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
		</p>
		</div>
		<img src="public/media/ancient.jpg" id="firstLocal" class="noselect">
		<i class="paragraph noselect" id="firstLocalI">Nuestro primer local, inaugurado en 1963</i>

		
		<img src="public/media/team.png" id="partners" class="noselect">
		<i class="paragraph noselect" id="partnersI" >Nuestro equipo de trabajo</i>

		<div id="ourTeam">
		<h1 class="title noselect">NUESTROS OBJETIVOS</h1>
		<p class="noselect paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
		</p>
		</div>
	</section>

	<footer class="footer">
	<p>FOOTER</p>
	<p>COPYRIGHT 2022</p>
	</footer> <!-- Este es el footer -->

	<script type="text/javascript" src="public/js/menu.js"></script>


</body>
</html>