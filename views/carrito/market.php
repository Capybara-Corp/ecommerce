<?php
session_start();

require 'libs/connect.php';

if (isset($_SESSION['uid'])) {
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>

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
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <script>
  let precioIndividual = [];
  </script>


  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_shop_loaded.js"></script>
  <script src="<?php echo constant('URL'); ?>public/js/carrito/script_carrito_charger.js"></script>

</head>

<body>
  <?php include "header.php";?>

  <!--Importo mi header -->




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

  <?php if (isset($_GET['pid'])) {
    $records = $conn->prepare('SELECT * FROM PRODUCTOS WHERE pid=:pid');
    $records->bindParam(':pid', $_GET['pid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    echo "<h1 id=\"get1\" style=\"display: none;\">" . $results['pid'] . "</h1>";
    echo "<h1 id=\"get2\" style=\"display: none;\">" . $results['nombre'] . "</h1>";
    echo "<h1 id=\"get3\" style=\"display: none;\">" . $results['precio_venta'] . "</h1>";
    
    }
  ?>

  <?php include "views/index/footer.php";?>

  <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>


</body>

</html>