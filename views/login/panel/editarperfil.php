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
        $rango = $results; //Me saca el rango del usuario iniciado
    }

    if ($rango['rid'] == '2') {
        header("Location: ../login"); //Si rango no es 1, y en consecuencia no es admin, entonces lo saca, ya que este sitio es unicamente para administradores
    }
} else {
    header("Location: ../login"); //Si no está logeado tambien lo saca
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
  <title>Editar perfil</title>
  <link rel="stylesheet" href="../public/css/login/panel.css">
  <link rel="stylesheet" href="../public/css/login/editarperfiladmin.css">
</head>

<body>
  <?php include "navegacion.php";?>
  <?php


if (isset($_GET['uid'])): //Si hay un "uid" en la URL...
    $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_GET['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($results) > 0) {
        $usuario = $results; //Guardamos en "$usuario" los datos del usuario a editar
    }

    $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
    $records->bindParam(':id', $usuario['rango']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $ran = null;

    if (count($results) > 0) {
        $ran = $results; //Guardamos el rango del usuario a editar
    }

    ?>

<h1 id="title">EDITAR PERFIL</h1>

<div id="editar">

<div id="profilepic">




  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>Avatar</p>
    <p><img src="../<?php echo $usuario['avatar']; ?>" />
    </p>
    <p>
      <label for="fileField"></label>
      <input type="file" name="avatar" id="fileField" />
    </p>
    <p>
      <input type="submit" name="editarfoto" id="button" value="Editar" />
    </p>
  </form>
</div>


<div id="campos">

<form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
    <p>
      <label for="textfield2" class="campo">
      Nombre:</label>
      
      <input type="text" name="nombre" id="textfield2" value="<?php echo $usuario['nombre']; ?>" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Contraseña:</label>
      <input type="password" name="contrasena" id="textfield" />
    </p>
    <p>

      <label for="select" class="campo">Rango:</label><br>
      <select name="rango" id="select">
        <?php

    $data = $conn->query("SELECT * FROM USUARIOS_Rangos")->fetchAll();

    foreach ($data as $row) // Por cada rango me muestra una opcion, notese que muestra el nombre pero almacena el valor del id del rango.
{?>
        <option value="<?php echo $row['rid']; ?>"><?php echo $row['nombre']; ?></option>
        <?php }?>

      </select>
    </p>
    <p>
    <label for="textfield2" class="campo">
      Teléfono:</label>
      <input type="text" name="telefono" id="textfield" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Tarjeta:</label>
      <input type="text" name="tarjeta" id="textfield" />
    </p>
    <p>
    <label for="textfield2" class="campo">
      Direccion:</label>
      <input type="text" name="direccion" id="textfield" />
    </p>
      <input type="submit" name="editar" id="buttoneditar" value="Editar datos" />
      
 
    </form>
</div>

</div>




  <?php

    if (isset($_POST['editar']) || (isset($_POST['editarfoto']))) { //Si hay algo en POST, y presionamos en "editar"...
        if ($_POST['contrasena'] != '') { // Si hay algo en el POST de contraseña...
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Lo guardamos
        } else {
            $contrasena = $usuario['contrasena']; // Sino, simplemente dejamos la contraseña anterior
        }
        if ($_POST['nombre'] != '') {
            $nombre = $_POST['nombre']; //Lo mismo acá
        } else {
            $nombre = $usuario['nombre'];
        }
        if ($_POST['telefono'] != '') {
          $telefono = $_POST['telefono'];
      } else {
          $telefono = $usuario['telefono'];
      }
        if ($_POST['rango'] != '') {
          $rank = $_POST['rango']; //Guardamos en "$rank" el rango que recibió por POST
      } else {
          $rank = $usuario['rango'];
      }
        

        $tips = 'jpg';
        $type = ['image/jpeg' => 'jpg'];
        $id   = $usuario['uid'];

        $nombrefoto1 = $_FILES['avatar']['name'];
        $ruta1       = $_FILES['avatar']['tmp_name'];


        $name        = $id . '.' . $tips;
        if (is_uploaded_file($ruta1)) {
            $destino1 = "public/img/perfil/" . $name;
            
            move_uploaded_file($ruta1, $destino1);
        } else {
            $destino1 = $usuario['avatar'];
        }


        try{
        $sql  = "UPDATE USUARIOS SET nombre = :nombre, contrasena = :contrasena, rango = :rango, avatar = :avatar, telefono = :telefono WHERE uid = '" . $_GET['uid'] . "'";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':rango', $rank);
        $stmt->bindParam(':avatar', $destino1);

        if ($stmt->execute()) {
            $message = 'Datos actualizados con exito';
        } else {
            $message = 'No se han podido actualizar los datos';
        }
        echo "<p class=\"message\">$message<p>";
    }
    catch(Exception $e){
      echo $e;
    }

    }
    ?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>

</body>

</html>