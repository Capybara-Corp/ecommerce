<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");

$message = '';
$existe = False;


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




    $records = $conn->prepare('SELECT * FROM PRODUCTOS INNER JOIN DETALLEVENTA ON PRODUCTOS.pid = DETALLEVENTA.pid INNER JOIN VENTAS ON VENTAS.vid = DETALLEVENTA.vid WHERE VENTAS.uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);

    $compras = null;

    if (count($results) > 0) {
        $compras = $results;
        $existe = True;
    }


} else {
    Header('Location: login');
}
; // * Verifico que haya una sesion iniciada

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=Translate::__('historialdecompra');?></title>
    <link rel="stylesheet" href="public/css/login/historial.css">
    <link rel="stylesheet" href="public/css/index/headerblack.css">
    <link rel="stylesheet" href="public/css/index/footer.css">
</head>
<body>

<?php

if (($_GET['uid']) == ($_SESSION['uid'])): ?>
  <!-- Si el ID de la URL, es el mismo de la sesion... -->

  <?php include "views/index/header.php";?>


  <h1 id="title"><?=Translate::__('historialdecompra');?></h1>


    <?php if (isset($message)){
        echo $message;
    } ?>

    <div id="historial">
    <?php 
    
    if ($existe == true) { ?>
    
    <?php 
    foreach($compras as $row){ ?>

        <p class="elemento"><?php echo $row['Fecha']; ?>: <?php echo $row['nombre']; ?>, <?php echo $row['marca']; ?></p>

    <?php } ?> </div> <?php }
    else{ ?>
        <p class="elemento"><?=Translate::__('nohaycompras');?></p>
    <?php } ?>

    




  <?php else: ?>
  <?php header('Location: ../ecommerce');?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>
    
</body>
</html>

<!-- TRADUCIDO -->