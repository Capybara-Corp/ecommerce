<?php 

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");

$message = '';

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
    $data = $conn->query("SELECT * FROM VENTAS")->fetchAll();
    

    foreach ($data as $row){ 

        $records = $conn->prepare('SELECT * FROM USUARIOS WHERE USUARIOS.uid = :id');
      $records->bindParam(':id', $row['uid']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
  
      $usuario = null;
  
      if (count($results) > 0) {
          $usuario = $results; //Guarda el estado de todos los usuarios en cuestion
      }

        ?>
        <div class="ventas">
        
        <!-- 
            <table class="options">
          <tr>
            <td><a href="editarproducto?pid=<?php echo $row['pid']; ?>"><?=Translate::__('editar');?></a> | <a
            href="producto?borrar=<?php echo $row['pid']; ?>" onclick="return Confirmar (this.form)"><?=Translate::__('borrar');?></a> 
          </tr>
        </table> -->
    
        
    
        <table>
            <thead>
            <tr>
            <td>ID</td>
            <td>Usuario</td>
            <td>Fecha</td>
            <td>Total</td></tr>
            </thead>
            <tbody>
          <tr>
            <td class="id"><?php echo $row['vid']; ?></td>
            <td class="nombre"><?php echo $usuario['nombre']; ?></td>
            <td class="precio_venta"><?php echo $row['Fecha']; ?></td>
            <td class="precio_compra"><?php echo $row['Total']; ?></td></tr>
            </tbody>
            
        </table>
        
        </div>
    
          <?php }
    ?>

</body>
</html>