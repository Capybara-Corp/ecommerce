<?php

$id_producto       = $_POST["pid"];
$cantidad_producto = $_POST["cantidad"];
$cantidad          = 0;

//hay que traer el objeto o funcion conexion por el mvc

$host     = "localhost";
$username = "root";
$password = "";
$db_name  = "ECOMMERCE";

try
{
$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {}

//import("../../libs/database.php");

// acceder a funcion de una clase $this->connect();







//Trying to import the whole method


/*include("/ECOMMERCE/controllers/UpdateProductos_Controller.php");
$pdo = new Database();
$pdo -> connect();*/











$pdo = $conn;




$data = $pdo->query("SELECT * FROM PRODUCTOS")->fetchAll();

foreach ($data as $row) {
    if (strcmp($row['pid'], $id_producto) == 0) {$cantidad = $row['cantidad'];}
}

$cantidad -= $cantidad_producto;

/*realizo update*/
if ($cantidad < 0) {
    echo "Stock Insuficiente";
} else {
    $sql = "UPDATE PRODUCTOS SET cantidad=? WHERE pid=?";
    $pdo->prepare($sql)->execute([$cantidad, $id_producto]);

    echo "Compra realizada con éxito";
}
