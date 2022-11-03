<?php

require_once 'traduccion/Translate.php';
use \SimpleTranslation\Translate;


$idioma = $_COOKIE['idioma'];
Translate::init($idioma, "lang/".$idioma.".php");

/*

  require 'libs/connect.php';

  $message = '';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass']) && !empty($_POST['user_name']) && !empty($_POST['user_number'])) {
    if (($_POST['user_pass']) == ($_POST['confirm_password'])){
    try{
    $sql = "INSERT INTO USUARIOS (correo, contraseña, nombre, telefono, rango, avatar) VALUES (:user_correo, :user_pass, :user_name, :user_number, '2', 'public/img/perfil/default.jpg')";
    $stmt = $conn->prepare($sql);

    if(filter_var($_POST['user_correo'], FILTER_VALIDATE_EMAIL)){
      $stmt->bindParam(':user_correo', $_POST['user_correo']);
      $user_pass = password_hash($_POST['user_pass'], PASSWORD_BCRYPT);
      $stmt->bindParam(':user_pass', $user_pass);
      $stmt->bindParam(':user_name', $_POST['user_name']);
      $stmt->bindParam(':user_number', $_POST['user_number']);
      if ($stmt->execute()) {
      
      $records = $conn->prepare('SELECT * FROM USUARIOS WHERE correo=:user_correo');
      $records->bindParam(':user_correo', $_POST['user_correo']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

        if (is_countable($results) > 0) {
        $_SESSION['uid']   = $results['uid'];
        $_SESSION['rango'] = $results['rango'];
        header("Location: ../ecommerce"); 
      }
    } else {
      $message = 'Ha ocurrido un error';
    }
    }
    else{
      $message = "Correo inválido";
    }

    
  }
  catch(Exception $e){
    $message = "Ha ocurrido un error"; 
  }
  }
  else{
    $message = "Las contraseñas no coinciden";
  }}

  */
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <title><?=Translate::__('registrarse');?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@100;300;400&display=swap"
    rel="stylesheet">
  <!-- Cosas para que la pagina funcione -->
  <link rel="stylesheet" href="public/css/login/signup.css">
  <link rel="stylesheet" href="public/css/index/header.css">
  <link rel="stylesheet" href="public/css/index/footer.css">
  </head>
  <body>

  <?php include "views/index/header.php";?>


    <div class="register-box">
    <h1><?=Translate::__('registrarse');?></h1>

    <form action="signup" method="POST">

    <?php if(!empty($this->message)): ?>
      <p id="mensaje"><?= $this->message ?></p>
    <?php endif; ?>

      <label for="user_correo"><?=Translate::__('correo');?></label>
      <input name="user_correo" type="text" placeholder="Ingrese su correo">

      <label for="user_pass"><?=Translate::__('contrasena');?></label>
      <input name="user_pass" type="password" placeholder="<?=Translate::__('ingresesucontrasena');?>">

      <label for="confirm_password"><?=Translate::__('confirmesucontrasena');?></label>
      <input name="confirm_password" type="password" placeholder="<?=Translate::__('ingresesucontrasena');?>">

      <label for="user_name"><?=Translate::__('ingresesunombre');?></label>
      <input name="user_name" type="text" placeholder="<?=Translate::__('ingresesunombre');?>">

      <label for="user_number"><?=Translate::__('ingresesunumero');?></label>
      <input name="user_number" type="text" placeholder="<?=Translate::__('ingresesunumero');?>">

      <input type="submit" value="<?=Translate::__('registrarse');?>">

      <a href="<?php echo constant('URL'); ?>login"><?=Translate::__('yatienesunacuenta');?></a>
    </form>
    </div>

    <?php include "views/index/footer.php"; ?>

  </body>
</html>