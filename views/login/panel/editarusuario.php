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
        $sql  = "INSERT INTO USUARIOS (nombre, correo, contrasena, telefono, avatar, rango) VALUES (:nombre, :correo, :contrasena, :telefono, 'public/img/perfil/default.jpg', :rango)";
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
        echo "Ha ocurrido un error";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuarios</title>
  <link rel="stylesheet" href="../public/css/login/panelusuarios.css">

  <script language="Javascript" type="text/javascript">
  function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar este usuario?"
    ); // Javascript me pregunta si quiero eliminar el usuario, esto es por si le damos a eliminar sin querer.
    return borrar;
  }
  </script>
</head>

<body>

<nav class="noselect">
  
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/producto">EDITAR PRODUCTOS</a></li>
    <li><a href="<?php echo constant('URL'); ?>perfil?uid=<?php echo $_SESSION['uid'] ?>">REGRESAR A MI PERFIL</a></li>

  </ul>
</nav>






<h1 id="gestionarh1">GESTIONAR USUARIOS</h1>
  


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
}

?>

      <?php

if($user['rango'] == '1'){
$data = $conn->query("SELECT * FROM USUARIOS WHERE rango = '2'")->fetchAll();
}
else if($user['rango'] == '3'){
  $data = $conn->query("SELECT * FROM USUARIOS WHERE rango <= '2'")->fetchAll();
}
else if($user['rango'] == '4'){
  $data = $conn->query("SELECT * FROM USUARIOS")->fetchAll();
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

    ?>
    <div class="usuarios">
    <img src="../<?php echo $row['avatar']; ?>" />

    <table class="options">
      <tr>
        <td><a href="editarperfil?uid=<?php echo $row['uid']; ?>">Editar</a> | <a
        href="editar?borrar=<?php echo $row['uid']; ?>" onclick="return Confirmar (this.form)">Borrar</a></td>
      </tr>
    </table>

    <table>
      <tr>
        <td class="id"><?php echo $row['uid']; ?></td></tr>
        <tr><td class="rango" <?php if ($ran['rid'] == 4) { ?>style="color: red!important;"<?php } ?>><?php echo $ran['nombre']; ?></td></tr>
        <tr><td class="nombre"><?php echo $row['nombre']; ?></td></tr>
        <tr><td class="correo"><?php echo $row['correo']; ?></td></tr>
    </table>

    
    
    </div>

      <?php }
?>
</section>

<div class="crear">
<h1 id="crearh1">CREAR USUARIO</h1>
  <form action="editar" method="POST">
    <input name="nombre" type="text" placeholder="Nombre">
    <input name="correo" type="text" placeholder="Correo electronico">
    <input name="contrasena" type="text" placeholder="Contraseña">
    <input name="telefono" type="text" placeholder="Telefono">
    <p>
      
      <label for="select">Rango:</label>
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
    <input type="submit" value="Agregar">
  </form>
</div>



</body>

</html>