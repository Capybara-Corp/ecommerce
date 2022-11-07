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

  if ($rango['rid'] == '2') {
    header("Location: ../ecommerce");
  }
}
else {
    header("Location: ../ecommerce");
    echo "Acceso denegado";
    die();
}

// * Verifica si estamos logeados y si ademas no somos usuarios

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="public/css/login/panel.css">
</head>
<body>

<nav class="noselect">
<div id="toggle-menu" class="toggle-menu">
  <img src="<?php echo constant('URL'); ?>public/media/menu.png" id="menupic">
  </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
  
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/producto">EDITAR PRODUCTOS</a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/editar">EDITAR USUARIOS</a></li>
    <li><a href="<?php echo constant('URL'); ?>perfil?uid=<?php echo $_SESSION['uid'] ?>">REGRESAR A MI PERFIL</a></li>

  </ul>
</nav>



<?php if ($rango['rid'] == '4'){ ?>
  <h1>Nuestro amado y respetado lider supremo, hijo del profeta Mahoma, hermano del Sol y de la Luna, nieto y virrey de Dios; regente de los reinos del universo y del multiverso, soberano de soberanos, rey de reyes, emperador de emperadores, caballero extraordinario jamás vencido, firme guardián de la tumba de Jesucristo, elegido del mismísimo Dios, <?php echo $user['nombre'] ?>, bienvenido al panel admin</h1> <!-- Nos dan la bienvenida al panel -->
<?php } 
else{ ?>
<h1>Lord <?php echo $user['nombre'] ?>, bienvenido al panel admin</h1> <!-- Nos dan la bienvenida al panel -->
<?php } ?>

<script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>


</body>
</html>