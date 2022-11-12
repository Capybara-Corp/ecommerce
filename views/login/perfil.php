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
}

$userdir = [];

$records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
$records->bindParam(':id', $_GET['uid']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$perfil = null;

if (count($results) > 0) {
    $perfil = $results;
}

$records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
$records->bindParam(':id', $perfil['rango']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$rango = null;

if (count($results) > 0) {
    $rango = $results;
}

$records = $conn->prepare('SELECT * FROM USUARIOS_Direcciones WHERE uid = :id');
$records->bindParam(':id', $_SESSION['uid']);
$records->execute();

if (is_countable($results) > 0) {
    while ($results = $records->fetch(PDO::FETCH_ASSOC)) {
        $userdireccion[] = $results;
    }
} else {
    $userdireccion[] = '';
}

$records = $conn->query('SELECT * FROM PRODUCTOS INNER JOIN DETALLEVENTA ON PRODUCTOS.pid = DETALLEVENTA.pid INNER JOIN VENTAS ON VENTAS.vid = DETALLEVENTA.vid WHERE VENTAS.uid = "'.$_GET['uid'].'" ORDER BY VENTAS.vid DESC LIMIT 5')->fetchAll();
//$records->bindParam(':id', $_GET['uid']);

if (is_countable($records) > 0) {
    foreach ($records as $row) {
        $productos[] = $row;
    }
} else {
    $productos[] = '';
}


; //! Con todo esto, lo que hace es sacar el usuario de la sesión y el rango de ese mismo usuario

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=Translate::__('perfilde');?><?=$perfil['nombre'];?></title>
  <link rel="stylesheet" href="public/css/login/perfil.css">
  <link rel="stylesheet" href="public/css/index/headerblack.css">
  <link rel="stylesheet" href="public/css/index/footer.css">
</head>

<body>

  <?php

if (isset($_GET['uid'])): ?>

  <?php include "views/index/header.php";?>

  <section id="muro">
    <div id="rosa" <?php if($perfil['rango'] == 4){ ?> style="background: #202020!important;" <?php } ?>>  
      <br>
      <img src="<?php echo $perfil['avatar']; ?>" class="profilepic">





      <?php if ($perfil['rango'] == '1') {?>
      <p class="rango">(<?=Translate::__('admin');?>)</p><?php }?>

      <?php if ($perfil['rango'] == '3') {?>
      <p class="rango">(<?=Translate::__('emperador');?>)</p><?php }?>

      <?php if ($perfil['rango'] == '4') {?>
      <p class="rango" id="lider">(<?=Translate::__('supremolider');?>)</p><?php }?>

      <h1 style="color:<?php echo $rango['color']; ?>;<?php if($perfil['rango'] == 4){?> -webkit-text-stroke: 0.05vw white; <?php } ?>" id=profilename>
        <?=$perfil['nombre'];?>
      </h1>
      <?php if (($_GET['uid']) == ($_SESSION['uid'])) {?>

      <div id="opciones">
      <a id="editprofile" href="editar?uid=<?php echo ($_SESSION['uid']); ?>">
      <?=Translate::__('editarmiperfil');?>
      </a>
      <br>
      <a class="mycards" href="tarjetas?uid=<?php echo ($_SESSION['uid']); ?>">
      <?=Translate::__('mistarjetas');?>
      </a>
      <br>
      <a class="mycards" href="direcciones?uid=<?php echo ($_SESSION['uid']); ?>">
      <?=Translate::__('misdirecciones');?>
      </a>
      <br>
      <a class="mycards" href="historial?uid=<?php echo ($_SESSION['uid']); ?>">
      <?=Translate::__('historialdecompra');?>
      </a>
      <br>
      <?php if ($rango['rid'] == '1' || $rango['rid'] == '3' || $rango['rid'] == '4') {?><a href="panel" id="panelAdmin" <?php if($perfil['rango'] == 4) { ?> style="color: white!important;"<?php } ?> "><?=Translate::__('paneladmin');?></a><?php }?>
      <br>
      <?php if ($rango['rid'] == '1' || $rango['rid'] == '3' || $rango['rid'] == '4') {?><a href="panel/historialadmin" id="panelAdmin" <?php if($perfil['rango'] == 4) { ?> style="color: white!important;"<?php } ?> "><?=Translate::__('historialadmin');?></a><?php }?>
      </div>



      <?php if (isset($userdireccion)) {?>
      <div id="direcciones">
        <?php

    $i = 0;
    foreach ($userdireccion as $udir) {
        echo "<p class=\"direccion\">" . $udir['direccion'] . "</p>";
        $i++;
        if ($i == 3) {
            break;
        }

    }
    ?>
      </div>

      <?php }}?>


      <br>

  



    </div>
    <h1 id="historial"><?=Translate::__('ultimosvinoscomprados');?></h1>


    <?php if (isset($productos)) {

    foreach ($productos as $prod) {
        echo "<h1 class=\"vino\">Total: ".$prod['subtotal']."<br>".$prod['nombre'].", ".$prod['marca'].", ".$prod['cantidad']." unidades, ".$prod['Fecha']."</h1>";
    }
  }
    else{?>
      <h1 class="vino"><?=Translate::__('nohacompradoningunvino');?></h1>
    <?php }
    ?>


  </section>

  <?php else: ?>

  <?php Header('Location: login');?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>

  <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>


  <!-- Igual que antes, si coincide la sesión con el GET -->



</body>

</html>

<!-- TRADUCIDO -->