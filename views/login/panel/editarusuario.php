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
</head>
<body>
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
  { ?>
    <tr>
      <td><?php echo $row['uid']; ?></td>
      <td><?php echo $row['nombre']; ?></td>
      <td><img src="../<?php echo $row['avatar']; ?>" width="50px" height="50px"></td>
      <td><?php echo $row['rango']; ?></td>
      <td><a href="editarperfil.php?uid=<?php echo $row['uid']; ?>">Editar</a> | Borrar</td>
    </tr>

   <?php }
  ?>
  </tbody>
  </table>

</body>
</html>