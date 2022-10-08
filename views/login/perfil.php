<?php 
session_start();
require 'connect.php';
require "../../config/config.php";
if (isset($_SESSION['uid'])) {
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de: <?= $user['nombre']; ?></title>
    <link rel="stylesheet" href="../../public/css/login/perfil.css">
</head>
<body>

<?php 
if(($_GET['uid'])==($_SESSION['uid'])): ?>

<nav class="noselect">
      <!-- Es el menu superior -->
      <div id="toggle-menu" class="toggle-menu">
      <img src="../../public/media/menu.png" id="menupic">
      </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
      <ul class="main-menu" id="main-menu">
        <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
        <li><a href="<?php echo constant('URL'); ?>nosotros">NOSOTROS</a></li>
        <li><a href="<?php echo constant('URL'); ?>carrito/market">PRODUCTOS</a></li>
        <li><a href="">NOTICIAS</a></li>
        <li><a href="">CARRITO</a></li>
        <li><a href="">CONTACTO</a></li>


        <?php if(!empty($user)): ?>
          <li><a href="<?php echo constant('URL'); ?>views/login/perfil.php?uid=<?php echo ($_SESSION['uid']); ?>">|&nbsp;&nbsp;&nbsp;MI CUENTA</a></li>
    <?php else: ?>
      <li><a href="<?php echo constant('URL'); ?>views/login/login.php">|&nbsp;&nbsp;&nbsp;LOGIN</a></li>
    <?php endif; ?>

      </ul>
    </nav> <!-- Aqui termina el menu -->

    <section id="muro">
    <div id="rosa">
      <br>
      <?php if($user['avatar'] != '') { ?>
        <img src="<?php echo $user['avatar']; ?>" class="profilepic">
        <?php } else { ?> 
        <img src="../../public/img/perfil/default.jpg" class="profilepic">
        <?php } ?>
        <h1 id=profilename><?= $user['nombre']; ?></h1>
      
      <br>
      <br>
      <a id="edit" href="editarperfil.php?uid=<?php echo ($_SESSION['uid']); ?>">
        Editar mi perfil
      </a>
      </div>
      <h1 id="historial">Ultimos vinos comprados</h1>
    <h1 class="vino">Vino 1</h1>
    <h1 class="vino">Vino 2</h1>
    <h1 class="vino">Vino 3</h1>
    <h1 class="vino">Vino 4</h1>
    <h1 class="vino">Vino 5</h1>
      <a id="logout" href="logout.php">
        Cerrar sesión
      </a>
        </section>
      <?php else: ?>
    <?php header('Location: logout.php'); ?>
    <?php endif; ?>

    <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>

</body>
</html>