<?php 

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");

$message = '';

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
        header("Location: ../login");
    }
} else {
    header("Location: ../login");
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
    <title>VENTAS</title>
    <link rel="stylesheet" href="../public/css/login/historialadmin.css">
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

<div class="ventas">
  <table>
            <thead>
            <tr>
            <td>ID</td>
            <td>Usuario</td>
            <td>Fecha</td>
            <td>Total</td></tr>
            </thead>
            <tbody>

    <?php 
    $data = $conn->query("SELECT * FROM VENTAS")->fetchAll();
    

    foreach ($data as $row){ 

        $records = $conn->prepare('SELECT * FROM USUARIOS WHERE USUARIOS.uid = :id');
      $records->bindParam(':id', $row['uid']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
  
      $usuario = null;
  
      if (count($results) > 0) {
          $usuario = $results; //Guarda el estado de todos los usuarios en cuestion
      }

        ?>
        
        
        <!-- 
            <table class="options">
          <tr>
            <td><a href="editarproducto?pid=<?php echo $row['pid']; ?>"><?=Translate::__('editar');?></a> | <a
            href="producto?borrar=<?php echo $row['pid']; ?>" onclick="return Confirmar (this.form)"><?=Translate::__('borrar');?></a> 
          </tr>
        </table> -->
    
        
    
        
          <tr>
            <td class="id"><?php echo $row['vid']; ?></td>
            <td class="nombre"><?php echo $usuario['correo']; ?></td>
            <td class="precio_venta"><?php echo $row['Fecha']; ?></td>
            <td class="precio_compra"><?php echo $row['Total']; ?></td></tr>
            
        
       
    
          <?php }
    ?>
    </tbody>
            
            </table>
            </div>

</body>
</html>