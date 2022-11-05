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
}
else {
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
    <?php include "navegacion.php" ?>
    <?php 

    if(isset($_GET['pid'])): //Si hay un "pid" en la URL...
      $records = $conn->prepare('SELECT * FROM PRODUCTOS WHERE pid = :id');
      $records->bindParam(':id', $_GET['pid']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

    $producto = null;

    if (count($results) > 0) {
      $producto = $results; //Guardamos en "$usuario" los datos del usuario a editar
    }

?>





<form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
    <p>
        <label for="textfield2"></label>
        Nombre:
        <input type="text" name="nombre" id="textfield2" value="<?php echo $producto['nombre']; ?>" />
    </p>
    <p>
    Precio Venta:
        <input type="text" name="precioventa" id="textfield2" value="<?php echo $producto['precio_venta']; ?>" />
    </p>
    <p>
    Precio Compra:
        <input type="text" name="preciocompra" id="textfield2" value="<?php echo $producto['precio_compra']; ?>" />
    </p>
    <p>
    Marca:
        <input type="text" name="marca" id="textfield2" value="<?php echo $producto['marca']; ?>" />
    </p>
    <p>
    Tipo:
        <input type="text" name="tipo" id="textfield2" value="<?php echo $producto['tipo']; ?>" />
    </p>
    <p>
    Cantidad:
        <input type="text" name="cantidad" id="textfield2" value="<?php echo $producto['cantidad']; ?>" />
    </p>
    <p>Imagen</p>
        <p><img src="../<?php echo $producto['img']; ?>" height="100" width="100" />
    </p>
    <p>
        <label for="fileField"></label>
        <input type="file" name="img" id="fileField" />
    </p>
    <p>
    Descripcion:
        <input style="width: 300px;" type="text" name="descripcion" id="textfield2" value="<?php echo $producto['descrip']; ?>" />
    </p>
    <p>
        <input type="submit" name="editar" id="button" value="Editar" />
    </p>
    </form>

    <?php 
    if(isset($_POST['editar'])) { //Si hay algo en POST, y presionamos en "editar"...
    if($_POST['nombre'] != '') { 
        $nombre = $_POST['nombre']; //Lo mismo acá
    }
    else {
        $nombre = $producto['nombre'];
    }
    if($_POST['precioventa'] != '') { 
        $precio_venta = $_POST['precioventa']; //Lo mismo acá
    }
    else {
        $precio_venta = $producto['precio_venta'];
    }
    if($_POST['preciocompra'] != '') { 
        $precio_compra = $_POST['preciocompra']; //Lo mismo acá
    }
    else {
        $precio_compra = $producto['precio_compra'];
    }
    if($_POST['marca'] != '') { 
        $marca = $_POST['marca']; //Lo mismo acá
    }
    else {
        $marca = $producto['marca'];
    }
    if($_POST['tipo'] != '') { 
        $tipo = $_POST['tipo']; //Lo mismo acá
    }
    else {
        $tipo = $producto['tipo'];
    }
    if($_POST['cantidad'] != '') { 
        $cantidad = $_POST['cantidad']; //Lo mismo acá
    }
    else {
        $cantidad = $producto['cantidad'];
    }
    $tips = 'png';
    $type = array('image/jpeg' => 'png');
    $id = $producto['pid'];

    $nombrefoto1=$_FILES['img']['name'];
    $ruta1=$_FILES['img']['tmp_name'];
    $name = 'bottle'.$id.'.'.$tips;
    if(is_uploaded_file($ruta1))
    {
    $destino1 = "public/media/bottles/".$name;
    $destino2 = "public/media/bottles/".$name;
    move_uploaded_file($ruta1, $destino2);    // Todo esto es para guardar la imagen tanto en la BD, como en el directorio local
    }
    else{
        $destino1 = $producto['img']; // Lo mismo, si no se subio nada, se deja la imagen anterior
    }
    if($_POST['descripcion'] != '') { 
        $descripcion = $_POST['descripcion']; //Lo mismo acá
    }
    else {
        $descripcion = $producto['descrip'];
    }
    try{
    $sql = "UPDATE PRODUCTOS SET nombre = :nombre, precio_venta = :precio_venta, precio_compra = :precio_compra, marca = :marca, tipo = :tipo, cantidad = :cantidad, img = '".$destino1."', descrip = :descripcion WHERE pid = '".$_GET['pid']."'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio_venta', $precio_venta);
    $stmt->bindParam(':precio_compra', $precio_compra);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':descripcion', $descripcion);

    if ($stmt->execute()) {
      $message = 'Datos actualizados con exito';
    } else {
      $message = 'No se han podido actualizar los datos';
    }
    echo "$message";
    }
    catch(Exception $e){
        echo "Error"; 
    }


    }
    ?>

<?php endif; ?>

</body>
</html>