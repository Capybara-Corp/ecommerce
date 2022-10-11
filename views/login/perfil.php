<?php 
session_start();
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
}
else{
  Header('Location: login');
}

//! Con todo esto, lo que hace es sacar el usuario de la sesión y el rango de ese mismo usuario


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de: <?= $user['nombre']; ?></title>
    <link rel="stylesheet" href="public/css/login/perfil.css">
</head>
<body>

<?php 
if(($_GET['uid'])==($_SESSION['uid'])): ?>

<!-- Igual que antes, si coincide la sesión con el GET -->

<?php include "views/index/header.php" ?>

    <section id="muro">
    <div id="rosa">
      <br>
        <img src="<?php echo $user['avatar']; ?>" class="profilepic">
        
        <h1 style="color:<?php echo $rango['color']; ?>" id=profilename><?= $user['nombre']; ?><?php if ($rango['rid'] == '1') { ?><p style="margin-top: -7vh; color: white!important; font-size: 1vw!important;">(admin)</p><?php } ?> </h1>
      
      <br>
      <br>
      <a id="edit" href="editar?uid=<?php echo ($_SESSION['uid']); ?>">
        Editar mi perfil
      </a>
          <br>
          
      <?php if ($rango['rid'] == '1') { ?><a href="panel" id="panelAdmin">Panel Admin</a><?php } ?>


      </div>
      <h1 id="historial">Ultimos vinos comprados</h1>
    <h1 class="vino">Vino 1</h1>
    <h1 class="vino">Vino 2</h1>
    <h1 class="vino">Vino 3</h1>
    <h1 class="vino">Vino 4</h1>
    <h1 class="vino">Vino 5</h1>
      <a id="logout" href="logout">
        Cerrar sesión
      </a>
        </section>
      <?php else: ?>
    <?php Header('Location: login'); ?>
    <?php endif; ?>

    <?php include "views/index/footer.php"; ?>

    <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>

</body>
</html>