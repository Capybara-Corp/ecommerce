<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Document</title>
</head>

<body>

  <?php

foreach ($this->data as $row) {
    echo "<section onclick='carrito_charger(\"" . $row['id_producto'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio'] . "\");'><p>" . $row['nombre'] . "</p><p> ID_PRODUCTO: " . $row['id_producto'] . " </p><br><p>" . $row['descrip'] . "</p><br><p>STOCK: " . $row['cantidad'] . "</p><p>PRECIO: " . $row['precio'] . "</p></section>";
}
;?>




  <!-- importo el javascript-->
  <script src="<?php echo constant('URL'); ?>public/js/main.js"></script>

</body>

</html>