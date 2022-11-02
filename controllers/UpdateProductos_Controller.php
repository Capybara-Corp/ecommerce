<?php

$id_producto       = $_POST["pid"];
$cantidad_producto = $_POST["cantidad"];
$cantidad          = 0;
$total = 0;
$date = date("Y-m-d");
$lastventa = 0;


session_start();

include '../libs/connect.php';

//require_once 'GenerarVenta_Controller.php';


require "../config/config.php";

if (isset($_SESSION['uid'])) {
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
  $records->bindParam(':id', $user['rango']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $rango = null;

  if (count($results) > 0) {
    $rango = $results;
  }
}
else{
  die();
}



$sql2 = "SELECT MAX(vid) FROM VENTAS";
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
  $lastventa = $stmt->fetch();




$data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();
$detalleventa = $conn->query("SELECT * FROM DETALLEVENTA")->fetchAll();

foreach ($data as $row) {
    if (strcmp($row['pid'], $id_producto) == 0) {
      $cantidad = $row['cantidad'];
      $precio = $row['precio_venta'];
      $total += $cantidad_producto * $precio;
    }
}

$cantidad -= $cantidad_producto;


/*realizo update*/
if ($cantidad < 0) {
    echo "Stock Insuficiente";
    
} else {
    $sql = "UPDATE PRODUCTOS SET cantidad=? WHERE pid=?";
    $conn->prepare($sql)->execute([$cantidad, $id_producto]);
    
    
    $sql = "INSERT INTO DETALLEVENTA (vid, pid, cantidad, subtotal) VALUES ({$lastventa['MAX(vid)']}, $id_producto, $cantidad_producto, $total)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
