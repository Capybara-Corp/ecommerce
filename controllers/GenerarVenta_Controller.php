<?php



$date = date("Y-m-d");

session_start();


$total = 0;


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

echo "Existo";

$sql2 = "SELECT MAX(vid) FROM VENTAS";
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
  $lastventa = $stmt->fetch();


$sql3 = "SELECT SUM(subtotal) FROM DETALLEVENTA WHERE vid = '".$lastventa['MAX(vid)']."'";
$stmt = $conn->prepare($sql3);
    $stmt->execute();
  $subtotal = $stmt->fetch();

  echo $subtotal['SUM(subtotal)'];
  $total = $subtotal['SUM(subtotal)'];

if ($cantidad < 0) {
    echo "Stock Insuficiente";
} else {

  if($total > 0){
  $sql = "UPDATE VENTAS SET Fecha = :date, Total = :total WHERE vid = '".$lastventa['MAX(vid)']."'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':total', $total);
    $stmt->execute();
    echo "Compra realizada con éxito";
  }
  else{
    $sql = "DELETE FROM VENTAS WHERE vid = '".$lastventa['MAX(vid)']."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "Stock Insuficiente2";
  }




    //DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';

    
}
