<?php 
session_start();
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

  if ($rango['rid'] != '1') {
    header("Location: ../ecommerce");
  }
}
else {
    header("Location: ../ecommerce");
    echo "Acceso denegado";
    die();
}

// * Lo mismo, verifica si estamos logeados y si además somos admin.


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <link rel="stylesheet" href="../public/css/login/panel.css">

    <script language="Javascript" type="text/javascript">
      function Confirmar(frm) {
        var borrar = confirm("¿Seguro que desea eliminar este usuario?"); // Javascript me pregunta si quiero eliminar el usuario, esto es por si le damos a eliminar sin querer.
        return borrar;
      }

    </script>
</head>
<body>
<?php include "views/login/panel/navegacion.php" ?>


      <?php 
      if(isset($_GET['borrar'])) { // Si hay algo en la URL de borrar usuario
      $records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
      $records->bindParam(':id', $_GET['borrar']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($results) > 0) {
      $usuario = $results; // Guardamos los datos del usuario de la URL
    }

    unlink("".$usuario['avatar'].""); //Borramos el archivo de la foto de perfil del disco duro


        $borrar = $conn->prepare('DELETE FROM USUARIOS WHERE uid = :id'); //Borramos el usuario de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
      }
      
      ?>



  <table width="200" border="1">
    <thead>
    <tr>
      <td>ID</td>
      <td>Usuario</td>
      <td>Avatar</td>
      <td>Rango</td>
      <td>Opciones</td>
    </tr>
</thead>
<tbody>

  <?php 
  $data = $conn->query("SELECT * FROM USUARIOS")->fetchAll();

  foreach ($data as $row)
  { 
    $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
      $records->bindParam(':id', $row['rango']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $ran = null;

    if (count($results) > 0) {
      $ran = $results; //Guarda el rango de todos los usuarios en cuestion
    }
    
    ?>
    <tr>
      <td><?php echo $row['uid']; ?></td>
      <td><?php echo $row['nombre']; ?></td>
      <td><img src="../<?php echo $row['avatar']; ?>" width="50px" height="50px"></td>
      <td><?php echo $ran['nombre']; ?></td>
      <td><a href="editarperfil?uid=<?php echo $row['uid']; ?>">Editar</a> | <a href="editarusuario?borrar=<?php echo $row['uid']; ?>" onclick="return Confirmar (this.form)">Borrar</a></td>
    </tr>

   <?php }
  ?>
  </tbody>
  </table>

</body>
</html>