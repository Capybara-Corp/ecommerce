<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");


//require 'libs/connect.php';

/*if (isset($_SESSION['uid'])) {
$records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
$records->bindParam(':id', $_SESSION['uid']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$user = null;

if (count($results) > 0) {
$user = $results; // Me carga en "$user" los datos de mi usuario de mi sesión
}
}*/
;?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/index/style.css">
  <link rel="stylesheet" href="public/css/index/header.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <!-- Cosas para que la pagina funcione -->

  <title>Charruas Boutique</title> <!-- Es el titulo que aparece en la pestaña -->

</head>


<body>
  <section id="container_big">
    <!-- Es todo el contenedor de arriba, es decir, el que tiene la imagen de los barriles de fondo -->
    <?php include "header.php";?>
    <img class="noselect" id="banner_portada" src="public/media/winery-factory.jpg">
    <div class="container_big_div noselect">
      <p id="welcome"><?=Translate::__('vinosdelamejorcalidad');?></p>
      <img src="public/media/separator.png" id="separator">
      <p id="message"><?=Translate::__('nuestrosvinos');?></p>
    </div> <!-- Este es el div que dice "vinos de la mejor calidad" -->
  </section>

  <div id="top3">
    <p id="top3_text"><?=Translate::__('nuestros3bestseller');?></p>
    <img src="public/media/separator.png" id="separator_black" class="noselect">
  </div>
  <!--Este div es el que contiene el separador con el titulo "Nuestros 3 bestseller"-->
  <section id="mid_container" class="noselect">
    <div id="pics">
      <img src="public/media/bottles.png" id="bottles">
      <img src="public/media/chorrete.png" id="chorrete">
    </div>
  </section> <!-- Este section contiene las imagenes de la botella y del chorrete -->

  <img src="public/media/bgwine.png" id="bgwine" class="noselect"> <!-- Esta es la imagen de fondo -->

  <a href="carrito/market"><div id="shop">
    <p><?=Translate::__('comprarahora');?></p>
  </div></a> <!-- Este div contiene el botón "Comprar ahora" -->

  <div id="search">
    <form id="formulario" action="carrito/market" method="post">
      <p id="eslogan"><?=Translate::__('denuestrosviñedosasumesa');?></p>
      <input type="text" name="buscador" id="buscador" placeholder="<?=Translate::__('busquesuproducto');?>">
      <button class="button" type="submit" id="boton"><?=Translate::__('buscar');?></button>
    </form>
  </div> <!-- Este div contiene el buscador con la imagen de parras de fondo -->

  <section id="ad_section">

    <div id="ad">

    </div> <!-- Es la imagen grande -->

    <div id="buy" class="noselect">
      <p>Vino Premium XXS</p>

      <a href="carrito/market">
      <div id="abuy">
        <p><?=Translate::__('comprarahora');?></p>
      </div>
      </a>

    </div> <!-- Es el botón -->

  </section> <!-- Este section contiene la imagen grande con los quesos, y el botón de comprar -->

  <section id="bot_container">

    <?php

$i    = 0;

foreach ($this->items as $item) {
  echo "<div class=\"product\">
        <a href=\"carrito/market?pid=" . $item['pid'] . "\">
        <img src=" . $item['img'] . ">
        <p>" . $item['nombre'] . "</p>
        <p class=\"price\">$" . $item['precio_venta'] . "</p>
        </button>
        </a>
      </div>";
  $i++;
  if ($i == 8) {
      break;
  }
}


?>




  </section> <!-- Este section contiene los articulos de vino en la grilla -->

  <?php include "footer.php";?>

  <script type="text/javascript" src="public/js/menu.js"></script> <!-- Aqui importamos el script del menú -->
  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_shop_loaded.js"></script>
  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_carrito_charger.js"></script>

</body>

</html>