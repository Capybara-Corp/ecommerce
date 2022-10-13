<?php

  require 'libs/connect.php';

  $message = '';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass']) && !empty($_POST['user_name']) && !empty($_POST['user_number'])) {
    if (($_POST['user_pass']) == ($_POST['confirm_password'])){
    try{
    $sql = "INSERT INTO USUARIOS (correo, contraseña, nombre, telefono, rango, avatar) VALUES (:user_correo, :user_pass, :user_name, :user_number, '2', 'public/img/perfil/default.jpg')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_correo', $_POST['user_correo']);
    $user_pass = password_hash($_POST['user_pass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':user_pass', $user_pass);
    $stmt->bindParam(':user_name', $_POST['user_name']);
    $stmt->bindParam(':user_number', $_POST['user_number']);

      /*
      Basicamente, agarra lo que recibe por post, y lo mete en usuarios, cifrando la contraseña
      */


    if ($stmt->execute()) {
      $message = 'Usuario creado con éxito';
    } else {
      $message = 'Ha ocurrido un error';
    }
  }
  catch(Exception $e){
    echo "Ha ocurrido un error"; 
  }
  }
  else{
    echo "Las contraseñas no coinciden";
  }}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <title>Registrarse</title>
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
  </head>
  <body class="noselect">

  <?php include "views/index/header.php";?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="register-box">
    <h1>Registrarse</h1>

    <form action="signup" method="POST">
      <label for="user_correo">Correo</label>
      <input name="user_correo" type="text" placeholder="Ingrese su correo">

      <label for="user_pass">Contraseña</label>
      <input name="user_pass" type="password" placeholder="Ingrese su contraseña">

      <label for="confirm_password">Confirme su contraseña</label>
      <input name="confirm_password" type="password" placeholder="Ingrese su contraseña">

      <label for="user_name">Ingrese su nombre</label>
      <input name="user_name" type="text" placeholder="Enter your name">

      <label for="user_number">Ingrese su número de teléfono</label>
      <input name="user_number" type="text" placeholder="Enter your phone number">

      <input type="submit" value="Registrarse">

      <a href="<?php echo constant('URL'); ?>login">Ya tienes una cuenta?</a>
    </form>
    </div>

    <?php include "views/index/footer.php"; ?>

  </body>
</html>