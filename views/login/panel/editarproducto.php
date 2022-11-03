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
}
else {
    header("Location: ../login");
    echo "Acceso denegado";
    die();
}




// ! CREAR PRODUCTO

if (!empty($_POST['nombre']) && !empty($_POST['precio_venta']) && !empty($_POST['precio_compra']) && !empty($_POST['marca']) && !empty($_POST['tipo']) && !empty($_POST['cantidad']) && !empty($_POST['descrip'])) {
    try{
    $sql = "INSERT INTO PRODUCTOS (nombre, precio_venta, precio_compra, marca, tipo, cantidad, img, descrip) VALUES (:nombre, :precio_venta, :precio_compra, :marca, :tipo, :cantidad, '', :descrip)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':precio_venta', $_POST['precio_venta']);
    $stmt->bindParam(':precio_compra', $_POST['precio_compra']);
    $stmt->bindParam(':marca', $_POST['marca']);
    $stmt->bindParam(':tipo', $_POST['tipo']);
    $stmt->bindParam(':cantidad', $_POST['cantidad']);
    $stmt->bindParam(':descrip', $_POST['descrip']);

    if ($stmt->execute()) {
      $message = 'Producto creado con éxito';
    } else {
      $message = 'Ha ocurrido un error ejecutando la consulta';
    }
  }
  catch(Exception $e){
    echo "Ha ocurrido un error";
  }
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
  <link rel="stylesheet" href="../public/css/login/panelproducto.css">

  <script language="Javascript" type="text/javascript">
  function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar este producto?"
      ); // Javascript me pregunta si quiero eliminar el usuario, esto es por si le damos a eliminar sin querer.
    return borrar;
  }
  </script>
</head>

<body>
<nav class="noselect">
  
  <ul class="main-menu" id="main-menu">
    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
    <li><a href="<?php echo constant('URL'); ?>panel/editar">EDITAR USUARIOS</a></li>
    <li><a href="<?php echo constant('URL'); ?>perfil?uid=<?php echo $_SESSION['uid'] ?>">REGRESAR A MI PERFIL</a></li>

  </ul>
</nav>


<h1 id="gestionarh1">GESTIONAR PRODUCTOS</h1>

<?php 
    $records = $conn->prepare('SELECT COUNT(pid) FROM PRODUCTOS;');
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $cantidad = null;

    if (count($results) > 0) {
        $cantidad = $results; // Guardamos los datos del usuario de la URL
    }
    ?>

<p id="total">TOTAL: <?php echo $cantidad['COUNT(pid)'] ?></p>

<form action="producto" method="POST">
<label for="nombre">Buscar producto por nombre:</label>
<input name="nombre" type="text" placeholder="Ingrese el nombre">
<input type="submit" value="Buscar">
</form>

<section id="main">

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


    unlink("".$producto['img']."");
        $borrar = $conn->prepare('DELETE FROM PRODUCTOS WHERE pid = :id'); //Borramos el producto de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
    Header("Location: producto");
      }
      
?>
<?php
$data = $conn->query("SELECT * FROM PRODUCTOS")->fetchAll();

  foreach ($data as $row){ 
    ?>
    <div class="productos">
      
    <img src="../<?php echo $row['img']; ?>" />

    
    <table class="options">
      <tr>
        <td><a href="editarproducto?pid=<?php echo $row['pid']; ?>">Editar</a> | <a
        href="producto?borrar=<?php echo $row['pid']; ?>" onclick="return Confirmar (this.form)">Borrar</a> 
      </tr>
    </table>

      



    <table>
      <tr>
        <td class="id"><?php echo $row['pid']; ?></td></tr>
        <tr><td class="nombre"><?php echo $row['nombre']; ?></td></tr>
        <tr><td class="precio_venta">Precio venta: <?php echo $row['precio_venta']; ?></td></tr>
        <tr><td class="precio_compra">Precio compra: <?php echo $row['precio_compra']; ?></td></tr>
        <tr><td class="marca"><?php echo $row['marca']; ?></td></tr>
        <tr><td class="tipo"><?php echo $row['tipo']; ?></td></tr>
        <tr><td class="cantidad">Cantidad: <?php echo $row['cantidad']; ?></td></tr>
        <tr><td class="descrip"><?php echo $row['descrip']; ?></td></tr>
    </table>
    
    </div>

      <?php }
?>
</section>


<div class="crear">
<h1 id="crearh1">CREAR PRODUCTO</h1>
  <form action="producto" method="POST">
    <input name="nombre" type="text" placeholder="Nombre">
    <input name="precio_venta" type="text" placeholder="Precio de venta">
    <input name="precio_compra" type="text" placeholder="Precio de compra">
    <input name="marca" type="text" placeholder="Marca">
    <input name="tipo" type="text" placeholder="Tipo">
    <input name="cantidad" type="text" placeholder="Cantidad">
    <input name="descrip" type="text" placeholder="Descripcion">
    <input type="submit" value="Agregar">
  </form> 

  <?php if (!empty($message)): ?>
  <p id="mensaje"> <?=$message;?></p>
  <?php endif;?>
</div>

</body>

</html>