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
// * Lo mismo, verifica si estamos logeados y si además somos admin.

if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['telefono']) && !empty($_POST['rango'])) {
    try {
        $sql  = "INSERT INTO USUARIOS (nombre, correo, contrasena, telefono, avatar, rango, estado) VALUES (:nombre, :correo, :contrasena, :telefono, 'public/img/perfil/default.jpg', :rango, '1')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':correo', $_POST['correo']);
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':rango', $_POST['rango']);

        if ($stmt->execute()) {
            $message = 'Usuario creado con éxito';
        } else {
            $message = 'Ha ocurrido un error ejecutando la consulta';
        }
    } catch (Exception $e) {
        $message = "Ha ocurrido un error";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=Translate::__('editarusuarios');?></title>
  <link rel="stylesheet" href="../public/css/login/panelusuarios.css">

  <script language="Javascript" type="text/javascript">
  function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar este usuario de la base de datos?"
    ); // Javascript me pregunta si quiero eliminar el usuario, esto es por si le damos a eliminar sin querer.
    return borrar;
  }
  </script>
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





<h1 id="gestionarh1"><?=Translate::__('gestionarusuarios');?></h1>
  
<?php 
    $records = $conn->prepare('SELECT COUNT(uid) FROM USUARIOS;');
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $cantidad = null;

    if (count($results) > 0) {
        $cantidad = $results; // Guardamos los datos del usuario de la URL
    }
    ?>



<form action="editar" method="POST">
<label for="buscar"><?=Translate::__('buscarusuariopornombre');?>:</label><br>
<input name="buscar" type="text" placeholder="<?=Translate::__('ingreseelnombre');?>" id="inputnombre">
<input type="submit" value="<?=Translate::__('buscar');?>" id="inputbuscar">
</form>
<p id="total"><?=Translate::__('total');?>: <?php echo $cantidad['COUNT(uid)'] ?></p>

<section id="main">


  <?php

if (isset($_GET['borrar'])) { // Si hay algo en la URL de borrar usuario
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_GET['borrar']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($results) > 0) {
        $usuario = $results; // Guardamos los datos del usuario de la URL
    }

    if($usuario['avatar'] != 'public/img/perfil/default.jpg'){
    unlink("" . $usuario['avatar'] . ""); //Borramos el archivo de la foto de perfil del disco duro
    }
    $borrar = $conn->prepare('DELETE FROM USUARIOS WHERE uid = :id'); //Borramos el usuario de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
    header("Location: editar");
}




if (isset($_GET['desactivar'])) { // Si hay algo en la URL de borrar usuario
  $desactivar = $conn->prepare('UPDATE USUARIOS SET estado = 2 WHERE uid = :id'); //Borramos el usuario de la BD
  $desactivar->bindParam(':id', $_GET['desactivar']);
  $desactivar->execute();
  header("Location: editar");

}

if (isset($_GET['activar'])) { // Si hay algo en la URL de borrar usuario
  $activar = $conn->prepare('UPDATE USUARIOS SET estado = 1 WHERE uid = :id'); //Borramos el usuario de la BD
  $activar->bindParam(':id', $_GET['activar']);
  $activar->execute();
  header("Location: editar");

}

?>
<?php 
  //QUERY = SELECT * FROM USUARIOS WHERE nombre LIKE '%vir%'
?>
      <?php

if($user['rango'] == '1'){
  if(isset($_POST['buscar'])){
    $buscStr = $_POST['buscar'];
    $buscStr = trim($buscStr);
    $buscStr = strtolower($buscStr);
    $data = $conn->query("SELECT * FROM USUARIOS WHERE nombre LIKE '%$buscStr%' AND rango = '2'");
    
    //No se deberia poner asi

    //$data->bindParam(':textostr', $buscStr, PDO::PARAM_STR);
    //$term = "%$buscStr%";
    //$data->bindParam(':textostr', $term, PDO::PARAM_STR);
  }
  else{
    $data = $conn->query("SELECT * FROM USUARIOS WHERE rango = '2'")->fetchAll();
  }
}
else if($user['rango'] == '3'){
  if(isset($_POST['buscar'])){
    $buscStr = $_POST['buscar'];
    $buscStr = trim($buscStr);
    $buscStr = strtolower($buscStr);
    $data = $conn->query("SELECT * FROM USUARIOS WHERE nombre LIKE '%$buscStr%' AND rango <= '2'");
    
    //No se deberia poner asi

    //$data->bindParam(':textostr', $buscStr, PDO::PARAM_STR);
    //$term = "%$buscStr%";
    //$data->bindParam(':textostr', $term, PDO::PARAM_STR);
  }
  else{
    $data = $conn->query("SELECT * FROM USUARIOS WHERE rango <= '2'")->fetchAll();
  }
  
}

else if($user['rango'] == '4'){
  if(isset($_POST['buscar'])){
    $buscStr = $_POST['buscar'];
    $buscStr = trim($buscStr);
    $buscStr = strtolower($buscStr);
    $data = $conn->query("SELECT * FROM USUARIOS WHERE nombre LIKE '%$buscStr%'");
    //No se deberia poner asi
    //$data->bindParam(':textostr', $buscStr, PDO::PARAM_STR);
    //$term = "%$buscStr%";
    //$data->bindParam(':textostr', $term, PDO::PARAM_STR);
  }
  else{
    $data = $conn->query("SELECT * FROM USUARIOS")->fetchAll();
  }
}

foreach ($data as $row) {
    $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
    $records->bindParam(':id', $row['rango']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $ran = null;

    if (count($results) > 0) {
        $ran = $results; //Guarda el rango de todos los usuarios en cuestion
    }

      $records = $conn->prepare('SELECT * FROM USUARIOS_Estado WHERE eid = :id');
      $records->bindParam(':id', $row['estado']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
  
      $estado = null;
  
      if (count($results) > 0) {
          $estado = $results; //Guarda el estado de todos los usuarios en cuestion
      }



    

    ?>
    <div class="usuarios">
      
    <img src="../<?php echo $row['avatar']; ?>" />

    
    <table class="options">
      <tr>
        <td><a href="editarperfil?uid=<?php echo $row['uid']; ?>"><?=Translate::__('editar');?></a> | <a
        href="editar?borrar=<?php echo $row['uid']; ?>" onclick="return Confirmar (this.form)"><?=Translate::__('borrar');?></a> | 
        
        <?php if($row['estado'] == 1){ ?>
        <a href="editar?desactivar=<?php echo $row['uid']; ?>"><?=Translate::__('desactivar');?></a></td> <?php } ?>
        <?php if($row['estado'] == 2){ ?>
        <a href="editar?activar=<?php echo $row['uid']; ?>"><?=Translate::__('activar');?></a></td> <?php } ?>

      </tr>
    </table>

      

    <table>
      <tr>
        <td class="id"><?php echo $row['uid']; ?></td></tr>
        <tr><td class="rango" <?php if ($ran['rid'] == 4) { ?>style="color: red!important;"<?php } ?>><?php echo $ran['nombre']; ?></td></tr>
        <tr><td class="nombre"><?php echo $row['nombre']; ?></td></tr>
        <tr><td class="correo"><?php echo $row['correo']; ?></td></tr>
    </table>

    
    <p class="estado"><?php echo $estado['nombre']; ?></p>
    </div>

      <?php }
?>
</section>

<div class="crear">
<h1 id="crearh1"><?=Translate::__('crearusuario');?></h1>
  <form action="editar" method="POST">
    <input name="nombre" type="text" placeholder="<?=Translate::__('nombre');?>">
    <input name="correo" type="text" placeholder="<?=Translate::__('correo');?>">
    <input name="contrasena" type="text" placeholder="<?=Translate::__('contrasena');?>">
    <input name="telefono" type="text" placeholder="<?=Translate::__('telefono');?>">
    <p>
      
      <label for="select"><?=Translate::__('rango');?>:</label>
      <select name="rango" id="select">

        <?php

if($user['rango'] == '1'){
$data = $conn->query("SELECT * FROM USUARIOS_Rangos WHERE rid = '2'")->fetchAll();
}
else if($user['rango'] == '3'){
  $data = $conn->query("SELECT * FROM USUARIOS_Rangos WHERE rid <= '2'")->fetchAll();
}
else if($user['rango'] == '4'){
  $data = $conn->query("SELECT * FROM USUARIOS_Rangos")->fetchAll();
}

foreach ($data as $row) // Por cada rango me muestra una opcion, notese que muestra el nombre pero almacena el valor del id del rango.
{?>
        <option value="<?php echo $row['rid']; ?>"><?php echo $row['nombre']; ?></option>
        <?php }?>
      </select>
    </p>
    <input type="submit" value="<?=Translate::__('agregar');?>">
  </form>
  <?php if (!empty($message)): ?>
  <p id="mensaje"> <?=$message;?></p>
  <?php endif;?>
</div>

<script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>

</body>

</html>

<!-- TRADUCIDO -->