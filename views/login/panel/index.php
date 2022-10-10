<?php 
session_start();
require '../connect.php';
require "../../../config/config.php";
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

  if ($rango['rid'] != '1') {
    header("Location: ../login.php");
  }
}
else {
    header("Location: ../../../");
    echo "Acceso denegado";
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="../../../public/css/login/panel.css">
</head>
<body>

<h1>Lord <?php echo $user['nombre'] ?>, bienvenido al panel admin</h1>
<div>
    <?php include "navegacion.php" ?>
</div>


</body>
</html>