<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/index/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">   
	<!-- Cosas para que la pagina funcione -->

  <title>Pagina</title> <!-- Es el titulo que aparece en la pestaña -->
</head>
<body>
<section id="container_big">  <!-- Es todo el contenedor de arriba, es decir, el que tiene la imagen de los barriles de fondo -->
			<nav class="noselect"> <!-- Es el menu superior -->
				<div id="toggle-menu" class="toggle-menu">
				<img src="public/media/menu.png">
				</div>  <!-- Este div contiene la imagen del boton para abrir el menu -->
				<ul class="main-menu" id="main-menu">
				<li><a href="<?php echo $defaultUrl ?>">INICIO</a></li>
				<li><a href="<?php echo $defaultUrl ?>nosotros">NOSOTROS</a></li>
				<li><a href="<?php echo $defaultUrl ?>carrito/market">PRODUCTOS</a></li>
				<li>NOTICIAS</li>
				<li>CARRITO</li>
				<li>CONTACTO</li>
			
					<li>|&nbsp;&nbsp;&nbsp;LOGIN</li>
				</ul>
			</nav> <!-- Aqui termina el menu -->

			<img class="noselect" id="banner_portada" src="public/media/winery-factory.jpg">
     <div class="container_big_div noselect">
     	<p id="welcome">Vinos de la mejor calidad</p>
     	<img src="public/media/separator.png" id="separator">
     	<p id="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque neque nulla, ornare vel pulvinar sed, tempor ut turpis. Phasellus nec suscipit ipsum. Praesent a molestie ipsum, non gravida mauris. Fusce</p>
    </div> <!-- Este es el div que dice "vinos de la mejor calidad" -->
</section>

	<div id="top3">
		<p id="top3_text">NUESTROS 3 BESTSELLER</p>
		<img src="public/media/separator.png" id="separator_black" class="noselect">
	</div> <!--Este div es el que contiene el separador con el titulo "Nuestros 3 bestseller"-->
	<section id="mid_container" class="noselect">
		<div id="pics">
		<img src="public/media/bottles.png" id="bottles">
		<img src="public/media/chorrete.png" id="chorrete">
		</div>
	</section> <!-- Este section contiene las imagenes de la botella y del chorrete -->

	<img src="public/media/bgwine.png" id="bgwine" class="noselect"> <!-- Esta es la imagen de fondo -->

	<div id="shop" class="noselect">
		<p>COMPRAR AHORA</p>
	</div> <!-- Este div contiene el botón "Comprar ahora" -->

	<div id="search">
		<form id="formulario">
			<p id="eslogan">De nuestros viñedos, a su mesa</p>
		<input type="text" name="buscador" id="buscador" placeholder="Busque su producto">
		<button class="button" type="submit" id="boton">Buscar</button>
	</form>
	</div> <!-- Este div contiene el buscador con la imagen de parras de fondo -->

	<section id="ad_section">
	
	<div id="ad">
		
	</div> <!-- Es la imagen grande -->

	<div id="buy" class="noselect">
		<p>Vino Premium XXS</p>
		<div id="abuy">
		<a href="">COMPRAR</a>
		</div>
	</div> <!-- Es el botón -->

	</section> <!-- Este section contiene la imagen grande con los quesos, y el botón de comprar -->

	<section id="bot_container">
	<a href="<?php echo $defaultUrl ?>carrito/market">
		<div class="product">
			<img src="public/media/bottles/bottle1.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div> <!-- Cada div es básicamente el mismo, tiene una imagen, el nombre y el precio. Lo mejor sería sacarlo de una database pero por ahora está así -->

		<div class="product">
			<img src="public/media/bottles/bottle2.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle3.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle4.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle5.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle6.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle7.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>

		<div class="product">
			<img src="public/media/bottles/bottle8.png">
			<p>VINO PINDONGA</p>
			<p class="price">$590</p>
		</div>
	</a>
		

	</section> <!-- Este section contiene los articulos de vino en la grilla -->

	<footer class="footer">
	<p>FOOTER</p>
	<p>COPYRIGHT 2022</p>
	</footer> <!-- Este es el footer -->

	<script type="text/javascript" src="public/js/menu.js"></script> <!-- Aqui importamos el script del menú -->


</body>
</html>