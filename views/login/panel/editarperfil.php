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

    if ($rango['rid'] != '1') {
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
  <title>Document</title>
  <link rel="stylesheet" href="../public/css/login/panel.css">
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





  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <p>
      <label for="textfield2"></label>
      Usuario:
      <input type="text" name="nombre" id="textfield2" value="<?php echo $usuario['nombre']; ?>" />
    </p>
    <p>
      Contraseña:
      <input type="text" name="contrasena" id="textfield" />
    </p>
    <p>


      Rango:
      <label for="select"></label>
      <select name="rango" id="select">

        <?php

    $data = $conn->query("SELECT * FROM USUARIOS_Rangos")->fetchAll();

    foreach ($data as $row) // Por cada rango me muestra una opcion, notese que muestra el nombre pero almacena el valor del id del rango.
{?>
        <option value="<?php echo $row['rid']; ?>"><?php echo $row['nombre']; ?></option>
        <?php }?>


      </select>





    </p>






    <p>Avatar</p>
    <p><img src="../<?php echo $usuario['avatar']; ?>" height="100" width="100" />
    </p>
    <p>
      <label for="fileField"></label>
      <input type="file" name="avatar" id="fileField" />
    </p>
    <p>
      <input type="submit" name="editar" id="button" value="Editar" />
    </p>
  </form>

  <?php

    if (isset($_POST['editar'])) { //Si hay algo en POST, y presionamos en "editar"...
        if ($_POST['contrasena'] != '') { // Si hay algo en el POST de contraseña...
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Lo guardamos
        } else {
            $contrasena = $usuario['contraseña']; // Sino, simplemente dejamos la contraseña anterior
        }
        if ($_POST['nombre'] != '') {
            $nombre = $_POST['nombre']; //Lo mismo acá
        } else {
            $nombre = $usuario['nombre'];
        }

        $rank = $_POST['rango']; //Guardamos en "$rank" el rango que recibió por POST

        $tips = 'jpg';
        $type = ['image/jpeg' => 'jpg'];
        $id   = $usuario['uid'];

        $nombrefoto1 = $_FILES['avatar']['name'];
        $ruta1       = $_FILES['avatar']['tmp_name'];
        $name        = $id . '.' . $tips;
        if (is_uploaded_file($ruta1)) {
            $destino1 = "public/img/perfil/" . $name;
            $destino2 = "public/img/perfil/" . $name;
            move_uploaded_file($ruta1, $destino2); // Todo esto es para guardar la imagen tanto en la BD, como en el directorio local
        } else {
            $destino1 = $usuario['avatar']; // Lo mismo, si no se subio nada, se deja la imagen anterior
        }

        $sql  = "UPDATE USUARIOS SET nombre = :nombre, contraseña = :contrasena, rango = :rank, avatar = '" . $destino1 . "' WHERE uid = '" . $_GET['uid'] . "'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rank', $rank); // Hago mi update

        if ($stmt->execute()) {
            $message = 'Datos actualizados con exito';
        } else {
            $message = 'No se han podido actualizar los datos';
        }
        echo "$message";

    }
    ?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>

</body>

</html>