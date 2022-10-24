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
  <title>Editar mi perfil</title>
  <script language="Javascript" type="text/javascript">
  function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar su usuario?"
    );
    return borrar;
  }
  </script>
  <link rel="stylesheet" href="public/css/login/editarperfil.css">
  <link rel="stylesheet" href="public/css/index/headerblack.css">
</head>

<body>

  <?php

if (($_GET['uid']) == ($_SESSION['uid'])): ?>
  <!-- Si el ID de la URL, es el mismo de la sesion... -->

  <?php include "views/index/header.php";?>


  <h1 id="title">EDITAR PERFIL</h1>

  <div id="editar">

  
  

  <div id="profilepic">
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>Imagen de perfil</p>
    <p><img src="<?php echo $user['avatar']; ?>" />
    </p>
    <p>
      <label for="fileField"></label>
      <input type="file" name="avatar" id="fileField" />
    </p>
    <p>
      <input type="submit" name="editarfoto" id="button" value="Editar foto" />
    </p>
</form>
</div>


<div id="campos">


<form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
    <p>
      <label for="textfield2" class="campo">
      Nombre:</label>
      
      <input type="text" name="nombre" id="textfield2" value="<?php echo $user['nombre']; ?>" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Contraseña:</label>
      <input type="password" name="contrasena" id="textfield" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Teléfono:</label>
      <input type="text" name="telefono" id="textfield" value="<?php echo $user['telefono']; ?>" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Añadir Tarjeta:</label>
      <input type="text" name="tarjeta" id="textfield" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Añadir Direccion:</label>
      <input type="text" name="direccion" id="textfield" />
    </p>
      <input type="submit" name="editar" id="buttoneditar" value="Editar datos" />
      
      <input type="submit" name="eliminar" id="buttoneliminar" onclick="return Confirmar (this.form)" value="Eliminar mi usuario" /></li>
 
    </form>
</div>

</div>

  <!-- Se me desbloquea todo este formulario -->

  <?php

if (isset($_POST['editar']) || (isset($_POST['editarfoto']))) {
  
    if ($_POST['contrasena'] != '') {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    } else {
        $contrasena = $user['contrasena'];
    }
    if ($_POST['nombre'] != '') {
        $nombre = $_POST['nombre'];
    } else {
        $nombre = $user['nombre'];
    }
    if ($_POST['telefono'] != '') {
      $telefono = $_POST['telefono'];
  } else {
      $telefono = $user['telefono'];
  }
  if ($_POST['tarjeta'] != '') {
    $tarjeta = $_POST['tarjeta'];
} else {
    $tarjeta = '';
}
if ($_POST['direccion'] != '') {
  $direccion = $_POST['direccion'];
} else {
  $direccion = '';
}

    $tips = 'jpg';
    $type = ['image/jpeg' => 'jpg'];
    $id   = $user['uid'];

    $nombrefoto1 = $_FILES['avatar']['name'];
    $ruta1       = $_FILES['avatar']['tmp_name'];


    $name        = $id . '.' . $tips;
    if (is_uploaded_file($ruta1)) {
        $destino1 = "public/img/perfil/" . $name;
        move_uploaded_file($ruta1, $destino1);
    } else {
        $destino1 = $user['avatar'];
    }

    /* Practicamente es igual que el "editar usuario" de administradores, solo que aqui, no se puede
    modificar el rango (por obvias razones) y solo podemos modificar el usuario de la sesión iniciada
     */

    try{
    $sql  = "UPDATE USUARIOS SET nombre = :nombre, contrasena = :contrasena, telefono = :telefono, avatar = '" . $destino1 . "' WHERE uid = '" . $_SESSION['uid'] . "'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':telefono', $telefono);

    if ($stmt->execute()) {
        $message = 'Datos actualizados con exito';
        Header("Location: editar?uid=" . $user['uid']);
    } else {
        $message = 'No se han podido actualizar los datos';
    }
    echo "<p class=\"message\">$message<p>";
  }
  catch(Exception $e){
    $message = "Ha ocurrido un error"; 
    echo "<p class=\"message\">$message<p>";
  }

  if($tarjeta != ''){
  try{
    $sql  = "INSERT INTO USUARIOS_Tarjetas (uid, tarjeta) VALUES (:id, :tarjeta)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['uid']);
    $stmt->bindParam(':tarjeta', $tarjeta);

    if ($stmt->execute()) {
        Header("Location: editar?uid=" . $user['uid']);
        $message = 'Datos actualizados con exito';
    } else {
        $message = 'No se han podido actualizar los datos';
    }
  }
  catch(Exception $e){
    $message = "Ha ocurrido un error"; 
    echo "<p class=\"message\">$message<p>";
  }
  }

  if($direccion != ''){
    try{
      $sql  = "INSERT INTO USUARIOS_Direcciones (uid, direccion) VALUES (:id, :direccion)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id', $_SESSION['uid']);
      $stmt->bindParam(':direccion', $direccion);
  
      if ($stmt->execute()) {
          $message = 'Datos actualizados con exito';
          Header("Location: editar?uid=" . $user['uid']);
      } else {
          $message = 'No se han podido actualizar los datos';
      }
    }
    catch(Exception $e){
      $message = "Ha ocurrido un error"; 
      echo "<p class=\"message\">$message<p>";
    }
  }


}

if (isset($_POST['eliminar'])) {
  try{
    if($user['avatar'] != "public/img/perfil/default.jpg"){
      unlink("" . $user['avatar'] . ""); //Borramos el archivo de la foto de perfil del disco duro
      }
    $borrar = $conn->prepare('DELETE FROM USUARIOS WHERE uid = :id'); //Borramos el usuario de la BD
    $borrar->bindParam(':id', $_SESSION['uid']);
    $borrar->execute();
    header('Location: logout');
  }
  catch(Exception $e){
    $message = "Ha ocurrido un error"; 
    echo "<p class=\"message\">$message<p>";
  }
}

; 

?>



  <?php else: ?>
  <?php header('Location: ../ecommerce');?>

  <!-- ! Importante, si el ID de la sesión iniciada no coincide con el ID que recibimos por GET,
    nada de esto aparece, ya que sino, cualquiera podria modificar el perfil del que se le antoje
    simplemente poniendo el ID del usuario en la URL.
    */ -->
  <?php endif;?>

  <?php include "views/index/footer.php";?>

</body>

</html>