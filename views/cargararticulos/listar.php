<?php
$defaultUrl = constant('URL');

foreach ($this->data as $row) {
    echo "<section style='background-image: url(../$row->img); 
    background-size: contain;
    background-repeat: no-repeat; 
    background-position: left; 
    background-position-x: 5vw;'
    ><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
    (\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
}