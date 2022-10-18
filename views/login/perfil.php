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
} 

$userdir = [];

$records = $conn->prepare('SELECT * FROM USUARIOS WHERE uid = :id');
    $records->bindParam(':id', $_GET['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $perfil = null;

    if (count($results) > 0) {
        $perfil = $results;
    }

    $records = $conn->prepare('SELECT * FROM USUARIOS_Rangos WHERE rid = :id');
    $records->bindParam(':id', $perfil['rango']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $rango = null;

    if (count($results) > 0) {
        $rango = $results;
    }





    $records = $conn->prepare('SELECT * FROM USUARIOS_Direcciones WHERE uid = :id');
    $records->bindParam(':id', $_SESSION['uid']);
    $records->execute();


    if (is_countable($results) > 0) {
      while ($results = $records->fetch(PDO::FETCH_ASSOC)) {
        $userdireccion[] = $results;
      }
    }
    else{
      $userdireccion[] = '';
    }
  





; //! Con todo esto, lo que hace es sacar el usuario de la sesión y el rango de ese mismo usuario

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de: <?=$perfil['nombre'];?></title>
  <link rel="stylesheet" href="public/css/login/perfil.css">
  <link rel="stylesheet" href="public/css/index/headerblack.css">
  <link rel="stylesheet" href="public/css/index/footer.css">
</head>

<body>

  <?php

if (isset($_GET['uid'])): ?>

<?php include "views/index/header.php";?>

<section id="muro">
    <div id="rosa">
      <br>
      <img src="<?php echo $perfil['avatar']; ?>" class="profilepic">

      <?php if ($perfil['rango'] == '1') {?>
          <p id="soyadmin">(admin)</p><?php }?>
          
          <h1 style="color:<?php echo $rango['color']; ?>" id=profilename>
        <?=$perfil['nombre'];?>
        </h1>
      <br>
      <br>
      <?php if (($_GET['uid']) == ($_SESSION['uid'])) { ?>

        
      <a id="editprofile" href="editar?uid=<?php echo ($_SESSION['uid']); ?>">
        Editar mi perfil
      </a>
      <br>
      <?php if ($rango['rid'] == '1') {?><a href="panel" id="panelAdmin">Panel Admin</a><?php }?>
      
      <?php if(isset($userdireccion)){ ?>
      <div id="direcciones">
      <?php 
      $i    = 0;
        foreach($userdireccion as $udir){
        echo "<p class=\"direccion\">" . $udir['direccion'] . "</p>";
        $i++;
        if ($i == 3) {
            break;
        }

    }
    ?>
    </div>
      
      <?php }} ?>

      

      
    </div>
    <h1 id="historial">Ultimos vinos comprados</h1>
    <h1 class="vino">Vino 1</h1>
    <h1 class="vino">Vino 2</h1>
    <h1 class="vino">Vino 3</h1>
    <h1 class="vino">Vino 4</h1>
    <h1 class="vino">Vino 5</h1>

    
  </section>
  <?php else: ?>
  <?php Header('Location: login');?>
  <?php endif;?>

  <?php include "views/index/footer.php";?>

  <script src="<?php echo constant('URL'); ?>public/js/menu.js"></script>


  <!-- Igual que antes, si coincide la sesión con el GET -->



</body>

</html>