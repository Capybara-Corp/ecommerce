<?php

$message = "";
$existe = false;

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




    $records = $conn->prepare('SELECT * FROM USUARIOS_Direcciones WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);

    $direcciones = null;

    if (count($results) > 0) {
        $direcciones = $results;
        $existe = true;
    }


} else {
    Header('Location: login');
}
; // * Verifico que haya una sesion iniciada

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis direcciones</title>
    <link rel="stylesheet" href="public/css/login/direcciones.css">
    <link rel="stylesheet" href="public/css/index/headerblack.css">
    <script language="Javascript" type="text/javascript">
    function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar su direccion?"
    );
    return borrar;
    }
    </script>
</head>
<body>

<?php

if (($_GET['uid']) == ($_SESSION['uid'])): ?>
  <!-- Si el ID de la URL, es el mismo de la sesion... -->

  <?php include "views/index/header.php";?>

  <?php if (isset($_GET['borrar'])) { // Si hay algo en la URL de borrar usuario
    try{
    $borrar = $conn->prepare('DELETE FROM USUARIOS_Direcciones WHERE duid = :id'); //Borramos el usuario de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
    Header("Location: direcciones?uid=" . $user['uid']);
    }
    catch(Exception $e){
        $message = "Ha ocurrido un error"; 
        echo "<p class=\"message\">$message<p>";
    }
}

    if (isset($_POST['añadir']) && (isset($_POST['direccion']))){
        $direccion = $_POST['direccion'];
            try{
              $sql  = "INSERT INTO USUARIOS_Direcciones (uid, direccion) VALUES (:id, :direccion)";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $_SESSION['uid']);
              $stmt->bindParam(':direccion', $direccion);
          
              if ($stmt->execute()) {
                  $message = 'Datos actualizados con exito';
                  Header("Location: direcciones?uid=" . $user['uid']);
              } else {
                  $message = 'No se han podido actualizar los datos';
              }
            }
            catch(Exception $e){
              $message = "Ha ocurrido un error"; 
              echo "<p class=\"message\">$message<p>";
            }
    } else {
        echo $message;
    }
    

    

?>


  <h1 id="title">MIS DIRECCIONES</h1>


  <form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
  <p>
    <label for="textfield2" class="campo">
      Añadir Direccion:</label>
      <input type="text" name="direccion" id="textfield" /><input type="submit" name="añadir" value="Añadir direccion" />
    </p>
</form>
    <?php if (isset($message)){
        echo $message;
    } ?>


    <?php 

    if ($existe == true) {
    foreach($direcciones as $row){ ?>

        <p>Direccion: <?php echo $row['direccion'] ?><a href="direcciones?uid=<?php echo $_SESSION['uid'] ?>&borrar=<?php echo $row['duid']; ?>" onclick="return Confirmar (this.form)">Borrar</a>

    <?php }}

    ?>




  <?php else: ?>
  <?php header('Location: ../ecommerce');?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>
    
</body>
</html>
