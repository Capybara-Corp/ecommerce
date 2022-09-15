<?php
foreach ($data as $row) {
    echo "<section onclick='carrito_charger(\"" . $row['id_producto'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio'] . "\");'><p>" . $row['nombre'] . "</p><p> ID_PRODUCTO: " . $row['id_producto'] . " </p><br><p>" . $row['descrip'] . "</p><br><p>STOCK: " . $row['cantidad'] . "</p><p>PRECIO: " . $row['precio'] . "</p></section>";
}