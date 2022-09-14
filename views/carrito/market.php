<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>market shop</title>
  <link rel="stylesheet" href="style_market.css">

  <script src="script_shop_loaded.js"></script>
  <script src="script_carrito_charger.js"></script>

</head>

<body>
  <div id="contenedor_market">
    <section class="celda_market"></section>
    <section class="celda_carrito">
      <h1>su carrito de compra</h1>

      <span id="carrito_content">


      </span>
      <button onclick="generar_compra();"> realizar compra </button>
    </section>
  </div>

</body>

</html>