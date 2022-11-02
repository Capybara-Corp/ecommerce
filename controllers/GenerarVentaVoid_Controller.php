<?php


session_start();


include '../libs/connect.php';
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


if ($cantidad < 0) {
    echo "Stock Insuficiente";
} else {
    $sql = "INSERT INTO VENTAS (uid) VALUES (:uid)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':uid', $user['uid']);
    $stmt->execute();

    echo "Generada venta vacia";
}
