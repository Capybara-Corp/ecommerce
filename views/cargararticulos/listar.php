<?php

//$defaultUrl = constant('URL');
$var        = 1;

require 'libs/connect.php';
$buscStr = $_POST["buscar"] ?? "";


/*if($buscStr == 'pacman'){
    echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
}*/

//echo '<script>var win = window.open(\'public/media/PacMan/index.html\', \'_blank\');</script>';

if ($buscStr != "") {
    /*if($buscStr == 'pacman'){
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Pacman_HD.png">';
    }*/
    //codigo cuando busco
    $data = $conn->query("SELECT * FROM PRODUCTOS WHERE nombre LIKE LOWER('%" . $buscStr . "%')");

} else {
    //muestro todo
    $data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();
}

foreach ($data as $row) {
    $var += 1;
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

echo "<p id=\"totalProductos\" style=\"display: none;\">$var</p>";