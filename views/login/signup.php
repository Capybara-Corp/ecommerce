<?php

  require 'connect.php';

  $message = '';

  if (!empty($_POST['user_correo']) && !empty($_POST['user_pass']) && !empty($_POST['user_name']) && !empty($_POST['user_number'])) {
    try{
    $sql = "INSERT INTO USUARIOS (correo, contraseña, nombre, telefono, rango, avatar) VALUES (:user_correo, :user_pass, :user_name, :user_number, '2', '../../public/img/perfil/default.jpg')";
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
    echo "Correo electrónico en uso"; // Se fija que el correo electronico no esté en uso
  }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body>


    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="user_correo" type="text" placeholder="Enter your email">
      <input name="user_pass" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input name="user_name" type="text" placeholder="Enter your name">
      <input name="user_number" type="text" placeholder="Enter your phone number">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>