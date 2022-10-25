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




    $records = $conn->prepare('SELECT * FROM USUARIOS_Tarjetas WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();
    $results = $records->fetchAll(PDO::FETCH_ASSOC);

    $tarjetas = null;

    if (count($results) > 0) {
        $tarjetas = $results;
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
    <title>Mis tarjetas</title>
    <link rel="stylesheet" href="public/css/login/tarjetas.css">
    <link rel="stylesheet" href="public/css/index/headerblack.css">
    <script language="Javascript" type="text/javascript">
    function Confirmar(frm) {
    var borrar = confirm(
      "¿Seguro que desea eliminar su tarjeta?"
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
    $borrar = $conn->prepare('DELETE FROM USUARIOS_Tarjetas WHERE tuid = :id'); //Borramos el usuario de la BD
    $borrar->bindParam(':id', $_GET['borrar']);
    $borrar->execute();
    Header("Location: tarjetas?uid=" . $user['uid']);
    }
    catch(Exception $e){
        $message = "Ha ocurrido un error"; 
        echo "<p class=\"message\">$message<p>";
      }
}

    if (isset($_POST['añadir']) && (isset($_POST['tarjeta']))){
        $tarjeta = $_POST['tarjeta'];
            try{
              $sql  = "INSERT INTO USUARIOS_Tarjetas (uid, tarjeta) VALUES (:id, :tarjeta)";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $_SESSION['uid']);
              $stmt->bindParam(':tarjeta', $tarjeta);
          
              if ($stmt->execute()) {
                  $message = 'Datos actualizados con exito';
                  Header("Location: tarjetas?uid=" . $user['uid']);
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


  <h1 id="title">MIS TARJETAS</h1>


  <form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
  <p>
    <label for="textfield2" class="campo">
      Añadir Tarjeta:</label>
      <input type="text" name="tarjeta" id="textfield" /><input type="submit" name="añadir" value="Añadir tarjeta" />
    </p>
</form>
    <?php if (isset($message)){
        echo $message;
    } ?>


    <?php 
    
    if ($existe == true) {
    foreach($tarjetas as $row){ ?>

        <p>Numero de tarjeta: <?php echo $row['tarjeta'] ?><a href="tarjetas?uid=<?php echo $_SESSION['uid'] ?>&borrar=<?php echo $row['tuid']; ?>" onclick="return Confirmar (this.form)">Borrar</a>

    <?php }}

    ?>




  <?php else: ?>
  <?php header('Location: ../ecommerce');?>

  <?php endif;?>

  <?php include "views/index/footer.php";?>
    
</body>
</html>
