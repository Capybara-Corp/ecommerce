<?php 

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");

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
    <title><?=Translate::__('paneladmin');?></title>
    <link rel="stylesheet" href="public/css/login/panel.css">
</head>
<body>

<nav class="noselect">
<div id="toggle-menu" class="toggle-menu">
  <img src="<?php echo constant('URL'); ?>public/media/menu.png" id="menupic">
  </div> <!-- Este div contiene la imagen del boton para abrir el menu -->
  
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>"><?=Translate::__('inicio');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/producto"><?=Translate::__('editarproductos');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/editar"><?=Translate::__('editarusuarios');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/historialadmin"><?=Translate::__('historialadmin');?></a></li>
    <li><a href="<?php echo constant('URL'); ?>perfil?uid=<?php echo $_SESSION['uid'] ?>"><?=Translate::__('regresaramiperfil');?></a></li>

  </ul>
</nav>



<?php if ($rango['rid'] == '4'){ ?>
  <h1 id="welcomeadmin"><?=Translate::__('bienvenidosupremo');?><?php echo $user['nombre'] ?><?=Translate::__('bienvenidoalpaneladmin');?></h1> <!-- Nos dan la bienvenida al panel -->
<?php } 
else{ ?>
<h1 id="welcomeadmin"><?php echo $user['nombre'] ?><?=Translate::__('bienvenidoalpaneladmin');?></h1> <!-- Nos dan la bienvenida al panel -->
<?php } ?>

<script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>


</body>
</html>

<!-- TRADUCIDO -->