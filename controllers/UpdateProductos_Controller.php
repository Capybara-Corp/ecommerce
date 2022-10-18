<?php

$id_producto       = $_POST["pid"];
$cantidad_producto = $_POST["cantidad"];
$cantidad          = 0;


include '../libs/connect.php';
session_start();
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
  echo "Debes iniciar sesión para proceder";
  die();
}








$data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();

foreach ($data as $row) {
    if (strcmp($row['pid'], $id_producto) == 0) {$cantidad = $row['cantidad'];}
}

$cantidad -= $cantidad_producto;

/*realizo update*/
if ($cantidad < 0) {
    echo "Stock Insuficiente";
} else {
    $sql = "UPDATE PRODUCTOS SET cantidad=? WHERE pid=?";
    $conn->prepare($sql)->execute([$cantidad, $id_producto]);

    echo "Compra realizada con éxito";
}
