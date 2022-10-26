<?php

//$defaultUrl = constant('URL');
//$var        = 1;

require 'connect.php';
$buscStr = $_POST["buscar"] ?? "";

if ($buscStr != "") {
    //codigo cuando busco
    $data = $conn->query("SELECT * FROM PRODUCTOS WHERE nombre LIKE LOWER('%" . $buscStr . "%')");

} else {
    //muestro todo
    $data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();
}

foreach ($data as $row) {
    echo "<section style='background-image: url(../" . $row['img'] . ");background-size: 5vw, contain;background-repeat: no-repeat;background-position: left;background-position-x: 5vw;'><p class='nombre'>" . $row['nombre'] . "</p><p class='stock'>STOCK: " . $row['cantidad'] . "</p><p class='precio'>$" . $row['precio_venta'] . "</p><p class='descrip'>" . $row['descrip'] . "</p><p class='marca'>" . $row['marca'] . "</p><button onclick='carrito_charger(\"" . $row['pid'] . "\", \"" . $row['nombre'] . "\", \"" . $row['precio_venta'] . "\")'> <p>AÑADIR</button></section>";
}

//require '/ecommerce/libs/connect.php';

//$buscador = $conn->query("SELECT * FROM PRODUCTOS WHERE nombre LIKE LOWER('%" . $_POST["buscar"] . "%')")->execute();
//$results = $buscador->fetchAll(PDO::FETCH_ASSOC);
/*
foreach ($this->data as $row) {
$var += 1;
echo "<section style='background-image: url(../$row->img);
background-size: 5vw, contain;
background-repeat: no-repeat;
background-position: left;
background-position-x: 5vw;'
><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
(\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
}
/*
if (count($results) > 0){
while ($row = $buscador->fetch()) {
$var += 1;
echo "<section style='background-image: url(../$row->img);
background-size: 5vw, contain;
background-repeat: no-repeat;
background-position: left;
background-position-x: 5vw;'
><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
(\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
}}
else{
foreach ($this->data as $row) {
$var += 1;
echo "<section style='background-image: url(../$row->img);
background-size: 5vw, contain;
background-repeat: no-repeat;
background-position: left;
background-position-x: 5vw;'
><p class='nombre'>" . $row->nombre . "</p><p class='stock'>STOCK: " . $row->cantidad . "</p><p class='precio'>$" . $row->precio . "</p><p class='descrip'>" . $row->descrip . "</p><p class='marca'>" . $row->marca . "</p><button onclick='carrito_charger
(\"" . $row->id_producto . "\", \"" . $row->nombre . "\", \"" . $row->precio . "\")'> <p>AÑADIR</button></section>";
}}*/

//echo "<p id=\"totalProductos\" style=\"display: none;\">$var</p>";