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
    <title>Document</title>
</head>
<body>

<?php 
if(($_GET['uid'])==($_SESSION['uid'])): ?>

    <a href="<?php echo constant('URL'); ?>views/login/perfil.php?uid=<?php echo ($_SESSION['uid']); ?>">Regresar a mi perfil</a>
    
    
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <p>
        <label for="textfield2"></label>
        Usuario:
        <input type="text" name="nombre" id="textfield2" value="<?php echo $user['nombre']; ?>" />
    </p>
    <p>
        Contraseña:
        <input type="text" name="contrasena" id="textfield" />
    </p>
    <p>Avatar</p>
        <p><img src="<?php echo $user['avatar']; ?>" height="100" width="100" />
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
        $contrasena = $user['contraseña'];
    }
    if($_POST['nombre'] != '') { 
        $nombre = $_POST['nombre'];
    }
    else {
        $nombre = $user['nombre'];
    }

    $tips = 'jpg';
    $type = array('image/jpeg' => 'jpg');
    $id = $user['uid'];

    $nombrefoto1=$_FILES['avatar']['name'];
    $ruta1=$_FILES['avatar']['tmp_name'];
    $name = $id.'.'.$tips;
    if(is_uploaded_file($ruta1))
    {
    $destino1 = "../../public/img/perfil/".$name;
    move_uploaded_file($ruta1, $destino1);
    }
    else{
        $destino1 = $user['avatar'];
    }


    $sql = "UPDATE USUARIOS SET nombre = :nombre, contraseña = :contrasena, avatar = '".$destino1."' WHERE uid = '".$_SESSION['uid']."'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':contrasena', $contrasena);

    if ($stmt->execute()) {
      $message = 'Datos actualizados con exito';
    } else {
      $message = 'No se han podido actualizar los datos';
    }
    echo "$message";


    }
    ?>

    
    
    <?php else: ?>
    <?php header('Location: logout.php'); ?>
    <?php endif; ?>

</body>
</html>