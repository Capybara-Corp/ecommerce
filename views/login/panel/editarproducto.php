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
    header("Location: ../login");
  }
}
else {
    header("Location: ../login");
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
    <title>Editar Productos</title>
    <link rel="stylesheet" href="../public/css/login/panel.css">

    <script language="Javascript" type="text/javascript">
      function Confirmar(frm) {
        var borrar = confirm("¿Seguro que desea eliminar este producto?"); // Javascript me pregunta si quiero eliminar el usuario, esto es por si le damos a eliminar sin querer.
        return borrar;
      }

    </script>
</head>
<body>
<?php include "views/login/panel/navegacion.php" ?>
<a href="">Crear un nuevo producto</a>


      <?php 
      if(isset($_GET['borrar'])) { // Si hay algo en la URL de borrar usuario
      $records = $conn->prepare('SELECT * FROM PRODUCTOS WHERE pid = :id');
      $records->bindParam(':id', $_GET['borrar']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $producto = null;

    if (count($results) > 0) {
      $producto = $results; // Guardamos los datos del producto de la URL
    }


        $borrar = $conn->prepare('DELETE FROM PRODUCTOS WHERE pid = :id'); //Borramos el producto de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
    Header("Location: producto");
      }
      
      ?>



  <table width="200" border="1">
    <thead>
    <tr>
      <td>ID</td>
      <td>Nombre</td>
      <td>Precio Venta</td>
      <td>Precio Compra</td>
      <td>Marca</td>
      <td>Tipo</td>
      <td>Cantidad</td>
      <td>Imagen</td>
      <td>Descripcion</td>
      <td>Opciones</td>
    </tr>
</thead>
<tbody>

  <?php 
  $data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();

  foreach ($data as $row)
  { 
    
    ?>
    <tr>
      <td><?php echo $row['pid']; ?></td>
      <td><?php echo $row['nombre']; ?></td>
      <td><?php echo $row['precio_venta']; ?></td>
      <td><?php echo $row['precio_compra']; ?></td>
      <td><?php echo $row['marca']; ?></td>
      <td><?php echo $row['tipo']; ?></td>
      <td><?php echo $row['cantidad']; ?></td>
      <td><img src="../<?php echo $row['img']; ?>" width="50px" height="auto"></td>
      <td><?php echo $row['descrip']; ?></td>

      <td><a href="editarproducto?pid=<?php echo $row['pid']; ?>">Editar</a> | <a href="producto?borrar=<?php echo $row['pid']; ?>" onclick="return Confirmar (this.form)">Borrar</a></td>
    </tr>

   <?php }
  ?>
  </tbody>
  </table>

</body>
</html>