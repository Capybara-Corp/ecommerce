<?php 
session_start();
require '../connect.php';
require "../../../config/config.php";
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

  if ($rango['rid'] != '1') {
    header("Location: ../login.php");
  }
}
else {
    header("Location: ../../../");
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
    <link rel="stylesheet" href="../../../public/css/login/panel.css">
</head>
<body>
    <?php include "navegacion.php" ?>
    <?php 

    if(isset($_GET['uid'])):
      $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
      $records->bindParam(':id', $_GET['uid']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($results) > 0) {
      $usuario = $results;
    }

    $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
      $records->bindParam(':id', $usuario['rango']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $ran = null;

    if (count($results) > 0) {
      $ran = $results;
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

            foreach ($data as $row)
            { ?>
                <option value="<?php echo $row['rid']; ?>"><?php echo $row['nombre']; ?></option>
            <?php } ?>

        
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
    if(isset($_POST['editar'])) {
    if($_POST['contrasena'] != '') { 
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); 
    }
    else {
        $contrasena = $usuario['contraseña'];
    }
    if($_POST['nombre'] != '') { 
        $nombre = $_POST['nombre'];
    }
    else {
        $nombre = $usuario['nombre'];
    }

    $rank = $_POST['rango'];

    $tips = 'jpg';
    $type = array('image/jpeg' => 'jpg');
    $id = $usuario['uid'];

    $nombrefoto1=$_FILES['avatar']['name'];
    $ruta1=$_FILES['avatar']['tmp_name'];
    $name = $id.'.'.$tips;
    if(is_uploaded_file($ruta1))
    {
    $destino1 = "../../public/img/perfil/".$name;
    $destino2 = "../../../public/img/perfil/".$name;
    move_uploaded_file($ruta1, $destino2);
    }
    else{
        $destino1 = $usuario['avatar'];
    }


    $sql = "UPDATE USUARIOS SET nombre = :nombre, contraseña = :contrasena, rango = :rank, avatar = '".$destino1."' WHERE uid = '".$_GET['uid']."'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':rank', $rank);

    if ($stmt->execute()) {
      $message = 'Datos actualizados con exito';
    } else {
      $message = 'No se han podido actualizar los datos';
    }
    echo "$message";


    }
    ?>

<?php endif; ?>

</body>
</html>