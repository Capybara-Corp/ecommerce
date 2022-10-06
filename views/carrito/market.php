<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito</title>
  <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/carrito/style_market.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_shop_loaded.js"></script>
  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_carrito_charger.js"></script>

</head>

<body>
<nav class="noselect"> <!-- Es el menu superior -->
				<div id="toggle-menu" class="toggle-menu">
				<img src="../public/media/menu.png">
				</div>  <!-- Este div contiene la imagen del boton para abrir el menu -->
				<ul class="main-menu" id="main-menu">
			    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        	
					<li>|&nbsp;&nbsp;&nbsp;LOGIN</li>
				</ul>
			</nav> <!-- Aqui termina el menu -->


      

  <input type="hidden" value="<?php echo constant('URL'); ?>" id="urlBase">
  <h1 id="title">SU CARRITO</h1>
  <div id="contenedor_market">
    
    <section class="celda_market"></section>
    <section class="celda_carrito">
      <h1>RESUMEN</h1>
      <div id="separator1" class="separator"></div>

      <span id="carrito_content">
      </span>
      <div id="separator2" class="separator"></div>
      <p id="preciototal">PRECIO TOTAL: </p>
      <p id="total">$0</p>
      <button id="efectivo" onclick="generar_compra();">REALIZAR COMPRA </button>
      <h1 id="o">O</h1>
      <button id="paypal"><img src="../public/media/paypal.png" alt=""></button>
    </section>
  </div>

  <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>

</body>

</html>