<?php 

require 'libs/connect.php';
require "config/config.php";
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
    header("Location: ../ecommerce");
  }
}
else {
    header("Location: ../ecommerce");
    echo "Acceso denegado";
    die();
}

// * Verifica si estamos logeados y si ademas somos admin

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="public/css/login/panel.css">
    <link rel="stylesheet" href="public/css/index/header.css">
</head>
<body>

<?php include "views/index/header.php";?>

<h1>Lord <?php echo $user['nombre'] ?>, bienvenido al panel admin</h1> <!-- Nos dan la bienvenida al panel -->
<div>
    <?php include "views/login/panel/navegacion.php" ?> 
</div>

<?php include "views/index/footer.php"; ?>

</body>
</html>